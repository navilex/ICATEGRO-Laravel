<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lista_cursos_alumnos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->string('group_status')->nullable();
            $table->string('plantel')->nullable();
            $table->string('group_id')->nullable();
            $table->string('name')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('student_status')->nullable();
            $table->string('grade')->nullable();
            $table->string('doc_type')->nullable();
            $table->string('folio')->nullable();
            $table->timestamps();

            // Foreign key layout
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lista_cursos_alumnos');
    }
};
