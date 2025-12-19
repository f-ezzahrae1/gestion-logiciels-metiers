<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('logiciels', function (Blueprint $table) {
            $table->id('id_logiciel'); // primary key
            $table->string('nom');
            $table->string('version');
            $table->text('description')->nullable();
            $table->date('date_installation')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('logiciels');
    }
};
