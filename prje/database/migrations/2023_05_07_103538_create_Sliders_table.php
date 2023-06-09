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

            Schema::create('Sliders', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->timestamps();
                $table->string('slider_title')->nullable();
                $table->string('slider_slug')->nullable();
                $table->string('slider_url')->nullable();
                $table->string('slider_file')->nullable();
                $table->integer('slider_must')->nullable();
                $table->text('slider_content')->nullable();
                $table->enum('slider_status',['0','1'])->default(1);
            });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Sliders');
    }
};
