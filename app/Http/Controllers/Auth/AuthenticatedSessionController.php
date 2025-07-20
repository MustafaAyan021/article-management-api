<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use App\Traits\ResponseHelper;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    use ResponseHelper;
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): JsonResponse
    {
        $request->authenticate();

        // $request->session()->regenerate();

        $token = $request->user()->createToken('api-token')->plainTextToken;
        return $this->successResponse(
            [
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $request->user()
            ],
            'Successfully Logged In !!',
            200
        );
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): JsonResponse
    {
        // Auth::guard('web')->logout();

        $request->user()->currentAccessToken()->delete();

        return $this->successResponse(
            null,
            'Successfully Logged out',
            200,
        );
    }
}
