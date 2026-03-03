<?php

namespace App\Http\Controllers;

use App\Models\Convenio;
use App\Models\Plantel;
use App\Models\Poblacion;
use App\Models\Company;
use Illuminate\Http\Request;

class ConvenioController extends Controller
{
    public function index()
    {
        $convenios = Convenio::all();
        return view('convenios.index', compact('convenios'));
    }

    public function create()
    {
        $planteles = Plantel::all();
        $poblaciones = Poblacion::all();
        $companies = Company::all();
        return view('convenios.create', compact('planteles', 'poblaciones', 'companies'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|string|max:255',
            'number' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'object' => 'required|string|max:200',
            'planteles' => 'required|array|min:1',
            'planteles.*' => 'exists:planteles,id',
            'poblaciones' => 'nullable|array',
            'poblaciones.*' => 'exists:poblaciones,id',
            'companies' => 'nullable|array',
            'companies.*' => 'exists:companies,id',
            'pdf_document' => 'nullable|file|mimes:pdf|max:8192',
            'observations' => 'nullable|string|max:200'
        ], [
            'planteles.required' => 'Es obligatorio seleccionar al menos una opción en "Disponible para".',
            'pdf_document.mimes' => 'El archivo de convenio debe ser un PDF válido.',
            'pdf_document.max' => 'El archivo de convenio no debe pesar más de 8MB.'
        ]);

        $existingConvenio = Convenio::where('number', $request->number)->first();

        if ($existingConvenio) {
            return back()->with('duplicate_error', [
                'number' => $existingConvenio->number,
                'id' => $existingConvenio->id,
                'name' => $existingConvenio->name
            ])->withInput();
        }

        $dataToSave = $request->except(['planteles', 'poblaciones', 'companies', 'pdf_document']);

        if ($request->hasFile('pdf_document')) {
            $path = $request->file('pdf_document')->store('convenios_pdfs', 'public');
            $dataToSave['pdf_document'] = $path;
        }

        $dataToSave['observations'] = $request->observations;

        $convenio = Convenio::create($dataToSave);
        $convenio->planteles()->sync($request->planteles);

        if ($request->has('poblaciones')) {
            $convenio->poblaciones()->sync($request->poblaciones);
        }

        if ($request->has('companies')) {
            $convenio->companies()->sync($request->companies);
        }

        return redirect()->route('dashboard')->with('success', 'Convenio registrado correctamente.');
    }
}
