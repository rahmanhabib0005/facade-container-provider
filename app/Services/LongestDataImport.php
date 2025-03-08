<?php

namespace App\Services;

use App\Models\Sale;
use Illuminate\Support\Facades\DB;

class LongestDataImport
{
    /**
     * This process is pretty much faster than queue job
     * I have imported 1M rows in some few minutes but when I tried to import 1M rows via queue job it took me hours
     * So I would recommend this process for importing large data
     * Yes thats true for this process you have put some extra memory limit in your php.ini file based on longest data
     */
    public function importData()
    {
        $filePath = public_path('1M.csv');
        $fileStream = fopen($filePath, 'r');

        $fieldMap = [
            "Region" => 0,
            "Country" => 1,
            "ItemType" => 2,
            "SalesChannel" => 3,
            "OrderPriority" => 4,
            "OrderDate" => 5,
            "OrderID" => 6,
            "ShipDate" => 7,
            "UnitsSold" => 8,
            "UnitPrice" => 9,
            "UnitCost" => 10,
            "TotalRevenue" => 11,
            "TotalCost" => 12,
            "TotalProfit" => 13,
        ];

        // Skip Header
        fgetcsv($fileStream);

        $batchSize = 4000; // Process 4,000 rows per insert
        $batch = [];

        DB::disableQueryLog(); // Prevent memory leak

        while (($line = fgetcsv($fileStream)) !== false) {
            $batch[] = [
                "Region" => $line[$fieldMap["Region"]],
                "Country" => $line[$fieldMap["Country"]],
                "ItemType" => $line[$fieldMap["ItemType"]],
                "SalesChannel" => $line[$fieldMap["SalesChannel"]],
                "OrderPriority" => $line[$fieldMap["OrderPriority"]],
                "OrderDate" => $line[$fieldMap["OrderDate"]],
                "OrderID" => $line[$fieldMap["OrderID"]],
                "ShipDate" => $line[$fieldMap["ShipDate"]],
                "UnitsSold" => $line[$fieldMap["UnitsSold"]],
                "UnitPrice" => $line[$fieldMap["UnitPrice"]],
                "UnitCost" => $line[$fieldMap["UnitCost"]],
                "TotalRevenue" => $line[$fieldMap["TotalRevenue"]],
                "TotalCost" => $line[$fieldMap["TotalCost"]],
                "TotalProfit" => $line[$fieldMap["TotalProfit"]],
            ];

            if (count($batch) >= $batchSize) {
                // Sale::insert($batch); // Bulk Insert
                $batch = []; // Clear batch
            }
        }

        // Insert remaining batch
        if (!empty($batch)) {
            // Sale::insert($batch);
        }

        fclose($fileStream);

        return response()->json(['message' => 'Data imported successfully!']);
    }
}
