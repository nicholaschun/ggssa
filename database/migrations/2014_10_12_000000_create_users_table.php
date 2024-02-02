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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('title')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('gender')->nullable();
            $table->string('employment_date')->nullable();
            $table->string('join_ggssa_date')->nullable();
            $table->string('gngc_staff_number')->nullable();
            $table->string('department')->nullable();
            $table->string('gngc_job_title')->nullable();
            $table->string('workstation')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('gngc_email')->nullable();
            $table->string('marital_status')->nullable();
            $table->integer('number_of_children')->nullable();
            $table->string('religion')->nullable();
            $table->string('profile_photo')->nullable();
            $table->boolean('status')->nullable();
            $table->boolean('profile_set')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
