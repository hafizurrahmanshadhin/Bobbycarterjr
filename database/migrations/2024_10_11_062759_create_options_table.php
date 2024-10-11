<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('options', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('survay_question_id')->nullable(false);
            $table->foreign('survay_question_id')->references('id')->on('survay_questions')
                ->onDelete('restrict')
                ->onUpdate('cascade');

            $table->string('options')->nullable(false);
            $table->boolean('is_correct')->default(false);

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
        Schema::dropIfExists('options');
    }
};
