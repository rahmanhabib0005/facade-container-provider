<?php

namespace App\Providers;

use App\Services\AdminGetAIText;
use App\Services\ChatgptTextService;
use App\Services\ClinetServeAIText;
use App\Services\GeminiTextService;
use App\Services\UserGetAIText;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        /**
         * This is a process how we can bind the interface with the class if we have need a single service at a time
         */
        // $this->app->when(AdminGetAIText::class)
        //     ->needs(ClinetServeAIText::class)
        //     ->give(function () {
        //         return new ClinetServeAIText(new GeminiTextService());
        //     });
        // $this->app->singleton(
        //     ClinetServeAIText::class,
        //     function ($app) {
        //         return new ClinetServeAIText(
        //             $app->make(\App\Interfaces\AiGeneratedTextInterface::class)
        //         );
        //     }
        // );

        /**
         * Otherwise we can bind like this for specific class
         */

        $this->app->singleton('AdminAIText', function ($app) {
            return app()->make(AdminGetAIText::class);
        });

        $this->app->singleton('UserAIText', function ($app) {
            return app()->make(UserGetAIText::class);
        });

        $this->app->when(AdminGetAIText::class)
            ->needs(ClinetServeAIText::class)
            ->give(function () {
                return new ClinetServeAIText(new GeminiTextService());
            });

        $this->app->when(UserGetAIText::class)
            ->needs(ClinetServeAIText::class)
            ->give(function () {
                return new ClinetServeAIText(new ChatgptTextService());
            });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
