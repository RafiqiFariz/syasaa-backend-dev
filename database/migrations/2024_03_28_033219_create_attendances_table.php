<?php

use App\Models\AttendanceRequest;
use App\Models\Student;
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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Student::class);
            $table->foreignIdFor(AttendanceRequest::class);
            $table->foreignId('course_class_id')
                ->constrained('course_class')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->string('student_image');
            $table->string('lecturer_image');
            $table->boolean('is_present');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
