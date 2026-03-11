@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Liste des Séminaires</h1>

            {{-- Display success message if seminar was deleted --}}
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            {{-- Check if there are any seminars --}}
            @if($seminaires->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>Thème</th>
                                <th>Date début</th>
                                <th>Date fin</th>
                                <th>Description</th>
                                <th>Coût journalier</th>
                                <th>Animateur_id</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Loop through each seminar --}}
                            @foreach($seminaires as $seminaire)
                                <tr>
                                    <td><strong>{{ $seminaire->theme }}</strong></td>
                                    <td>{{ $seminaire->date_debut }}</td>
                                    <td>{{ $seminaire->date_fin }}</td>
                                    <td>{{ Str::limit($seminaire->description, 50) }}</td>
                                    <td>{{ number_format($seminaire->cout_journalier, 2) }} €</td>
                                    <td>{{ $seminaire->animateur_id }}</td>
                                    <td>
                                        {{-- Consult button - view details --}}
                                        <a href="{{ route('seminaires.show', $seminaire->id) }}" 
                                           class="btn btn-info btn-sm" 
                                           title="Consulter">
                                            <i class="fas fa-eye"></i> Consulter
                                        </a>

                                        {{-- Modify button - edit seminar --}}
                                        <a href="{{ route('seminaires.edit', $seminaire->id) }}" 
                                           class="btn btn-warning btn-sm"
                                           title="Modifier">
                                            <i class="fas fa-edit"></i> Modifier
                                        </a>

                                        {{-- Suppress button - delete seminar --}}
                                        <form action="{{ route('seminaires.destroy', $seminaire->id) }}" 
                                              method="POST" 
                                              style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="btn btn-danger btn-sm"
                                                    title="Supprimer"
                                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce séminaire?')">
                                                <i class="fas fa-trash"></i> Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">
                    <p>Aucun séminaire trouvé.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
