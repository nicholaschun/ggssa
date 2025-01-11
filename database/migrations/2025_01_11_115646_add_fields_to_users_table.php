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
        Schema::table('users', function (Blueprint $table) {
            $table->string('emergency_contact_name')->nullable();
            $table->string('relationship_with_emergency_contact')->nullable();
            $table->string('next_of_kin')->nullable();
            $table->string('next_of_kin_contact')->nullable();
            $table->string('relationship_with_next_of_kin')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'emergency_contact_name',
                'relationship_with_emergency_contact',
                'next_of_kin',
                'next_of_kin_contact',
                'relationship_with_next_of_kin'
            ]);
        });
    }
};
