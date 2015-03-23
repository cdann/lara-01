<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\user;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('email')->unique();
			$table->string('password', 60);
			$table->boolean('statut')->default(0);
			$table->rememberToken();
			$table->timestamps();
		});
		$users = ["name" => "admin", "password" => bcrypt("administration"), "email" => "admin@default.fr", "statut" => true];
		User::create($users);
		$users = ["name" => "default", "password" => bcrypt("userdefault"), "email" => "user@default.fr"];
		User::create($users);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
	}

}
