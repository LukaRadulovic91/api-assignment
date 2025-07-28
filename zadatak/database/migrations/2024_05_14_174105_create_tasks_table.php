<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', static function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->string('task_name');
            $table->text('description');
            $table->date('due_date');
            $table->integer('priority');
            $table->timestamps();

            $table->foreign('project_id')->references('id')->on('projects')
                ->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
