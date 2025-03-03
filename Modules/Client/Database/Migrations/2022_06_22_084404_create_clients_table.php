<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique()->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name');
            $table->string('id_number')->unique();
            $table->date('date_of_birth')->nullable();
            $table->string('sex')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('phone')->nullable();
            $table->string('client_number')->nullable();
            $table->string('initials')->nullable();
            $table->string('address_line_1')->nullable();
            $table->string('address_line_2')->nullable();
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('address_code')->nullable();
            $table->string('postal_line_1')->nullable();
            $table->string('postal_line_2')->nullable();
            $table->string('postal_city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('postal_province')->nullable();
            $table->unsignedBigInteger('country_id')->nullable();
            $table->foreignId('centre_id')->nullable()->constrained();
            $table->foreignId('creator_id')->nullable()->constrained('users');
            $table->boolean('agreed_to_privacy_policy')->nullable();
            $table->string('slug');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
