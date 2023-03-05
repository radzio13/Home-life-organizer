<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->comment('Nazwa przedsiębiorcy');
            $table->string('short_name', 255)->nullable()->comment('Krótka nazwa przedsiębiorcy');
            $table->string('tax_number', 32)->nullable()->comment('NIP');
            $table->string('city', 255)->nullable()->comment('Miejscowość');
            $table->string('street', 255)->nullable()->comment('Ulica');
            $table->string('zip_code', 12)->nullable()->comment('Kod pocztowy');
            $table->string('country', 32)->nullable()->comment('Kraj');
            $table->string('phone_number', 32)->nullable()->comment('Numer telefonu');
            $table->string('email', 64)->nullable()->comment('Adres e-mail');
            $table->string('account_number', 64)->nullable()->comment('Numer konta');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contractors');
    }
}
