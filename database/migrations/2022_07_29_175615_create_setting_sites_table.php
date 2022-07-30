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
        Schema::create('setting_sites', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->string('amazon_site_id');
            $table->enum('status', ['completed', 'pending', 'in-progress', 'incomplete'])->default('incomplete');         
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
        Schema::dropIfExists('setting_sites');
    }
};
