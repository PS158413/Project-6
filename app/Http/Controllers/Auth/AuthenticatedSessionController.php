<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request) //: RedirectResponse
    {
        // Validate the request data
        $validatedData = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // Make a request to the external API
        $response = Http::post(env('API_URL').'/auth/login', [
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
        ]);

        $responseData = $response->json();

        $message = $responseData['message'];

        if ($responseData['status']) {
            session(['SESSION_API_BEARER_TOKEN' => $responseData['data']['access_token']]);

            $userRole = $responseData['data']['user']['role'][0]['name'];
            session(['SESSION_USER_ROLE' => $userRole]);

            $username = $responseData['data']['user']['name'];
            session(['SESSION_USER' => $username]);

            $userData = $responseData['data']['user'];
            session(['SESSION_USER_DATA' => $userData]);

            return redirect()->intended(RouteServiceProvider::HOME)->with(compact('message'));
        } else {
            // Pass the error messages to the view
            $passwordErrors = $responseData['errors']['password'] ?? [];

            return view('auth.login', compact('message', 'passwordErrors'));
        }
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request) //: RedirectResponse
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.session('SESSION_API_BEARER_TOKEN'),
            'X-CSRF-TOKEN' => csrf_token(),
        ])->post(env('API_URL').'/auth/logout');

        $responseData = $response->json();
        $message = $responseData['message'];

        if ($responseData['status']) {
            // Clear the session
            session()->forget(['SESSION_API_BEARER_TOKEN', 'SESSION_USER_ROLE', 'SESSION_USER']);
            // Redirect the user to the login page
            return redirect()->route('home.index');
        } else {
            // Handle the logout failure, show an error message, etc.
            abort(500, 'Failed to log out');
        }
    }
}
