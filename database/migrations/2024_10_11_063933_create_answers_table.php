<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('answers', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('task_id')->nullable(false);
            $table->foreign('task_id')->references('id')->on('tasks')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->string('url')->nullable();
            $table->longText('answer')->nullable();

            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('answers');
    }
};
