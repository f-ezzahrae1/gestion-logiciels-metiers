<?php

namespace App\Http\Controllers;

use App\Models\Licence;
use App\Models\Logiciel;
use App\Models\Utilisateur;
use Illuminate\Http\Request;

class LicenceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $licences = Licence::with('logiciel', 'utilisateur')->get();
        return view('licences.index', compact('licences'));
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       $logiciels = Logiciel::all();
    $utilisateurs = Utilisateur::all();
    return view('licences.create', compact('logiciels', 'utilisateurs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $validatedData = $request->validate([
    'id_logiciel' => 'required|exists:logiciels,id_logiciel',
    'id_utilisateur' => 'required|exists:utilisateurs,id_utilisateur',
    'cle_licence' => 'required|string|max:255|unique:licences',
    'date_acquisition' => 'required|date',
    'status' => 'required|string|max:255',
    'type_licence' => 'required|string|max:255',
    'contrat' => 'nullable|string',
]);

Licence::create($validatedData);

        return redirect()->route('licences.index')
                         ->with('success', 'Licence créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Licence $licence)
    {
        return view('licences.show', compact('licence'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Licence $licence)
{
    $logiciels = Logiciel::all();
    $utilisateurs = Utilisateur::all();
    return view('licences.edit', compact('licence', 'logiciels', 'utilisateurs'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Licence $licence)
    {
       $validatedData = $request->validate([
    'id_logiciel' => 'required|exists:logiciels,id_logiciel',
    'id_utilisateur' => 'required|exists:utilisateurs,id_utilisateur',
    'cle_licence' => 'required|string|max:255|unique:licences,cle_licence,' . $licence->id_licence . ',id_licence',
    'date_acquisition' => 'required|date',
    'status' => 'required|string|max:255',
    'type_licence' => 'required|string|max:255',
    'contrat' => 'nullable|string',
]);

$licence->update($validatedData);

        return redirect()->route('licences.index')
                         ->with('success', 'Licence mise à jour avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Licence $licence)
    {
        $licence->delete();

        return redirect()->route('licences.index')
                         ->with('success', 'Licence supprimée avec succès.');
    }
}