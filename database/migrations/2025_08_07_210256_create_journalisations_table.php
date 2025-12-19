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
    Schema::create('journalisations', function (Blueprint $table) {
        $table->id('id_journalisation');
        $table->unsignedBigInteger('id_utilisateur');
        $table->unsignedBigInteger('id_logiciel');
        $table->unsignedBigInteger('id_licence');
        $table->string('action');
        $table->date('date_action');
        $table->timestamps();

        $table->foreign('id_utilisateur')->references('id_utilisateur')->on('utilisateurs')->onDelete('cascade');
        $table->foreign('id_logiciel')->references('id_logiciel')->on('logiciels')->onDelete('cascade');
        $table->foreign('id_licence')->references('id_licence')->on('licences')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journalisations');
    }
};
