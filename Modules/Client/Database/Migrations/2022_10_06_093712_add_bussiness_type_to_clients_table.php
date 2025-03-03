<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->integer('years_in_business')->after('client_number')->nullable();
            $table->string('business_type')->after('client_number')->nullable();
            $table->string('employment_type')->after('client_number')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('years_in_business');
            $table->dropColumn('business_type');
            $table->dropColumn('employment_type');
        });
    }
};
