<?php

namespace App\Providers;

use Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('role_color', function($role) {

            $valid = "<?php ";
            $valid .= " if($role == 1){ echo 'class=\"label bg-red\"';}";
            $valid .= " elseif($role == 2){ echo 'class=\"label bg-green\"';}";
            $valid .= " elseif($role == 3){ echo 'class=\"label bg-yellow\"';}";
            $valid .= " elseif($role == 4){ echo 'class=\"label bg-blue\"';}";
            $valid .= "?>";

            return $valid;

        });
    }
}
