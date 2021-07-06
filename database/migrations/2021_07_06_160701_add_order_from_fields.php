<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrderFromFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('fromName')->default('Киноклуб K-INO.RU');
            $table->string('fromAddress')->default('г. Ростов-на-Дону, а/я 5560');
            $table->string('fromIndex')->default('344016');
            $table->string('customText')->default('Пусть исполнится то, что задумано!');
            $table->string('social')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            //
        });
    }
}
