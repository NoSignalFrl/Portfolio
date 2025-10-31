@extends('layouts.app')

@section('content')
    <div class="card shadow-sm p-4">
        <h2 class="mb-4">Ajouter une expérience</h2>

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

        <form action="{{ route('experiences.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="position" class="form-label">Poste</label>
                <input type="text" name="position" id="position" class="form-control" value="{{ old('position') }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="company" class="form-label">Entreprise</label>
                <input type="text" name="company" id="company" class="form-control" value="{{ old('company') }}" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="city" class="form-label">Ville</label>
                    <input type="text" name="city" id="city" class="form-control" value="{{ old('city') }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="postal_code" class="form-label">Code postal</label>
                    <input type="text" name="postal_code" id="postal_code" class="form-control"
                        value="{{ old('postal_code') }}">
                </div>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Adresse</label>
                <input type="text" name="address" id="address" class="form-control" value="{{ old('address') }}">
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="start_date" class="form-label">Date de début</label>
                    <input type="date" name="start_date" id="start_date" class="form-control"
                        value="{{ old('start_date') }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label for="end_date" class="form-label">Date de fin</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" value="{{ old('end_date') }}">
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" id="description" class="form-control"
                    rows="3">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label for="user_id" class="form-label">Utilisateur associé</label>
                <select name="user_id" id="user_id" class="form-select" required>
                    <option value="">-- Sélectionnez un utilisateur --</option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Enregistrer</button>
            <a href="{{ route('experiences.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
@endsection