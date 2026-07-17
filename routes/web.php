<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VoterAuthController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\VoterController;
use App\Http\Controllers\VotingController;

// ── Home ──────────────────────────────────────────
Route::get('/', function () {
    return view('welcome');
});

// ── Voter Auth & Voting ───────────────────────────
Route::prefix('voter')->name('voter.')->group(function () {
    Route::get('/register', [VoterAuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [VoterAuthController::class, 'register']);
    Route::get('/login', [VoterAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [VoterAuthController::class, 'login']);
    Route::get('/otp', [VoterAuthController::class, 'showOtp'])->name('otp');
    Route::post('/otp', [VoterAuthController::class, 'verifyOtp']);
    Route::post('/logout', [VoterAuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [VoterController::class, 'dashboard'])->name('dashboard');

    // Voting
    Route::get('/vote/{election}', [VotingController::class, 'showVote'])->name('voting.vote');
    Route::post('/vote/{election}', [VotingController::class, 'castVote'])->name('voting.cast');
    Route::get('/vote/{election}/confirmation', [VotingController::class, 'confirmation'])->name('voting.confirmation');
});

// ── Admin ─────────────────────────────────────────
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login']);
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', function() { return view('admin.dashboard'); })->name('dashboard');
// Voter Management
Route::get('/voters', [App\Http\Controllers\Admin\VoterManagementController::class, 'index'])->name('voters.index');
Route::get('/voters/{voter}/edit', [App\Http\Controllers\Admin\VoterManagementController::class, 'edit'])->name('voters.edit');
Route::put('/voters/{voter}', [App\Http\Controllers\Admin\VoterManagementController::class, 'update'])->name('voters.update');
Route::post('/voters/{voter}/toggle-verify', [App\Http\Controllers\Admin\VoterManagementController::class, 'toggleVerify'])->name('voters.toggleVerify');
Route::delete('/voters/{voter}', [App\Http\Controllers\Admin\VoterManagementController::class, 'destroy'])->name('voters.destroy');
    // Results
Route::get('/results', [App\Http\Controllers\Admin\ResultController::class, 'index'])->name('results.index');
Route::get('/results/{election}', [App\Http\Controllers\Admin\ResultController::class, 'show'])->name('results.show');
    
    // Elections
    Route::get('/elections', [App\Http\Controllers\Admin\ElectionController::class, 'index'])->name('elections.index');
    Route::get('/elections/create', [App\Http\Controllers\Admin\ElectionController::class, 'create'])->name('elections.create');
    Route::post('/elections', [App\Http\Controllers\Admin\ElectionController::class, 'store'])->name('elections.store');
    Route::get('/elections/{election}/edit', [App\Http\Controllers\Admin\ElectionController::class, 'edit'])->name('elections.edit');
    Route::put('/elections/{election}', [App\Http\Controllers\Admin\ElectionController::class, 'update'])->name('elections.update');
    Route::delete('/elections/{election}', [App\Http\Controllers\Admin\ElectionController::class, 'destroy'])->name('elections.destroy');

    // Candidates
    Route::get('/candidates', [App\Http\Controllers\Admin\CandidateController::class, 'index'])->name('candidates.index');
    Route::get('/candidates/create', [App\Http\Controllers\Admin\CandidateController::class, 'create'])->name('candidates.create');
    Route::post('/candidates', [App\Http\Controllers\Admin\CandidateController::class, 'store'])->name('candidates.store');
    Route::get('/candidates/{candidate}/edit', [App\Http\Controllers\Admin\CandidateController::class, 'edit'])->name('candidates.edit');
    Route::put('/candidates/{candidate}', [App\Http\Controllers\Admin\CandidateController::class, 'update'])->name('candidates.update');
    Route::delete('/candidates/{candidate}', [App\Http\Controllers\Admin\CandidateController::class, 'destroy'])->name('candidates.destroy');
// Audit Logs
Route::get('/audit-logs', function() {
    if (!session('admin_id')) return redirect()->route('admin.login');
    $logs = \App\Models\AuditLog::orderByDesc('created_at')->get();
    return view('admin.audit-logs', compact('logs'));
})->name('audit.logs');
 });