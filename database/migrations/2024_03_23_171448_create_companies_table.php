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
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');      
            $table->string('cnpj');
            $table->integer('companies_types_id')->unsigned();
            $table->integer('size_companies_id')->unsigned();
            $table->string('name');
            $table->string('business_name');
            $table->integer('cnaes_id')->unsigned();
            $table->integer('legal_forms_id')->unsigned();
            $table->integer('addresses_id')->unsigned();
            $table->string('efr');
            $table->string('registration_status');
            $table->date('dt_reg_status');
            $table->date('reason_reg_status');
            $table->string('status');
            $table->date('dt_special_status');
            $table->date('dt_estabilishment');
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::table('companies', function ($table) {
            $table->foreign('companies_types_id')->references('id')->on('companies_types')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });  
        Schema::table('companies', function ($table) {
            $table->foreign('size_companies_id')->references('id')->on('size_companies')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });          
        Schema::table('companies', function ($table) {
            $table->foreign('cnaes_id')->references('id')->on('cnaes')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        }); 
        Schema::table('companies', function ($table) {
            $table->foreign('legal_forms_id')->references('id')->on('legal_forms')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });   
        Schema::table('companies', function ($table) {
            $table->foreign('addresses_id')->references('id')->on('addresses')->onUpdate('NO ACTION')->onDelete('NO ACTION');
        });          
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
