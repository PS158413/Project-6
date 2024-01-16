<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Staff::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $staff = new Staff;
        $staff->name = $request->name;
        $staff->lastname = $request->lastname;
        $staff->email = $request->email;
        $staff->street = $request->street;
        $staff->city = $request->city;
        $staff->phone = $request->phone;
        $staff->save();

        return response()->json(['message' => 'Resource created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Staff::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $staff = Staff::find($id);
        $staff->name = $request->name;
        $staff->lastname = $request->lastname;
        $staff->email = $request->email;
        $staff->street = $request->street;
        $staff->city = $request->city;
        $staff->phone = $request->phone;
        $staff->save();

        return response()->json(['message' => 'Resource updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        $staff = Staff::find($id);
        $staff->delete();

        return response()->json(['message' => 'Resource deleted']);
    }
}
