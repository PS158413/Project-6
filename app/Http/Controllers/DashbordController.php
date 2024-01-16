<?php

namespace App\Http\Controllers;

use App\Charts\UsersChart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashbordController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
//        $currentMonthUsers = User::whereMonth('created_at', Carbon::now()->month)->count();
//        $previousMonthUsers = User::whereMonth('created_at', Carbon::now()->subMonth()->month)->count();
//        $usersTwoMonthsAgo = User::whereMonth('created_at', Carbon::now()->subMonths(2)->month)->count();
//
//        $chart = new UsersChart;
//        $chart->labels(['2 maanden terug', '1 maand terug', 'Houdige maand']);
//        $chart->dataset('Gebruikers per maand', 'line', [$usersTwoMonthsAgo, $previousMonthUsers,  $currentMonthUsers])->backgroundColor('#3b3e5a')->type('bar');
//
        return view('dashboard');
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
