use App\Http\Controllers\Api\BlogApiController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/blogs', [BlogApiController::class, 'index']);
Route::get('/blogs/{blog}', [BlogApiController::class, 'show']);

// Protected routes (for logged-in users)
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/blogs', [BlogApiController::class, 'store']);
    Route::put('/blogs/{blog}', [BlogApiController::class, 'update']);
    Route::delete('/blogs/{blog}', [BlogApiController::class, 'destroy']);
});
