<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('voters', function (Blueprint $table) {
            $table->id();
            $table->string('national_id', 20)->unique();
            $table->string('full_name');
            $table->date('date_of_birth');
            $table->string('email')->unique();
            $table->string('phone', 15)->unique();
            $table->string('password');
            $table->boolean('is_verified')->default(false);
            $table->string('otp_code', 6)->nullable();
            $table->timestamp('otp_expires_at')->nullable();
            $table->integer('login_attempts')->default(0);
            $table->timestamp('locked_until')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('voters');
    }
};