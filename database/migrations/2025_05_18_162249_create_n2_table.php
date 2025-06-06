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
        Schema::create('n2', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('map_name');
            $table->unsignedBigInteger('number_sequence_id');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('tbl_entity_id');
            $table->date('mapping_date');
            $table->timestamps(); // includes created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('n2');
    }
};
