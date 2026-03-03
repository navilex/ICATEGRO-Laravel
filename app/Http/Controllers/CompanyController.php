<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Company;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('companies.index', compact('companies'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'type' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'municipality' => 'required|string|max:255',
            'colony' => 'required|string|max:255',
            'street' => 'required|string|max:255',
            'exterior_number' => 'required|string|max:255',
            'interior_number' => 'nullable|string|max:255',
            'zip_code' => 'required|string|max:255',
            'phone1' => 'nullable|string|max:255',
            'phone2' => 'nullable|string|max:255',
            'email1' => 'nullable|email|max:255',
            'email2' => 'nullable|email|max:255',
            'web' => 'nullable|string|max:255',
            'instagram' => 'nullable|string|max:255',
            'facebook' => 'nullable|string|max:255',
            'twitter' => 'nullable|string|max:255',
        ]);

        $existingCompany = Company::where('name', $request->name)
            ->where('type', $request->type)
            ->first();

        if ($existingCompany) {
            $location = trim($existingCompany->municipality . ', ' . $existingCompany->state, ', ');
            $locationStr = $location ? ' y existe en ' . $location : '';

            return back()->with('duplicate_error', [
                'name' => $existingCompany->name,
                'id' => $existingCompany->id,
                'location' => $locationStr
            ])->withInput();
        }

        Company::create($validatedData);

        return redirect()->route('dashboard')->with('success', 'Empresa registrada correctamente.');
    }
}
