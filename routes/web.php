<?php

use App\Facades\AdminAIText;
use App\Facades\UserAIText;
use App\Services\AdminGetAIText;
use App\Services\UserGetAIText;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/get-service', function () {

    /**
     * Here is the major dependency injection happening in this service
     * So for this service getting complicated, we can use the dependency injection via service container then it would be better
     */

    // $adminGetAIText = new AdminGetAIText(new \App\Services\ClinetServeAIText(new \App\Services\GeminiTextService()));

    /**
     * Via Service Container
     */

    $adminGetAIText = app()->make(AdminGetAIText::class);
    $userGetAIText = app()->make(UserGetAIText::class);

    /**
     * Now we will use aliases within facade for the services and it should work like static methods
     */
    return AdminAIText::getAdminText() .'<br>'. UserAIText::getUserText();
});
