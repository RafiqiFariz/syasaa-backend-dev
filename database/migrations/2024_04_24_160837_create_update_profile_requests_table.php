<?php

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
        Schema::create('update_profile_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Student::class);
            $table->string('image');
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->string('changed_data');
            $table->string('change_to');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('update_profile_requests');
    }
};
