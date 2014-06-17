<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMemberSkillTable extends Migration {

	public function up()
	{
		Schema::create('member_skill', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('skill_id')->unsigned();
			$table->integer('member_id')->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('member_skill');
	}
}