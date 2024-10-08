<?php

namespace App\Http\Controllers;

use App\Models\Expenses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpensesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Expenses::select(
            DB::raw('SUM(amount) as total_expenses'),
            DB::raw('EXTRACT(MONTH FROM expense_date) as month'),
            DB::raw('EXTRACT(YEAR FROM expense_date) as year')
        )
            ->groupBy(DB::raw('EXTRACT(MONTH FROM expense_date)'), DB::raw('EXTRACT(YEAR FROM expense_date)'))
            ->get();
        // dd($data);
        return view('expenses.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Expenses $expenses)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expenses $expenses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expenses $expenses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expenses $expenses)
    {
        //
    }
}
