<?php

namespace App\Http\Controllers;

use App\Models\Logaktivitas;
use Illuminate\Http\Request;

class LogaktivitasController extends Controller
{
    public function index()
    {
        $logs = Logaktivitas::with('user')->latest()->paginate(10);
        return view('logaktivitas.index', compact('logs'));
    }
    
}