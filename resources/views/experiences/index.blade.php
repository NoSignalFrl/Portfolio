@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Liste des expériences</h2>

    <a href="{{ route('experiences.create') }}" class="btn btn-primary mb-3">Ajouter une expérience</a>

    <table class="table table-hover table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>Poste</th>
                <th>Entreprise</th>
                <th>Ville</th>
                <th>Utilisateur</th>
                <th>Dates</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($experiences as $exp)
                <tr>
                    <td>{{ $exp->position }}</td>
                    <td>{{ $exp->company }}</td>
                    <td>{{ $exp->city }}</td>
                    <td>{{ $exp->user->name ?? '—' }}</td>
                    <td>{{ $exp->start_date }} → {{ $exp->end_date }}</td>
                    <td>
                        <a href="{{ route('experiences.show', $exp->id) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('experiences.edit', $exp->id) }}" class="btn btn-warning btn-sm">Modifier</a>

                        <form action="{{ route('experiences.destroy', $exp->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Supprimer cette expérience ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection