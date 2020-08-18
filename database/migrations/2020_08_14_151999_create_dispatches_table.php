<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispatchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dispatches', function (Blueprint $table) {
            $table->id();
            $table->string('delivery_no')->unique();
            $table->string('shipment_no')->nullable();
            $table->integer('source_id')->index();
            $table->integer('destination_id')->index();
            $table->longText('address');
            $table->integer('transporter_id')->index();
            $table->boolean('isDeleted')->default(0);
            $table->integer('driver_id')->index();
            $table->integer('vehicle_id')->index();
            $table->date('startDate');
            $table->date('endDate');
            $table->timestamps();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dispatches');
    }
}
