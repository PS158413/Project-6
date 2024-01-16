<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {

        // Retrieve the user data from the API
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . session('SESSION_API_BEARER_TOKEN'),
            'X-CSRF-TOKEN' => csrf_token(),
        ])->get(env('API_URL') . '/user');

        if ($response->failed()) {
            abort(500, 'Failed to retrieve users from API');

        }

        $userData = $response->json()['data']['data'];

        // Retrieve the role data from the API
        $responseRole = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . session('SESSION_API_BEARER_TOKEN'),
            'X-CSRF-TOKEN' => csrf_token(),
        ])->get(env('API_URL') . '/role/all');

        if ($responseRole->failed()) {
            abort(500, 'Failed to retrieve roles from API');
        }

        $roleData = $responseRole->json()['data']['data'];


        // Get the selected role ID from the request
        $selectedRoleId = $request->input('role');





        // Filter the user data based on the selected role
        if ($selectedRoleId) {
            $userData = array_filter($userData, function ($user) use ($selectedRoleId) {
                foreach ($user['role'] as $role) {
                    if ($role['id'] == $selectedRoleId) {
                        return true;
                    }
                }
                return false;
            });
        }



        // Exclude roles "superadmin" and "user"
        $excludedRoles = ['superadmin'];
        $roleData = array_filter($roleData, function ($role) use ($excludedRoles) {
            return !in_array($role['name'], $excludedRoles);
        });



        return view('users.index', compact('userData', 'roleData', 'selectedRoleId'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // Fetch the roles from the API
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . session('SESSION_API_BEARER_TOKEN'),
            'X-CSRF-TOKEN' => csrf_token(),
        ])->get(env('API_URL') . '/role/all');

        if ($response->failed()) {
            abort(500, 'Failed to retrieve roles from API');
        }

        $roles = $response->json()['data']['data'];




        // Exclude roles "superadmin" and "user"
        $excludedRoles = ['superadmin', 'user'];
        $roles = array_filter($roles, function ($role) use ($excludedRoles) {
            return !in_array($role['name'], $excludedRoles);
        });


        // Render the create user form view and pass the roles to it
        return view('users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'city' => 'required',
            'phone' => 'required',
            'birthday' => 'required',
            'email' => 'required',
            'password' => 'required',
            'password_confirmation' => 'required',
            'role' => 'required',
        ]);

        $userData = [
            'name' => $validatedData['name'],
            'last_name' => $validatedData['last_name'],
            'city' => $validatedData['city'],
            'phone' => $validatedData['phone'],
            'birthday' => $validatedData['birthday'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'password_confirmation' => $validatedData['password_confirmation'],
            'role' => $validatedData['role'],
        ];

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . session('SESSION_API_BEARER_TOKEN'),
            'X-CSRF-TOKEN' => csrf_token(),
        ])->post(env('API_URL') . '/user', $userData);

        // $user = $response->json();

        // dd($user);

        if ($response->failed()) {
            abort(500, 'Failed to create the category via API');
        }

        return redirect()->route('user.index')->with('success', 'User successfully created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        // Fetch the roles from the API
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . session('SESSION_API_BEARER_TOKEN'),
            'X-CSRF-TOKEN' => csrf_token(),
        ])->get(env('API_URL') . '/role/all');

        if ($response->failed()) {
            abort(500, 'Failed to retrieve roles from API');
        }

        $roles = $response->json()['data']['data'];

        // Exclude roles "superadmin" and "user"
        $excludedRoles = ['superadmin', 'user'];
        $roles = array_filter($roles, function ($role) use ($excludedRoles) {
            return !in_array($role['name'], $excludedRoles);
        });


        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . session('SESSION_API_BEARER_TOKEN'),
            'X-CSRF-TOKEN' => csrf_token(),
        ])->get(env('API_URL') . '/user/' . $id);

        if ($response->failed()) {
            abort(500, 'Failed to retrieve roles from API');
        }

        $user = $response->json()['data'];


        return view('users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required',
            'last_name' => 'required',
            'city' => 'required',
            'phone' => 'required',
            'birthday' => 'required',
            'email' => 'required',
            'password' => 'nullable',
            'password_confirmation' => 'nullable',
            'role' => 'required',
        ]);

        $userData = [
            'name' => $validatedData['name'],
            'last_name' => $validatedData['last_name'],
            'city' => $validatedData['city'],
            'phone' => $validatedData['phone'],
            'birthday' => $validatedData['birthday'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'password_confirmation' => $validatedData['password_confirmation'],
            'role' => $validatedData['role'],
        ];


        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . session('SESSION_API_BEARER_TOKEN'),
            'X-CSRF-TOKEN' => csrf_token(),
        ])->put(env('API_URL') . '/user/' . $id, $userData);

        // $user = $response->json();

        // dd($user);

        if ($response->failed()) {
            abort(500, 'Failed to create the category via API');
        }

        return redirect()->route('user.index')->with('success', 'User successfully updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . session('SESSION_API_BEARER_TOKEN'),
            'X-CSRF-TOKEN' => csrf_token(),
        ])->delete(env('API_URL') . '/user/' . $id);

        if ($response->failed()) {
            abort(500, 'Failed to fetch products via API');
        }

        return redirect()->route('user.index')->with('success', 'User deleted successfully.');
    }
}
