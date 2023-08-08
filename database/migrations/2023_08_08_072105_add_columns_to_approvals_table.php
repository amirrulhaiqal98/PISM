<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToApprovalsTable extends Migration
{
    public function up()
    {
        Schema::table('approvals', function (Blueprint $table) {
            $table->text('description')->nullable();
            $table->decimal('budget', 10, 2)->nullable();
            $table->string('venue')->nullable();
            $table->integer('participant')->nullable();
        });
    }

    public function down()
    {
        Schema::table('approvals', function (Blueprint $table) {
            $table->dropColumn(['description', 'budget', 'venue', 'participant']);
        });
    }
}
