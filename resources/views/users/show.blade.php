@extends('layouts.app')

@section('content')
    <div class="card shadow-sm p-4">
        <h2 class="mb-3">Détails de l’utilisateur</h2>

        <div class="mb-3">
            <strong>Nom :</strong> {{ $user->name }}
        </div>
        <div class="mb-3">
            <strong>Email :</strong> {{ $user->email }}
        </div>
        <div class="mb-3">
            <strong>Téléphone :</strong> {{ $user->phone }}
        </div>
        <div class="mb-3">
            <strong>Langues :</strong> {{ $user->languages }}
        </div>
        <div class="mb-3">
            <strong>Date de naissance :</strong> {{ $user->birthday }}
        </div>

        <hr>

        <h4>Compétences</h4>
        @if ($user->skills->count() > 0)
            <ul class="list-group mb-3">
                @foreach ($user->skills as $skill)
                    <li class="list-group-item">
                        <strong>{{ $skill->skill }}</strong> — {{ $skill->description }}
                    </li>
                @endforeach
            </ul>
        @else
            <p>Aucune compétence trouvée.</p>
        @endif

        <h4>Expériences</h4>
        @if ($user->experiences->count() > 0)
            <ul class="list-group">
                @foreach ($user->experiences as $exp)
                    <li class="list-group-item">
                        <strong>{{ $exp->position }}</strong> chez {{ $exp->company }}
                        <br>
                        <small>{{ $exp->start_date }} → {{ $exp->end_date }}</small>
                        <br>
                        {{ $exp->city }}, {{ $exp->address }}
                    </li>
                @endforeach
            </ul>
        @else
            <p>Aucune expérience trouvée.</p>
        @endif

        <a href="{{ route('users.index') }}" class="btn btn-secondary mt-3">Retour à la liste</a>
    </div>
@endsection