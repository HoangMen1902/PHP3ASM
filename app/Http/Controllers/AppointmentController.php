<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Chair;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
  
    public function index()
    {
        return view('pages/appointment-page');
    }
}
