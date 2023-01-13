<?php

namespace App\Http\Controllers;

use App\Models\AccessLogs;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $search = $request->search;
        
        $logs = AccessLogs::when($search, function ($query, $search) {
            $query->where('name', 'LIKE', "%" . $search . "%")
                ->orWhere('ip', 'LIKE', "%" . $search . "%")
                ->sortable();
        }, function ($query) {
            $query->sortable();
        })->paginate(20);

        return view('home', [
            'logs' => $logs,
        ]);
    }
}
