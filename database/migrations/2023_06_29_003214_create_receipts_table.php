<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('client_name');
            $table->string('client_phone');
            $table->string('client_email');
            $table->string('estate_name');
            $table->string('payment_type');
            $table->string('payment_date');
            $table->integer('plots');
            $table->string('payment_plan');
            $table->string('bank');
            $table->string('account_name');
            $table->string('amount');
            $table->string('description');
            $table->string('file');
            $table->string('status')->default('PENDING');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receipts');
    }
};
