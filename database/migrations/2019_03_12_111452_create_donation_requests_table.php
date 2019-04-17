<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateDonationRequestsTable extends Migration {

	public function up()
	{
		Schema::create('donation_requests', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('patient_name');
			$table->integer('patient_age');
			$table->integer('blood_type_id')->unsigned();
			$table->integer('blood_number');
			$table->string('hospital_name');
			$table->string('phone');
			$table->text('notes');
			$table->integer('client_id')->unsigned();
			$table->integer('city_id')->unsigned();
			$table->decimal('latitude', 10,8)->nullable();
			$table->decimal('longitude', 10,8)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('donation_requests');
	}
}