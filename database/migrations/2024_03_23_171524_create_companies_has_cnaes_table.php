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
        Schema::create('companies_has_cnaes', function (Blueprint $table) {
            $table->increments('id');      
            $table->integer('companies_id')->unsigned();
            $table->integer('cnaes_id')->unsigned();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('companies_has_cnaes', function ($table) {
            $table->foreign('companies_id')->references('id')->on('companies')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });  
        Schema::table('companies_has_cnaes', function ($table) {
            $table->foreign('cnaes_id')->references('id')->on('cnaes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });                  
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies_has_cnaes');
    }
};
