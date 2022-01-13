<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExternalAuthsTable extends Migration
{
    public function up()
    {
        Schema::create('external_auths', function (Blueprint $table) {

            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->string('token', 500);
            $table->string('provider');
            $table->string('provider_id');
            $table->timestamps();
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('external_auths');
    }
}
