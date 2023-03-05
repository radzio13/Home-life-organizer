<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenditureTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expenditure', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->comment('ID użytkownika');
            $table->unsignedBigInteger('expenditure_category_id')->comment('ID kategorii wydatku');
            $table->unsignedBigInteger('company_id')->nullable()->comment('ID przedsiębiorcy');
            $table->string('name', 255)->comment('Nazwa');
            $table->longText('description')->nullable()->comment('Dokładniejszy opis wydatku');
            $table->decimal('value_total', 16)->comment('Cała kwota');
            $table->decimal('value_other_user', 16)->default(0.0)->comment('Kwota innej osoby');
            $table->unsignedBigInteger('value_other_user_id')->nullable()->comment('Kwota innej osoby user ID');
            $table->decimal('value_user', 16)->nullable()->comment('Kwota po odliczeniu innej osoby');
            $table->date('date_of_expenditure')->comment('Data wydatku/zakupu');
            $table->string('place_of_expenditure')->nullable()->comment('Miejsce wydatku/zakupu');
            $table->unsignedBigInteger('payment_method_id')->comment('ID metody płatności');

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('expenditure_category_id')->references('id')->on('expenditure_categories');
            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('value_other_user_id')->references('id')->on('users');
            $table->foreign('payment_method_id')->references('id')->on('payments_methods');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('expenditure');
    }
}
