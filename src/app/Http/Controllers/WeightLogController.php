<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\WeightLog;
use App\Models\WeightTarget;
class WeightLogController extends Controller
{
     public function index()
    {
        
        return view('admin');
    }
}
   