# Question 7: show.blade.php View

## What We Need to Do
Create a view that displays the details of one specific seminar and lists all its associated activities.

## Simple Explanation
The show page is like a detailed profile page. When you click "Consulter" (View) on a seminar, this page opens and shows all the information about that seminar, including all the activities planned for it.

## File Location
`resources/views/seminaires/show.blade.php`

## What the View Should Show

### Part 1: Seminar Details
A section showing:
- Theme (title)
- Start date
- End date
- Description
- Daily cost
- Animator name

### Part 2: Associated Activities
A table showing all activities for this seminar:
- Activity name
- Activity description

## The Code

```blade
@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <h1>Détails du séminaire : {{ $seminaire->id }}</h1>

            {{-- Seminar Details Section --}}
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h5>Informations du Séminaire</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Thème:</strong> {{ $seminaire->theme }}</p>
                            <p><strong>Date début:</strong> {{ $seminaire->date_debut }}</p>
                            <p><strong>Date fin:</strong> {{ $seminaire->date_fin }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Description:</strong> {{ $seminaire->description }}</p>
                            <p><strong>Coût journalier:</strong> {{ $seminaire->cout_journalier }} €</p>
                            <p><strong>Animateur:</strong> {{ $seminaire->animateur->nom ?? 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Activities Section --}}
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5>Liste des activités assurées :</h5>
                </div>
                <div class="card-body">
                    @if($seminaire->activities->count() > 0)
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Nom de l'activité</th>
                                    <th>Description de l'activité</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($seminaire->activities as $activity)
                                    <tr>
                                        <td>{{ $activity->nom }}</td>
                                        <td>{{ $activity->description }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Aucune activité trouvée pour ce séminaire.</p>
                    @endif
                </div>
            </div>

            {{-- Back Button --}}
            <div class="mt-4">
                <a href="{{ route('seminaires.index') }}" class="btn btn-secondary">
                    Retour à la liste
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
```

## Understanding the Code

### @extends('layouts.app')
- Uses the main layout template
- All content goes in @section('content')

### {{ $seminaire->id }}
- Displays the seminar ID in the title
- Example: "Détails du séminaire : 1"

### <div class="card">
- Bootstrap card component for styling
- Creates a nice box with header and body

### {{ $seminaire->theme }}
- Displays the seminar's theme/title
- The data comes from the controller

### {{ $seminaire->animateur->nom ?? 'N/A' }}
- Displays the animator's name
- `??` means "if null, show 'N/A'"
- This is called the "null coalescing operator"

### @foreach($seminaire->activities as $activity)
- Loops through all activities for this seminar
- Creates a table row for each activity

### {{ $activity->nom }}
- Displays the activity name

### {{ $activity->description }}
- Displays the activity description

### route('seminaires.index')
- Creates a link back to the seminars list

## Bootstrap Components Used

### Card
```blade
<div class="card">
    <div class="card-header">Header</div>
    <div class="card-body">Content</div>
</div>
```
- Creates a styled box with header and body

### Table
```blade
<table class="table table-striped">
```
- `table` - Basic table styling
- `table-striped` - Alternating row colors

### Buttons
```blade
<a href="..." class="btn btn-secondary">Text</a>
```
- `btn` - Button styling
- `btn-secondary` - Gray button color

## How Data Flows

1. User clicks "Consulter" button on index page
2. Browser goes to `/seminaires/1` (example)
3. SeminairController's show() method is called
4. Controller finds the seminar with ID 1
5. Controller loads animator and activities with it
6. Controller passes data to this view
7. View displays all the information

## Important Notes

### Eager Loading
In the controller, we used:
```php
Seminaire::with('animateur', 'activities')->findOrFail($id)
```

This loads:
- The seminar
- Its animator (one record)
- All its activities (multiple records)

All in one database query, which is efficient.

### Null Coalescing Operator (??)
```blade
{{ $seminaire->animateur->nom ?? 'N/A' }}
```

This means:
- Try to show the animator's name
- If it's null/empty, show 'N/A' instead
- Prevents errors if animator doesn't exist
