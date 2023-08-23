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
        $table->unsignedBigInteger('club_id')->nullable();
        $table->string('filename')->nullable();
        $table->string('path')->nullable();
        $table->unsignedBigInteger('advisor_id')->nullable();
        $table->string('advisor_approval')->default('PENDING');
        $table->string('director_approval')->default('PENDING');
        $table->string('budget_approve')->nullable();
        $table->string('start_date')->nullable();
        $table->string('end_date')->nullable();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('approvals', function (Blueprint $table) {
            //
        });
    }
};
