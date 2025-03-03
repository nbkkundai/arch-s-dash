<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Modules\Admin\Entities\Centre;
use Modules\Client\Entities\Client;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        if($user->hasAnyRole(['Admin','Super Admin'])) {
            return redirect('/dashboard/admin');
        } else {
            return redirect('/dashboard/client');
        }
    }

    public function adminDashboard()
    {
        $user = Auth::user();

        if(!$user->hasAnyRole(['Admin','Super Admin'])) {
            abort(403);
        }

        $centre_count = Centre::count();
        $group_count = 23;
        $clients_count = Client::count();


        return view('admin-dashboard',compact('centre_count','group_count','clients_count'));
    }

    public function clientDashboard()
    {
        $user = Auth::user();

        if(!$user->hasAnyRole(['Client'])) {
            abort(403);
        }

        return view('client-dashboard');
    }
}
