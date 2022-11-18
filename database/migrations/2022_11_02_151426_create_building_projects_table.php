<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('building_projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->nullable();
            $table->string('investment');
            $table->string('progress');
            $table->string('stuck')->nullable();
            $table->string('leader_direction')->nullable();
            $table->string('construction_company')->nullable();
            $table->string('audit_company')->nullable();
            $table->string('application_procedure')->nullable();
            $table->string('settlement')->nullable();
            $table->string('report')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('building_projects');
    }
};
