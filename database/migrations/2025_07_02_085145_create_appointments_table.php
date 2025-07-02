<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tb_appointments', function (Blueprint $table) {
        $table->id('appointment_id'); 
        $table->string('title');
        $table->text('description')->nullable();
 
        $table->foreignId('client_id')->constrained('tb_users', 'user_id')->onDelete('cascade');
        $table->foreignId('host_id')->constrained('tb_users', 'user_id')->onDelete('cascade');
            
        $table->dateTime('start_time');
        $table->dateTime('end_time');
        $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tb_appointments');
    }
};
