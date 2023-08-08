<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToClubTypesTable extends Migration
{
    public function up()
    {
        Schema::table('club_types', function (Blueprint $table) {
            $table->text('club_description')->nullable();
            $table->string('club_email')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->unsignedBigInteger('advisor_id')->nullable();
            $table->string('advisor_email')->nullable();
            $table->string('advisor_phone')->nullable();
            $table->unsignedBigInteger('president_id')->nullable();
            $table->unsignedBigInteger('secretary_id')->nullable();
            $table->unsignedBigInteger('treasurer_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('club_types', function (Blueprint $table) {
            $table->dropColumn([
                'club_description',
                'club_email',
                'status',
                'advisor_id',
                'advisor_email',
                'advisor_phone',
                'president_id',
                'secretary_id',
                'treasurer_id',
            ]);
        });
    }
}
