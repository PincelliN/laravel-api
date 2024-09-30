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
        Schema::table('works', function (Blueprint $table) {
            $table->unsignedBigInteger('type_id')->nullable()->after('id');

        /*  Definisce una chiave esterna sulla colonna 'type_id' che fa riferimento alla colonna 'id' nella tabella 'types'
        Se un record in 'types' viene eliminato, imposta il valore di 'type_id' su NULL */

            $table->foreign('type_id')
            ->references('id')
            ->on('types')
            ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('works', function (Blueprint $table) {

           /*  $table->dropForeign('works_type_id_foreign'); */
           // Elimina la chiave esterna associata a 'type_id'
           $table->dropForeign(['type_id']);

           $table->dropColumn('type_id');
        });
    }
};