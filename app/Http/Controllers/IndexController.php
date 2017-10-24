<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Campaigns;
use App\ResultForm;
use App\Experiments;
use Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
    	return view('index');
    }
}