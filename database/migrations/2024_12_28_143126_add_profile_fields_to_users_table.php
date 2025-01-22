<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
/**
* Run the migrations.
*/
public function up(): void
{
Schema::table('users', function (Blueprint $table) {
$table->string('first_name')->nullable();
$table->string('last_name')->nullable();
$table->string('patronymic')->nullable();
$table->date('birthdate')->nullable();
$table->string('address')->nullable();
$table->string('region')->nullable();
$table->string('district')->nullable();
$table->string('village')->nullable();
$table->string('new_post_address')->nullable();
});
}

/**
* Reverse the migrations.
*/
public function down(): void
{
Schema::table('users', function (Blueprint $table) {
$table->dropColumn('first_name');
$table->dropColumn('last_name');
$table->dropColumn('patronymic');
$table->dropColumn('birthdate');
$table->dropColumn('address');
$table->dropColumn('region');
$table->dropColumn('district');
$table->dropColumn('village');
$table->dropColumn('new_post_address');
});
}
};
