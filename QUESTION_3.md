# Question 3: Model Creation Commands

## What We Need to Do
Create three model classes:
- `Animateur` (Animator/Instructor)
- `Seminaire` (Seminar)
- `Activite` (Activity)

## Simple Explanation
Models are like blueprints for objects in your code. They represent the data from your database tables and help you interact with that data easily. Think of a Model as a translator between your database and your PHP code.

## Commands to Run

```bash
# Create Animateur model
php artisan make:model Animateur

# Create Seminaire model
php artisan make:model Seminaire

# Create Activite model
php artisan make:model Activite
```

## What Each Model Does

### Animateur Model
- Represents an instructor/animator
- Stores information like name, email, phone
- Can have many seminars

### Seminaire Model
- Represents a seminar/training course
- Stores theme, dates, cost, description
- Belongs to one animator
- Can have many activities

### Activite Model
- Represents an activity within a seminar
- Stores activity name and description
- Belongs to one seminar

## Where Files Are Created
These commands will create files in: `app/Models/`

The files will be:
- `app/Models/Animateur.php`
- `app/Models/Seminaire.php`
- `app/Models/Activite.php`

## What's Inside Each Model File
Each model file will contain:
- Class definition
- Database table name (Laravel guesses it from the model name)
- Fillable properties (which columns can be mass-assigned)
- Relationships to other models
