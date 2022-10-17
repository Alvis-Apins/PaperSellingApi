<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSaleWarehousePivotTable extends Migration
{
    public function up()
    {
        Schema::create('sale_warehouse', function (Blueprint $table) {
            $table->unsignedBigInteger('sale_id')->index();
            $table->unsignedBigInteger('warehouse_id')->index();
            $table->foreign('sale_id')->references('id')->on('sales')->onDelete('cascade');
            $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade');
            $table->primary(['sale_id', 'warehouse_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('sale_warehouse');
    }
}
