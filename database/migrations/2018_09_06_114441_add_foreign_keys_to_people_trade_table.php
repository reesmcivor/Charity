<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPeopleTradeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('people_trade', function(Blueprint $table)
		{
			$table->foreign('people_id', 'people_trade_ibfk_10')->references('id')->on('people')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('trade_id', 'people_trade_ibfk_9')->references('id')->on('trades')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('people_trade', function(Blueprint $table)
		{
			$table->dropForeign('people_trade_ibfk_10');
			$table->dropForeign('people_trade_ibfk_9');
		});
	}

}
