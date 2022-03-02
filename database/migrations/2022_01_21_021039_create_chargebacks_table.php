<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChargebacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chargebacks', function (Blueprint $table) {
            $table->id();
            $table->string('ref_id')->unique();
            $table->string('arn');
            $table->string('card_number');
            $table->string('approval_code')->nullable()->default(000000);
            $table->string('transaction_date');
            $table->date('opencase_date');
            $table->date('expired_date');
            $table->string('merchant')->nullable()->default('-');
            $table->string('mid')->nullable()->default(0);
            $table->string('tid')->nullable();
            $table->decimal('amount', 18, 2);
            $table->string('status');

            $table->unsignedBigInteger('principal_id');
            $table->unsignedBigInteger('reason_code_id');
            $table->unsignedBigInteger('level_id');
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
        Schema::dropIfExists('chargebacks');
    }
}
