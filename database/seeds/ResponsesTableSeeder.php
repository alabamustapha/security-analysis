<?php

use Illuminate\Database\Seeder;
use App\Respondent;
use App\Question;
class ResponsesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        $respondents = Respondent::all();
        foreach ($respondents as $respondent) {
            $user_id = rand(3,4);
        	foreach ($respondent->building->questions as $question) {
        		if($question->type == 'rating'){
        			$value = rand($question->min, $question->max);
        			$options = prepareQuestionOptions($question->option);
        			DB::table('responses')->insert([
						'body' => getQuestionOptionLabel($options[array_rand($options)]),
						'suggestions' => $faker->sentence(30),
						'value' => (int)$value,
						'building_id' => $question->building_id,
						'respondent_id' => $respondent->id,
                        'question_id' => $question->id,
						'user_id' => $user_id
        			]);
        		}else{
        			$options = prepareQuestionOptions($question->options);
        			DB::table('responses')->insert([
						'body' => getQuestionOptionLabel($options[array_rand($options)]),
						'suggestions' => $faker->sentence(30),
						'building_id' => $question->building_id,
						'respondent_id' => $respondent->id,
						'question_id' => $question->id,
                        'user_id' => $user_id

        			]);
        		}
        	}
        }

    }
}
