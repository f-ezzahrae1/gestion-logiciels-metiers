<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('logiciels', function (Blueprint $table) {
            if (Schema::hasColumn('logiciels', 'id_utilisateur')) {
                $table->dropColumn('id_utilisateur');
            }
        });
    }

    public function down()
    {
        Schema::table('logiciels', function (Blueprint $table) {
            $table->unsignedBigInteger('id_utilisateur')->nullable();
        });
    }
};
