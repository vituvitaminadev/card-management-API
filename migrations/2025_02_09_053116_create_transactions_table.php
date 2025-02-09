<?php

declare(strict_types=1);

use Hyperf\Database\Migrations\Migration;
use Hyperf\Database\Schema\Blueprint;
use Hyperf\Database\Schema\Schema;

return new class extends Migration {
	/**
	 * Run the migrations.
	 */
	public function up(): void
	{
		Schema::create('transactions', function (Blueprint $table) {
			$table->bigIncrements('id');

			$table->unsignedBigInteger('user_id');
			$table->foreign('user_id')->references('id')->on('users');

			$table->unsignedBigInteger('card_id');
			$table->foreign('card_id')->references('id')->on('cards');

			$table->string('description');
			$table->string('type');
			$table->integer('value');

			$table->datetimes();
		});
	}

	/**
	 * Reverse the migrations.
	 */
	public function down(): void
	{
		Schema::dropIfExists('transactions');
	}
};
