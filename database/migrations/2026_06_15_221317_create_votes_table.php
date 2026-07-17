<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('election_id')->constrained()->onDelete('cascade');
            $table->text('encrypted_vote'); // AES-256 encrypted candidate_id
            $table->string('vote_hash')->unique(); // integrity check
            $table->timestamp('voted_at')->useCurrent();
        });
    }
    public function down(): void {
        Schema::dropIfExists('votes');
    }
};