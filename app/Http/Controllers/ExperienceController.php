<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use App\Models\User;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * Affiche la liste de toutes les expériences.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $experiences = Experience::with('user')->get();
        return view('experiences.index', compact('experiences'));
    }

    /**
     * Affiche le formulaire de création d'une expérience.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $users = User::all(); // pour choisir à quel utilisateur appartient l’expérience
        return view('experiences.create', compact('users'));
    }

    /**
     * Enregistre une nouvelle expérience dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'position' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'city' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'company' => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        Experience::create($request->all());

        return redirect()->route('experiences.index')
            ->with('success', 'Expérience ajoutée avec succès.');
    }

    /**
     * Affiche une expérience spécifique.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $experience = Experience::with('user')->findOrFail($id);
        return view('experiences.show', compact('experience'));
    }

    /**
     * Affiche le formulaire pour modifier une expérience existante.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $experience = Experience::findOrFail($id);
        $users = User::all();
        return view('experiences.edit', compact('experience', 'users'));
    }

    /**
     * Met à jour une expérience existante.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'position' => 'required|string|max:255',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'city' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'company' => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $experience = Experience::findOrFail($id);
        $experience->update($request->all());

        return redirect()->route('experiences.index')
            ->with('success', 'Expérience mise à jour avec succès.');
    }

    /**
     * Supprime une expérience de la base de données.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $experience = Experience::findOrFail($id);
        $experience->delete();

        return redirect()->route('experiences.index')
            ->with('success', 'Expérience supprimée avec succès.');
    }
}
