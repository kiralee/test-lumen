<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableWagers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wagers', function (Blueprint $table) {
            $table->id();
            $table->integer("total_wager_value")->unsigned();
            $table->integer("odds")->unsigned();
            $table->integer("selling_percentage")->unsigned();
            $table->decimal("selling_price")->unsigned();
            $table->decimal("current_selling_price")->unsigned()->nullable();
            $table->integer("percentage_sold")->unsigned()->nullable();
            $table->decimal("amount_sold")->nullable()->nullable();
            $table->timestamp("placed_at");
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
        Schema::dropIfExists('wagers');
    }
}
