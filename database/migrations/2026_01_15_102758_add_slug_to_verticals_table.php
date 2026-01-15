<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSlugToVerticalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
  public function up()
{
    Schema::table('verticals', function (Blueprint $table) {
        $table->string('slug')->unique()->after('vertical_name');
    });
}

public function down()
{
    Schema::table('verticals', function (Blueprint $table) {
        $table->dropColumn('slug');
    });
}

}