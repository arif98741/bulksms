<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id');
            $table->unsignedBigInteger('contact_id')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();

            $table->foreign('group_id')->references('id')->on('groups')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreign('contact_id')->references('id')->on('contacts')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('set null');
            $table->foreign('updated_by')->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('set null');
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
        Schema::dropIfExists('group_contacts');
    }
};
