@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1 class="mb-4">Détails du séminaire : {{ $seminaire->id }}</h1>

            {{-- Seminar Details Section --}}
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Informations du Séminaire</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p>
                                <strong>Thème:</strong> 
                                <span class="badge bg-info">{{ $seminaire->theme }}</span>
                            </p>
                            <p>
                                <strong>Date début:</strong> 
                                {{ \Carbon\Carbon::parse($seminaire->date_debut)->format('d/m/Y') }}
                            </p>
                            <p>
                                <strong>Date fin:</strong> 
                                {{ \Carbon\Carbon::parse($seminaire->date_fin)->format('d/m/Y') }}
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p>
                                <strong>Description:</strong> 
                                {{ $seminaire->description ?? 'N/A' }}
                            </p>
                            <p>
                                <strong>Coût journalier:</strong> 
                                <span class="badge bg-success">{{ number_format($seminaire->cout_journalier, 2) }} €</span>
                            </p>
                            <p>
                                <strong>Animateur:</strong> 
                                <span class="badge bg-warning">{{ $seminaire->animateur->nom ?? 'N/A' }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Activities Section --}}
            <div class="card mb-4">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Liste des activités assurées :</h5>
                </div>
                <div class="card-body">
                    @if($seminaire->activities->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Nom de l'activité</th>
                                        <th>Description de l'activité</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($seminaire->activities as $activity)
                                        <tr>
                                            <td>
                                                <strong>{{ $activity->nom }}</strong>
                                            </td>
                                            <td>
                                                {{ $activity->description ?? 'Pas de description' }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="alert alert-info">
                            <p class="mb-0">Aucune activité trouvée pour ce séminaire.</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Back Button --}}
            <div class="mt-4 mb-4">
                <a href="{{ route('seminaires.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Retour à la liste
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
