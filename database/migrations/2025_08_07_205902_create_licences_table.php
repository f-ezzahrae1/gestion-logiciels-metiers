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
    Schema::create('licences', function (Blueprint $table) {
        $table->id('id_licence');
        $table->unsignedBigInteger('id_logiciel');
        $table->string('cle_licence');
        $table->date('date_acquisition');
        $table->string('status');
        $table->string('type_licence');
        $table->string('contrat')->nullable();
        $table->timestamps();

        $table->foreign('id_logiciel')->references('id_logiciel')->on('logiciels')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('licences');
    }
};
