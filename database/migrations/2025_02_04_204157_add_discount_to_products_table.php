<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiscountToProductsTable extends Migration
{

    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('discount', 5, 2)->nullable()->after('price'); // добавление поля discount
        });
    }
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('discount');
        });
    }
}
