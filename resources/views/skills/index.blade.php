@extends('layouts.app')

@section('content')
    <h2 class="mb-4">Liste des compétences</h2>

    <a href="{{ route('skills.create') }}" class="btn btn-primary mb-3">Ajouter une compétence</a>

    <table class="table table-hover table-bordered align-middle">
        <thead class="table-dark">
            <tr>
                <th>Compétence</th>
                <th>Description</th>
                <th>Utilisateur</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($skills as $skill)
                <tr>
                    <td>{{ $skill->skill }}</td>
                    <td>{{ $skill->description }}</td>
                    <td>{{ $skill->user->name ?? '—' }}</td>
                    <td>
                        <a href="{{ route('skills.show', $skill->id) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('skills.edit', $skill->id) }}" class="btn btn-warning btn-sm">Modifier</a>

                        <form action="{{ route('skills.destroy', $skill->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Supprimer cette compétence ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection