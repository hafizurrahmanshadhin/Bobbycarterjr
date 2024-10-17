<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('modules', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('course_id')->nullable(false);
            $table->foreign('course_id')->references('id')->on('courses')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->boolean('is_exam')->default(false);
            $table->text('question')->nullable();
            $table->integer('mark')->nullable();

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
        Schema::dropIfExists('modules');
    }
};
