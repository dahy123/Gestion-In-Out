<?php

namespace App\Http\Controllers;

use App\Models\Etudiants;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class EtudiantsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // dd( User::all());

        $etudiants = Etudiants::all();
        return view("etudiants.index", compact('etudiants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("etudiants.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:etudiants,email',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $validated['image'] = $imagePath;
        }

        Etudiants::create($validated);

        return redirect()->route('etudiants.index')->with('success', 'Étudiant ajouté avec succès.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Etudiants $etudiant)
    {
        return view('etudiants.edit', compact('etudiant'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Etudiants $etudiant)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|email|unique:etudiants,email,' . $etudiant->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            // if ($etudiant->image) {
            //     \Storage::disk('public')->delete($etudiant->image);
            // }

            $imagePath = $request->file('image')->store('images', 'public');
            $validated['image'] = $imagePath;
        }

        $etudiant->update($validated);

        return redirect()->route('etudiants.index')->with('success', 'Étudiant modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Etudiants $etudiant)
    {
        // Supprimer l'image si elle existe
        // if ($etudiant->image) {
        //     \Storage::disk('public')->delete($etudiant->image);
        // }

        $etudiant->delete();

        return redirect()->route('etudiants.index')->with('success', 'Étudiant supprimé avec succès.');
    }

    public function download(Etudiants $etudiant)
{
    // Charger une vue pour générer le contenu du PDF
    $pdf = Pdf::loadView('etudiants.pdf', compact('etudiant'));

    // Télécharger le fichier PDF
    return $pdf->download('etudiant_' . $etudiant->id . '.pdf');
}
}