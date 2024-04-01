<?php

use App\Models\Course;
use App\Models\Lecturer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];

        Schema::create('course_class', function (Blueprint $table) use ($days) {
            $table->id();
            $table->foreignIdFor(Course::class);
            $table->foreignId('class_id')
                ->constrained('classes')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignIdFor(Lecturer::class);
            $table->enum('day', $days);
            $table->time('start_time');
            $table->time('end_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_class');
    }
};
