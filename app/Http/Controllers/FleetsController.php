<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fleet;
use App\Events\EmailSentEvent;
use Carbon\Carbon;
use App\Jobs\UpgradeBuilding;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class FleetsController extends Controller
{
    public function index(Request $request)
    {
    	return view('content.fleets', compact($request));
    }
}
