<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('comment');
            $table->text('img_path');
            $table->timestamps();
        });
    }
    
    public function down()
    { 
        Schema::dropIfExists('characters');
    }
};
