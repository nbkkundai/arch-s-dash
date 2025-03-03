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
        Schema::create('process_questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('process_id')->constrained();
            $table->string('name');
            $table->enum('type', ["text","number","single_select","multi_select","upload"]);
            $table->boolean('is_active');
            $table->boolean('is_required');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('process_questions');
    }
};
