<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "body" => "required|min:5",
            "type" => "required|in:text,date,location,checkbox,rating,dropdown,radio_button",
            "min"     => "integer",
            "max"     => "integer",
            "options" => "",
            "building_id" => "required|integer|min:0|exist:building,id",
            "category_id" => "required|integer|min:0|exist:categories,id",
            "question_id" => "integer|min:0|exist:questions,id"
        ];
    }
}
