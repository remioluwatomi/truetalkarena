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
        Schema::create('admins', function (Blueprint $table) {

            $table->increments('adm_id');
            $table->string('adm_firstname');
            $table->string('adm_lastname');
            $table->string('adm_email');
            $table->string('adm_password');
            $table->string('adm_tel');
            $table->integer('adm_level');
            $table->string('adm_title');
            $table->string('adm_dp');
            $table->text('adm_bio');
            $table->enum('adm_status', ['active', 'inactive', 'deactivated'])->default('inactive');
            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
};
