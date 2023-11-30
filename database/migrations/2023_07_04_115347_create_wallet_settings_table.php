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
        Schema::create('wallet_settings', function (Blueprint $table) {
            $table->id();
            $table->string('first_interest');
            $table->string('second_interest');
            $table->string('third_interest');
            $table->string('minimum_payout');
            $table->timestamps();
        });

        $s = new \App\Models\WalletSetting();
        $s->first_interest = 30;
        $s->second_interest = 15;
        $s->third_interest = 5;
        $s->minimum_payout = 5000;
        $s->save();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wallet_settings');
    }
};
