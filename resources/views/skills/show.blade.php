@extends('layouts.app')

@section('content')
    <div class="card shadow-sm p-4">
        <h2 class="mb-4">Détails de la compétence</h2>

        <div class="mb-3">
            <strong>Compétence :</strong> {{ $skill->skill }}
        </div>

        <div class="mb-3">
            <strong>Description :</strong> {{ $skill->description }}
        </div>

        <div class="mb-3">
            <strong>Utilisateur associé :</strong>
            @if ($skill->user)
                {{ $skill->user->name }} ({{ $skill->user->email }})
            @else
                <span class="text-muted">Aucun utilisateur lié</span>
            @endif
        </div>

        <a href="{{ route('skills.index') }}" class="btn btn-secondary mt-3">Retour à la liste</a>
    </div>
@endsection