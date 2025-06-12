<?php
namespace Amy\Numbersequence\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Amy\Numbersequence\Providers\BindServiceInterface;


class NumbersequenceServiceProvider extends ServiceProvider {
    public function boot(){
        Schema::defaultStringLength(191);

         $this->loadViewsFrom(__DIR__.'/../resources/views', 'number_sequence');

        // Optionally, publish views to the main project
        // $this->publishes([
        //     __DIR__.'/../resources/views' => resource_path('views/vendor/numbersequence'),
        // ], 'views');
    $this->loadViewsFrom(__DIR__.'/../resources/views', 'numbersequence');

    // $this->loadViewsFrom(__DIR__.'/../resources/views', 'NumberSequence'); // now blade load from here

    $this->mergeConfigFrom(__DIR__ . '/../../config/numbersequnce.php','numbersequnce'); //now number sequnce load from here
        // //Load routes
    $this->loadRoutesFrom(__DIR__.'/../routes/web.php'); //for route load from here

    $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

    }

    public function register(){

         $this->app->register(BindServiceInterface::class);
        $this->publishableFile();

    }

    //  for publish the file
   private function publishableFile(){
    $basePth = dirname(__DIR__);
    $publishArray = [
        'migrations'=> [
            "$basePth/../database/migrations" => database_path('migrations'),
        ],
        'config' => [
            "$basePth/../config/numbersequnce.php" => config_path('numbersequnce.php')
        ],
        'views' =>[
             "$basePth/./resources/views" => resource_path('views/numbersequence'),
        ]
    ];

    // for publish the file
    foreach ($publishArray as $group => $paths) {
        $this->publishes($paths, $group);
    }
}

}
