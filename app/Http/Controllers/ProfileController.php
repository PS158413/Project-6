<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
//    public function index(Request $request)
//    {
    ////        $validatedData = $request->validate([
    ////            'name' => 'required',
    ////            'last_name' => 'required',
    ////            'city' => 'required',
    ////            'phone' => 'required',
    ////            'email' => 'required|email',
    ////            'password' => 'required|min:6|confirmed',
    ////            'password_confirmation' => 'required|min:6',
    ////            'role' => 'required',
    ////        ]);
    ////        $requestData = [
    ////            'name' => $validatedData['name'],
    ////            'last_name' => $validatedData['last_name'],
    ////            'city' => $validatedData['city'],
    ////            'phone' => $validatedData['phone'],
    ////            'email' => $validatedData['email'],
    ////            'password' => $validatedData['password'],
    ////            'password_confirmation' => $validatedData['password_confirmation'],
    ////            'role' => $validatedData['role'],
    ////        ];
//        $response = Http::withHeaders([
//            'Accept' => 'application/json',
//            'Authorization' => 'Bearer ' . session('SESSION_API_BEARER_TOKEN'),
//            'X-CSRF-TOKEN' => csrf_token(),
//        ])->get(env('API_URL') . '/auth/user');
//
//        if ($response->failed()) {
//            abort(500, 'Failed to retrieve users from API');
//        }
//
    ////        dd($response->json()['data']['user']);
//        $data = $response->json()['data']['user'];
//        return view('profile.edit', compact('data'));
//    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.session('SESSION_API_BEARER_TOKEN'),
            'X-CSRF-TOKEN' => csrf_token(),
        ])->get(env('API_URL').'/auth/user');

        if ($response->failed()) {
            abort(500, 'Failed to retrieve roles from API');
        }

        $user = $response->json()['data'];

        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update($id, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'city' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'birthday' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required',
            'role' => 'nullable',
        ]);

        // Prepare the data for the API request
        $requestData = [
            'name' => $validatedData['name'],
            'last_name' => $validatedData['last_name'],
            'city' => $validatedData['city'],
            'phone' => $validatedData['phone'],
            'email' => $validatedData['email'],
            'birthday' => $validatedData['birthday'],
            'password' => $validatedData['password'],
            'password_confirmation' => $validatedData['password_confirmation'],
            'role' => $validatedData['role'],
        ];

        // Make the API request
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.session('SESSION_API_BEARER_TOKEN'),
            'X-CSRF-TOKEN' => csrf_token(),
        ])->put(env('API_URL').'/user/'.$id, $requestData);

        $responseData = $response->json();

        if ($responseData['status'] === true) {
            // Update was successful
            return redirect()->route('profile.edit')->with('success', $responseData['message']);
        } else {
            // Update failed
            abort(500, $responseData['message']);
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current-password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
