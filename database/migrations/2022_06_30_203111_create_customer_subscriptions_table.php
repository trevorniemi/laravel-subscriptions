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
        Schema::create('customer_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('price');
            $table->enum('frequency', ['yearly', 'monthly']);
            $table->enum('status', ['active', 'disabled']);
            $table->string('term');
            $table->integer('quantity');
            $table->foreignId('customer_id')->constrained();
            $table->foreignId('subscription_id')->constrained();
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
        Schema::dropIfExists('customer_subscriptions');
    }
};
