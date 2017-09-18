<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \View::share('mysqli', mysqli_connect(env("DB_HOST"), env("DB_USERNAME"), env("DB_PASSWORD"), env("DB_DATABASE")));
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
         require_once __DIR__ . "/../Helpers/License.php";
         require_once __DIR__ . "/../Helpers/Question.php";
         require_once __DIR__ . "/../Helpers/Report.php";
         require_once __DIR__ . "/../Helpers/ApiTransformer.php";
         require_once __DIR__ . "/../../content/apl_core_configuration.php";
         require_once __DIR__ . "/../../content/apl_core_functions.php";
         
         
         version_compare(PHP_VERSION, "5.5.0", "<") ? require_once __DIR__ . "/../../content/password_hash.php" : "";
    }
}
