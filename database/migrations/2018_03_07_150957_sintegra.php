<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Sintegra extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sintegra', function (Blueprint $table) {
		            $table->increments('id');
		            $table->integer('id_usuario');
		            $table->string('cnpj');
		            $table->text('json');
		        });	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
