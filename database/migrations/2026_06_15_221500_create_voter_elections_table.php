<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('voter_elections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('voter_id')->constrained()->onDelete('cascade');
            $table->foreignId('election_id')->constrained()->onDelete('cascade');
            $table->boolean('has_voted')->default(false);
            $table->timestamp('voted_at')->nullable();
            $table->unique(['voter_id', 'election_id']); // one vote per election
        });
    }
    public function down(): void {
        Schema::dropIfExists('voter_elections');
    }
};