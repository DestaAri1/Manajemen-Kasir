<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    private $userId;
    private $historyQuery;
    private $history;

    public function __construct()
    {
        $this->userId = Auth::id();
        $this->historyQuery = History::where('user_id', $this->userId)
                                  ->orderBy('id', 'desc');
        $this->history = $this->historyQuery->paginate(6);
    }
    public function index()
    {
        $history = $this->history;
        $income = $this->historyQuery->where('type', '=', 3)->paginate(6);
        return view('history.index', compact('history', 'income'));
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
