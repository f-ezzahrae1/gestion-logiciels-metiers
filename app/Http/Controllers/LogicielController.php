<?php

namespace App\Http\Controllers;

use App\Models\Logiciel;
use Illuminate\Http\Request;

class LogicielController extends Controller
{
    public function index()
    {
        $logiciels = Logiciel::all();
        return view('logiciels.index', compact('logiciels'));
    }

    public function create()
    {
        return view('logiciels.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'version' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_installation' => 'nullable|date',
        ]);

        Logiciel::create($validatedData);

        return redirect()->route('logiciels.index')
                         ->with('success', 'Logiciel créé avec succès.');
    }

    public function show(Logiciel $logiciel)
    {
        return view('logiciels.show', compact('logiciel'));
    }

    public function edit(Logiciel $logiciel)
    {
        return view('logiciels.edit', compact('logiciel'));
    }

    public function update(Request $request, Logiciel $logiciel)
    {
        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'version' => 'required|string|max:255',
            'description' => 'nullable|string',
            'date_installation' => 'nullable|date',
        ]);

        $logiciel->update($validatedData);

        return redirect()->route('logiciels.index')
                         ->with('success', 'Logiciel mis à jour avec succès.');
    }

    public function destroy(Logiciel $logiciel)
    {
        $logiciel->delete();

        return redirect()->route('logiciels.index')
                         ->with('success', 'Logiciel supprimé avec succès.');
    }
}
