<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plantel;

class ConsultaPlantelController extends Controller
{
    public function index()
    {
        $planteles = Plantel::with('user')->get();
        return view('consulta_planteles.index', compact('planteles'));
    }
}
