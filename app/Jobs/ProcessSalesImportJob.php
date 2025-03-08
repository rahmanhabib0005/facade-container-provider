<?php

namespace App\Jobs;

use App\Models\Sale;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Log;

class ProcessSalesImportJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private array $rowData, private array $mapping) {}
    public function handle()
    {
        try {
            Sale::create(
                [
                    "Region" => $this->rowData[$this->mapping["Region"]],
                    "Country" => $this->rowData[$this->mapping["Country"]],
                    "ItemType" => $this->rowData[$this->mapping["ItemType"]],
                    "SalesChannel" => $this->rowData[$this->mapping["SalesChannel"]],
                    "OrderPriority" => $this->rowData[$this->mapping["OrderPriority"]],
                    "OrderDate" => $this->rowData[$this->mapping["OrderDate"]],
                    "OrderID" => $this->rowData[$this->mapping["OrderID"]],
                    "ShipDate" => $this->rowData[$this->mapping["ShipDate"]],
                    "UnitsSold" => $this->rowData[$this->mapping["UnitsSold"]],
                    "UnitPrice" => $this->rowData[$this->mapping["UnitPrice"]],
                    "UnitCost" => $this->rowData[$this->mapping["UnitCost"]],
                    "TotalRevenue" => $this->rowData[$this->mapping["TotalRevenue"]],
                    "TotalCost" => $this->rowData[$this->mapping["TotalCost"]],
                    "TotalProfit" => $this->rowData[$this->mapping["TotalProfit"]],
                ]
            );
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            Log::info(json_encode($this->rowData));
        }
    }
}
