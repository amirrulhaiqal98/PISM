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
        Schema::table('approvals', function (Blueprint $table) {
            $table->renameColumn('remark', 'advisor_remark');
            $table->text('director_remark')->nullable();
        });
    }

    public function down()
    {
        Schema::table('approvals', function (Blueprint $table) {
            $table->renameColumn('advisor_remark', 'remark');
            $table->dropColumn('director_remark');
        });
    }
};
