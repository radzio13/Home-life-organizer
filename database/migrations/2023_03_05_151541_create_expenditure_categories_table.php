<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenditureCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenditure_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->comment('Nazwa kategorii wydatków');
            $table->string('code', 64)->unique()->comment('Kod kategorii wydatków');
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
        Schema::dropIfExists('expenditure_categories');
    }
}
