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
    Schema::table('licences', function (Blueprint $table) {
        // إلى عندك داتا قديمة وخايف تكسّر الإنسرشن، خليه nullable فالأول
        $table->unsignedBigInteger('id_utilisateur')->nullable()->after('id_licence');

        // إلا كان ال PK فجدول utilisateurs هو id_utilisateur (وماشي id)
        $table->foreign('id_utilisateur')
              ->references('id_utilisateur')
              ->on('utilisateurs')
              ->cascadeOnDelete(); // اختياري حسب الحاجة
    });
}

public function down(): void
{
    Schema::table('licences', function (Blueprint $table) {
        $table->dropForeign(['id_utilisateur']);
        $table->dropColumn('id_utilisateur');
    });
}
};