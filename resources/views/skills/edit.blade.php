@extends('layouts.app')

@section('content')
    <div class="card shadow-sm p-4">
        <h2 class="mb-4">Modifier une compétence</h2>

        {{-- Affichage des erreurs de validation --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('skills.update', $skill->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="skill" class="form-label">Compétence</label>
                <input type="text" name="skill" id="skill" class="form-control" value="{{ old('skill', $skill->skill) }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control"
                    rows="3">{{ old('description', $skill->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="user_id" class="form-label">Utilisateur associé</label>
                <select name="user_id" id="user_id" class="form-select" required>
                    <option value="">-- Sélectionnez un utilisateur --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id', $skill->user_id) == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('skills.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection