@extends('layouts.app')

@section('content')
    <h2>Détails de l’expérience</h2>

    <p><strong>Poste :</strong> {{ $experience->position }}</p>
    <p><strong>Entreprise :</strong> {{ $experience->company }}</p>
    <p><strong>Ville :</strong> {{ $experience->city }}</p>
    <p><strong>Utilisateur :</strong> {{ $experience->user->name ?? '—' }}</p>
    <p><strong>Dates :</strong> {{ $experience->start_date }} → {{ $experience->end_date }}</p>
    <p><strong>Description :</strong> {{ $experience->description ?? '—' }}</p>

    <a href="{{ route('experiences.index') }}" class="btn btn-secondary">Retour</a>
@endsection