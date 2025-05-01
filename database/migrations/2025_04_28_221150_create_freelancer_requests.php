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
        Schema::create('freelancer_requests', function (Blueprint $table) {
            $table->id();
            $table->string('owner');
            $table->string('address');
            $table->string('mobile');
            $table->string('stack');
            $table->string('project_file');
            $table->string('project_name');
            $table->string('project_description');
            $table->foreignId('freelancer_id')->constrained("freelancers");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freelancer_requests');
    }
};
