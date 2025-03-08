<?php

use App\Facades\AdminAIText;
use App\Facades\UserAIText;
use App\Models\Sale;
use App\Services\AdminGetAIText;
use App\Services\UserGetAIText;
use Illuminate\Support\Facades\DB;
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
    return AdminAIText::getAdminText() . '<br>' . UserAIText::getUserText();
});

// Route::get('/test', function () {
//     $fieldMap = [
//         "Region" => 0,
//         "Country" => 1,
//         "ItemType" => 2,
//         "SalesChannel" => 3,
//         "OrderPriority" => 4,
//         "OrderDate" => 5,
//         "OrderID" => 6,
//         "ShipDate" => 7,
//         "UnitsSold" => 8,
//         "UnitPrice" => 9,
//         "UnitCost" => 10,
//         "TotalRevenue" => 11,
//         "TotalCost" => 12,
//         "TotalProfit" => 13,
//     ];

//     // Open the file for reading
//     $fileStream = fopen(public_path('1M.csv'), 'r');

//     $skipHeader = true;
//     $data = [];
//     while (($line = fgetcsv($fileStream)) !== false) {
//         if ($skipHeader) {
//             // Skip the header
//             $skipHeader = false;
//             continue;
//         }

//         $data[] = [
//             "Region" => $line[$fieldMap["Region"]],
//             "Country" => $line[$fieldMap["Country"]],
//             "ItemType" => $line[$fieldMap["ItemType"]],
//             "SalesChannel" => $line[$fieldMap["SalesChannel"]],
//             "OrderPriority" => $line[$fieldMap["OrderPriority"]],
//             "OrderDate" => $line[$fieldMap["OrderDate"]],
//             "OrderID" => $line[$fieldMap["OrderID"]],
//             "ShipDate" => $line[$fieldMap["ShipDate"]],
//             "UnitsSold" => $line[$fieldMap["UnitsSold"]],
//             "UnitPrice" => $line[$fieldMap["UnitPrice"]],
//             "UnitCost" => $line[$fieldMap["UnitCost"]],
//             "TotalRevenue" => $line[$fieldMap["TotalRevenue"]],
//             "TotalCost" => $line[$fieldMap["TotalCost"]],
//             "TotalProfit" => $line[$fieldMap["TotalProfit"]],
//         ];
//     }
// });

Route::get('/test', function () {
    dd(Sale::count());
});
