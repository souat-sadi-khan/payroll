<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('from_account_id')->nullable();
            $table->foreign('from_account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->unsignedBigInteger('to_account_id')->nullable();
            $table->foreign('to_account_id')->references('id')->on('accounts')->onDelete('cascade');
            $table->date('date')->nullable();
            $table->double('amount', 2)->nullable();
            $table->string('payment_method')->nullable();
            $table->string('ref_no')->nullable();
            $table->longText('notes')->nullable();
            $table->string('file')->nullable();
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
        Schema::dropIfExists('transfers');
    }
}
