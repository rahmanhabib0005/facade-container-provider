<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SalesImportJob implements ShouldQueue
{
    use Queueable, Dispatchable, InteractsWithQueue, SerializesModels;

    public $timeout = 1200;
    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
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
 
        // Open the file for reading
        $fileStream = fopen(public_path('1M.csv'), 'r');
 
        $skipHeader = true;
        while (($line = fgetcsv($fileStream)) !== false) {
            Log::info('Processing line');
            if ($skipHeader) {
                // Skip the header
                $skipHeader = false;
                continue;
            }
            // For each line, we dispatch a job to process the line
            dispatch(new ProcessSalesImportJob($line, $fieldMap));
        }
 
        fclose($fileStream);
    
    }
}
