<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('client_id')->default(0);
            $table->decimal('total', 6,2)->default(0);
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->string('street')->nullable();
            $table->string('house')->nullable();
            $table->string('building')->nullable();
            $table->string('entrance')->nullable();
            $table->string('entrance_code')->nullable();
            $table->string('floor')->nullable();
            $table->string('apartments')->nullable();
            $table->string('comment')->nullable();
            $table->unsignedInteger('payment_code')->default(0);
            $table->unsignedInteger('payment_method')->default(0);
            $table->unsignedInteger('payment_change')->nullable();
            $table->unsignedInteger('delivery_code')->default(1);
            $table->dateTime('delivery_time')->nullable();
            $table->unsignedInteger('expert_status')->default(0);
            $table->ipAddress('ip_address')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
