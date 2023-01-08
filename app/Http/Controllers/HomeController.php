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
        $logs = null;

        if (!empty($request->search)) {
            $logs = AccessLogs::where('name', 'LIKE', "%".$request->search ."%")->orWhere('ip', 'LIKE', "%".$request->search ."%")->sortable()->paginate(20);
        } else {
            $logs = AccessLogs::sortable()->paginate(20);
        }

        return view('home', [
            'logs' => $logs,
        ]);
    }
}
