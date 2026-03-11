# Question 4: Model Relationships

## What We Need to Do
Define the relationships between models:
1. One-To-Many relationship between Animateur and Seminaire
2. One-To-Many relationship between Seminaire and Activite

## Simple Explanation
Relationships describe how data connects. Think of it like a family tree:
- One parent (Animateur) can have many children (Seminaires)
- One seminar (Seminaire) can have many activities (Activites)

## The Three Types of Relationships

### 1. One-To-Many (hasMany)
Used when one record can have many related records.

**Example:** One animator can teach many seminars.

```php
// In Animateur model
public function seminaires(): HasMany
{
    return $this->hasMany(Seminaire::class, 'animateur_id');
}
```

### 2. Belongs-To (belongsTo)
Used when a record belongs to another record.

**Example:** A seminar belongs to one animator.

```php
// In Seminaire model
public function animateur(): BelongsTo
{
    return $this->belongsTo(Animateur::class, 'animateur_id');
}
```

## Our Relationships

### Animateur Model
```php
// One animator has many seminars
public function seminaires(): HasMany
{
    return $this->hasMany(Seminaire::class, 'animateur_id');
}
```

### Seminaire Model
```php
// A seminar belongs to one animator
public function animateur(): BelongsTo
{
    return $this->belongsTo(Animateur::class, 'animateur_id');
}

// A seminar has many activities
public function activities(): HasMany
{
    return $this->hasMany(Activite::class, 'seminaire_id');
}
```

### Activite Model
```php
// An activity belongs to one seminar
public function seminaire(): BelongsTo
{
    return $this->belongsTo(Seminaire::class, 'seminaire_id');
}
```

## How to Use These Relationships

### Getting Data
```php
// Get all seminars for animator with ID 1
$animator = Animateur::find(1);
$seminars = $animator->seminaires;

// Get the animator for a specific seminar
$seminar = Seminaire::find(1);
$animator = $seminar->animateur;

// Get all activities for a seminar
$activities = $seminar->activities;
```

### Creating Related Data
```php
// Create a seminar for an animator
$animator = Animateur::find(1);
$animator->seminaires()->create([
    'theme' => 'Web Development',
    'date_debut' => '2024-03-01',
    'date_fin' => '2024-03-05',
    'cout_journalier' => 500.00,
]);

// Create an activity for a seminar
$seminar = Seminaire::find(1);
$seminar->activities()->create([
    'nom' => 'Practical Exercise',
    'description' => 'Hands-on coding practice',
]);
```

## Why This Matters
- Relationships make it easy to access related data
- They help maintain data integrity
- They make your code cleaner and more readable
- They prevent data inconsistencies
