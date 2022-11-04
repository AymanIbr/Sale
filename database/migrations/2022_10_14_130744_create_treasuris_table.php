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
        Schema::create('treasuris', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->tinyInteger('is_master')->default(0);
            $table->tinyInteger('last_isal_exhcange');
            $table->tinyInteger('last_isal_collect');
            $table->Integer('added_by');
            $table->Integer('updated_by');
            $table->Integer('com_code');
            $table->tinyInteger('active')->default(1);
            $table->date('date');
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
        Schema::dropIfExists('treasuris');
    }
};
