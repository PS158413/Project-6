<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AbsentController extends Controller
{


    public function show()
    {
        $userRole = session('SESSION_USER_ROLE');

        if ($userRole === 'superadmin') {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . session('SESSION_API_BEARER_TOKEN'),
                'X-CSRF-TOKEN' => csrf_token(),
            ])->get(env('API_URL') . '/availability/all');
        } else {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . session('SESSION_API_BEARER_TOKEN'),
                'X-CSRF-TOKEN' => csrf_token(),
            ])->get(env('API_URL') . '/availability');
        }

        if ($response->failed()) {
            abort(500, 'Failed to retrieve availability from API');
        }

        $data = $response->json()['data']['data'];

        $events = [];
        foreach ($data as $record) {
            $events[] = [
                'id' => $record['id'], // Include the event ID
                'title' => $record['absence'] . ' ' . $record['user']['name'] . ' ' . $record['user']['last_name'],
                'start' => $record['start_time'],
                'end' => $record['finish_time'],
            ];
        }

        return view('Calendar.index', compact('events'));
    }


    public function create()
    {
        return view('Calendar.create');
    }

    public function store(Request $request)
    {

        // Validate the request data
        $validatedData = $request->validate([
            'absence' => 'required',
            'start_time' => 'required',
            'finish_time' => 'required',

        ]);


        // Prepare the data for the API request
        $requestData = [
            'absence' => $validatedData['absence'],
            'start_time' => $validatedData['start_time'],
            'finish_time' => $validatedData['finish_time'],

        ];

        // Send the API request and handle the response
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . session('SESSION_API_BEARER_TOKEN'),
            'X-CSRF-TOKEN' => csrf_token(),
        ])->post(env('API_URL') . '/availability', $requestData);

        // Handle the API response
        if ($response->failed()) {
            abort(500, 'Failed to create absence via API');
        }

        return redirect()->route('calender');
    }

    public function edit($id)
    {
        // Send a request to fetch the specific absence data for editing
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . session('SESSION_API_BEARER_TOKEN'),
            'X-CSRF-TOKEN' => csrf_token(),
        ])->get(env('API_URL') . '/availability/' . $id);

        if ($response->failed()) {
            abort(500, 'Failed to fetch absence data for editing via API');
        }

        $absence = $response->json()['data'];

        return view('Calendar.edit', compact('absence'));
    }



    public function update($id, Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'absence' => 'required',
            'start_time' => 'required',
            'finish_time' => 'required',
        ]);

        // Prepare the data for the API request
        $requestData = [
            'absence' => $validatedData['absence'],
            'start_time' => $validatedData['start_time'],
            'finish_time' => $validatedData['finish_time'],
        ];

        // Send the API request and handle the response
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . session('SESSION_API_BEARER_TOKEN'),
            'X-CSRF-TOKEN' => csrf_token(),
        ])->put(env('API_URL') . '/availability/' . $id, $requestData);

        // Handle the API response
        if ($response->failed()) {
            abort(500, 'Failed to update absence via API');
        }

        return redirect()->route('calender')->with('success', 'Absence updated successfully.');
    }


    public function destroy($id)
    {

        try {
            // Make a request to the external API to delete the user
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Bearer ' . session('SESSION_API_BEARER_TOKEN'),
                'X-CSRF-TOKEN' => csrf_token(),
            ])->delete(env('API_URL') . '/availability/' . $id);

            $responseData = $response->json();
            $message = $responseData['message'];

            if ($responseData['status']) {
                // User deletion successful
                return redirect()->route('calender')->with('success', $message);
            } else {
                // User deletion failed
                return redirect()->route('calender')->with('error', $message);
            }
        } catch (\Exception $e) {
            // Exception occurred during user deletion
            return redirect()->route('calender')->with('error', 'Failed to delete user');
        }
    }


    public function countAbsentUsers()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . session('SESSION_API_BEARER_TOKEN'),
            'X-CSRF-TOKEN' => csrf_token(),
        ])->get(env('API_URL') . '/availability/all');

        if ($response->failed()) {
            abort(500, 'Failed to retrieve availability from API');
        }

        $data = $response->json()['data']['data'];

        $absentCount = 0;
        $currentDate = date('Y-m-d');
        $staffAndSuperAdminCount = 0;

        foreach ($data as $record) {
            $startDate = date('Y-m-d', strtotime($record['start_time']));
            $endDate = date('Y-m-d', strtotime($record['finish_time']));

            if ($startDate <= $currentDate && $endDate >= $currentDate) {
                $absentCount++;
            }
        }

        $userResponse = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . session('SESSION_API_BEARER_TOKEN'),
            'X-CSRF-TOKEN' => csrf_token(),
        ])->get(env('API_URL') . '/user');

        if ($userResponse->failed()) {
            abort(500, 'Failed to retrieve users from API');
        }

        $users = $userResponse->json()['data']['data'];



        foreach ($users as $user) {
            $hasRole = false;
            foreach ($user['role'] as $role) {
                if ($role['name'] === 'user' || $role['name'] === 'superadmin' ) {
                    // Exclude users with the "user" and 'superadmin' role
                    continue 2; // Skip to the next user in the outer loop
                }
                if ($role['name']) {
                    $hasRole = true;
                    break; // No need to check further roles for this user
                }
            }
            if ($hasRole) {
                $staffAndSuperAdminCount++;
            }
        }

        return view('dashboard', compact('absentCount', 'staffAndSuperAdminCount'));
    }


    public function getAbsentUsers()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . session('SESSION_API_BEARER_TOKEN'),
            'X-CSRF-TOKEN' => csrf_token(),
        ])->get(env('API_URL') . '/availability/all');

        if ($response->failed()) {
            abort(500, 'Failed to retrieve availability from API');
        }

        $data = $response->json()['data']['data'];

        $absentUsers = [];
        $currentDate = date('Y-m-d');

        foreach ($data as $record) {
            $startDate = date('d-m-Y', strtotime($record['start_time']));
            $endDate = date('d-m-Y', strtotime($record['finish_time']));

            if ($startDate <= $currentDate && $endDate >= $currentDate) {
                $absentUsers[] = [
                    'name' => $record['user']['name'] . ' ' . $record['user']['last_name'],
                    'start_time' => $startDate,
                    'end_time' => $endDate,
                ];
            }
        }

        return view('Calendar.absent', compact('absentUsers'));
    }
}
