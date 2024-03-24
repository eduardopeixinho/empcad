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
        Schema::create('legal_forms', function (Blueprint $table) {
            $table->increments('id');      
            $table->integer('legal_forms_types_id')->unsigned();
            $table->string('description');
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::table('legal_forms', function ($table) {
            $table->foreign('legal_forms_types_id')->references('id')->on('legal_forms_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });         
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('legal_forms');
    }
};
