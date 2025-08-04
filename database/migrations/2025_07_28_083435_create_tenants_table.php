<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTenantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tenants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('tin')->nullable();
            $table->string('nida_number')->nullable();
            $table->string('nida_attachment')->nullable();
            $table->integer('property_id')->unsigned();
            $table->date('lease_start');
            $table->date('lease_end');
            $table->date('lease_attachment')->nullable();
            $table->string('total_amount'); //Based on 6 or 3 month
            $table->string('amount_paid'); //Based on 6 or 3 month
            $table->date('payment_date');
            $table->string('receipt_attachment')->nullable();
            $table->string('status')->default('paid')->nullable(); // paid, unpaid
            $table->timestamps();

            $table->foreign('property_id')->references('id')->on('properties')->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tenants');
    }
}
