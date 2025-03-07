<?php

namespace App\Providers;

use App\Services\AdminGetAIText;
use App\Services\ChatgptTextService;
use App\Services\ClinetServeAIText;
use App\Services\GeminiTextService;
use App\Services\UserGetAIText;
use Illuminate\Support\ServiceProvider;

class AiTextServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     * This service provider is used for AiTextRelated services handling
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

         $this->app->singleton('AdminAIText', function () {
            return app()->make(AdminGetAIText::class);
        });

        $this->app->singleton('UserAIText', function () {
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
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
