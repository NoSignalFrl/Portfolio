<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     * Affiche la liste de tous les utilisateurs
     *
     * Ici, on charge tous les users, et en même temps, on charge leurs skills et expériences associées. C'est comme un chargement anticipé
     * C'est pour charger les relations d'un coup
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::with(['skills', 'experiences'])->get();
        return view('users.index', compact('users'));
    }


    /**
     * Show the form for creating a new resource.
     * Affiche le formulaire pour créer un nouvel utilisateur.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Enregistre un nouvel utilisateur dans la base de données.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:255',
            'languages' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
        ]);

        // Créer le user
        $user = new User([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'name' => $request->name,
            'phone' => $request->phone,
            'postal_code' => $request->postal_code,
            'languages' => $request->languages,
            'birthday' => $request->birthday,
        ]);

        $user->save();

        return redirect()->route('users.index')->with('success', 'Utilisateur ajouté avec succès.');
    }

    /**
     * Affiche un utilisateur spécifique et ses relations.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $user = User::with(['skills', 'experiences'])->findOrFail($id);
        return view('users.show', compact('user'));
    }

    /**
     * Affiche le formulaire pour modifier un utilisateur.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Met à jour un utilisateur existant.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6',
            'name' => 'required|string|max:255',
            'phone' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:255',
            'languages' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
        ]);

        $user = User::findOrFail($id);

        $data = $request->all();

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        } else {
            unset($data['password']); // évite d'écraser le mdp si vide
        }

        $user->update($data);

        return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour avec succès.');
    }

    /**
     * Supprime un utilisateur de la base de données.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'Utilisateur supprimé avec succès.');
    }
}
