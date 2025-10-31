<?php

namespace App\Http\Controllers;

use App\Models\Skill;
use App\Models\User;
use Illuminate\Http\Request;

class SkillController extends Controller
{
    /**
     * Display a listing of the resource.
     * index affiche la liste des skills (compétences)
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $skills = Skill::with('user')->get();
        return view('skills.index', compact('skills'));
    }

    /**
     * Show the form for creating a new resource.
     * create Affiche le formulaire de création d'un Skill (compétence)
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $users = User::all(); // pour choisir à quel user appartient la compétence
        return view('skills.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     * Enregistre un nouveau Skill (compétence) dans la base de données
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'skill' => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        Skill::create($request->all());

        return redirect()->route('skills.index')->with('success', 'Compétence ajoutée avec succès.');
    }

    /**
     * Display the specified resource.
     * Affiche un Skill (compétence) spécifique
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $skill = Skill::with('user')->findOrFail($id);
        return view('skills.show', compact('skill'));
    }

    /**
     * Show the form for editing the specified resource.
     * Affiche le formulaire pour modifier un Skill (compétence) existant
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $skill = Skill::findOrFail($id);
        $users = User::all();
        return view('skills.edit', compact('skill', 'users'));
    }

    /**
     * Update the specified resource in storage.
     * Met à jour un Skill existant
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'skill' => 'required|string|max:255',
            'description' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
        ]);

        $skill = Skill::findOrFail($id);
        $skill->update($request->all());

        return redirect()->route('skills.index')->with('success', 'Compétence mise à jour.');
    }

    /**
     * Remove the specified resource from storage.
     * Supprime une compétence
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $skill = Skill::findOrFail($id);
        $skill->delete();

        return redirect()->route('skills.index')->with('success', 'Compétence supprimée.');
    }
}
