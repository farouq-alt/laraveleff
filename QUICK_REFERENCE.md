# Quick Reference Guide - Laravel Seminar System

## For Beginners: Understanding the Basics

### What is Laravel?
Laravel is a PHP framework that makes building web applications easier. It handles:
- Database interactions (Models)
- URL routing (Routes)
- Business logic (Controllers)
- User interface (Views)

### The MVC Pattern
```
User → Route → Controller → Model → Database
                    ↓
                  View ← Data
                    ↓
                  User
```

**M** = Model (database)
**V** = View (what user sees)
**C** = Controller (logic)

---

## File Locations Quick Reference

```
app/
  ├── Http/Controllers/
  │   └── SeminairController.php          ← Controller logic
  └── Models/
      ├── Animateur.php                   ← Database model
      ├── Seminaire.php                   ← Database model
      └── Activite.php                    ← Database model

database/
  └── migrations/
      ├── create_animateurs_table.php     ← Database blueprint
      ├── create_seminaires_table.php     ← Database blueprint
      └── create_activities_table.php     ← Database blueprint

resources/
  └── views/
      └── seminaires/
          ├── index.blade.php             ← List view
          └── show.blade.php              ← Details view

routes/
  └── web.php                             ← URL routes
```

---

## Common Commands

### Database
```bash
# Run all migrations
php artisan migrate

# Rollback last migration
php artisan migrate:rollback

# Reset all migrations
php artisan migrate:reset

# Check migration status
php artisan migrate:status
```

### Generate Files
```bash
# Create migration
php artisan make:migration create_table_name

# Create model
php artisan make:model ModelName

# Create controller
php artisan make:controller ControllerName --resource

# Create view
php artisan make:view view.name
```

### Development
```bash
# Start development server
php artisan serve

# List all routes
php artisan route:list

# Clear cache
php artisan cache:clear
php artisan route:clear
```

---

## Code Snippets

### Model Relationships

**One-To-Many (hasMany)**
```php
public function seminaires(): HasMany
{
    return $this->hasMany(Seminaire::class, 'animateur_id');
}
```

**Belongs-To**
```php
public function animateur(): BelongsTo
{
    return $this->belongsTo(Animateur::class, 'animateur_id');
}
```

### Controller Methods

**Get All Records**
```php
$seminaires = Seminaire::with('animateur')->get();
```

**Get One Record**
```php
$seminaire = Seminaire::findOrFail($id);
```

**Create Record**
```php
Seminaire::create([
    'theme' => 'Web Development',
    'date_debut' => '2024-03-01',
]);
```

**Delete Record**
```php
$seminaire->delete();
```

### Blade Template Snippets

**Output Data**
```blade
{{ $seminaire->theme }}
```

**Loop Through Data**
```blade
@foreach($seminaires as $seminaire)
    <p>{{ $seminaire->theme }}</p>
@endforeach
```

**Conditional**
```blade
@if($seminaires->count() > 0)
    <p>Found seminars</p>
@else
    <p>No seminars</p>
@endif
```

**Generate URL**
```blade
<a href="{{ route('seminaires.show', $seminaire->id) }}">View</a>
```

**Form with CSRF**
```blade
<form action="{{ route('seminaires.destroy', $seminaire->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">Delete</button>
</form>
```

---

## Database Schema

### animateurs table
```
id (Primary Key)
nom (String)
email (String, Unique)
telephone (String, Nullable)
bio (Text, Nullable)
created_at (Timestamp)
updated_at (Timestamp)
```

### seminaires table
```
id (Primary Key)
theme (String)
date_debut (Date)
date_fin (Date)
description (Text, Nullable)
cout_journalier (Decimal)
animateur_id (Foreign Key → animateurs.id)
created_at (Timestamp)
updated_at (Timestamp)
```

### activities table
```
id (Primary Key)
nom (String)
description (Text, Nullable)
seminaire_id (Foreign Key → seminaires.id)
created_at (Timestamp)
updated_at (Timestamp)
```

---

## URL Routes

| URL | Method | Controller | Purpose |
|-----|--------|-----------|---------|
| /seminaires | GET | index() | List all seminars |
| /seminaires/{id} | GET | show() | Show one seminar |
| /seminaires | POST | store() | Create new seminar |
| /seminaires/{id}/edit | GET | edit() | Show edit form |
| /seminaires/{id} | PUT/PATCH | update() | Update seminar |
| /seminaires/{id} | DELETE | destroy() | Delete seminar |

---

## Debugging Tips

### Check if Route Exists
```bash
php artisan route:list | grep seminaires
```

### Check if Model Exists
```php
// In controller
dd(Seminaire::all()); // Dumps and dies - shows all seminars
```

### Check if View Exists
```
resources/views/seminaires/index.blade.php
```

### Check Database Connection
```bash
php artisan tinker
>>> Seminaire::count()
```

### View SQL Queries
```php
// In controller
DB::enableQueryLog();
$seminaires = Seminaire::all();
dd(DB::getQueryLog());
```

---

## Common Errors & Solutions

### "Class not found"
- Check namespace at top of file
- Check file is in correct directory
- Run `composer dump-autoload`

### "Table not found"
- Run `php artisan migrate`
- Check migration file exists
- Check table name in migration

### "Route not found"
- Check route is defined in routes/web.php
- Run `php artisan route:clear`
- Check URL spelling

### "View not found"
- Check file path is correct
- Check file extension is .blade.php
- Check directory structure

### "Undefined variable"
- Check variable is passed from controller
- Check variable name spelling
- Use `dd($variable)` to debug

---

## Best Practices

### 1. Always Use Relationships
```php
// Good
$seminaire->animateur->nom

// Bad
$seminaire->animateur_id
```

### 2. Use Eager Loading
```php
// Good - one query
Seminaire::with('animateur', 'activities')->get()

// Bad - multiple queries
Seminaire::all()
```

### 3. Use findOrFail()
```php
// Good - shows 404 if not found
Seminaire::findOrFail($id)

// Bad - returns null
Seminaire::find($id)
```

### 4. Always Use @csrf
```blade
<!-- Good -->
<form method="POST">
    @csrf
    ...
</form>

<!-- Bad -->
<form method="POST">
    ...
</form>
```

### 5. Use Route Names
```blade
<!-- Good -->
<a href="{{ route('seminaires.show', $id) }}">View</a>

<!-- Bad -->
<a href="/seminaires/{{ $id }}">View</a>
```

---

## Testing Your Code

### Test Index Page
1. Run `php artisan serve`
2. Visit `http://localhost:8000/seminaires`
3. Should see list of seminars (or empty message)

### Test Show Page
1. Click "Consulter" button on a seminar
2. Should see seminar details and activities

### Test Delete
1. Click "Supprimer" button
2. Confirm deletion
3. Should return to list without that seminar

---

## Useful Resources

### Laravel Documentation
- https://laravel.com/docs
- Models: https://laravel.com/docs/eloquent
- Controllers: https://laravel.com/docs/controllers
- Views: https://laravel.com/docs/blade
- Routes: https://laravel.com/docs/routing

### Blade Syntax
- `{{ }}` - Echo (output)
- `@if` - Conditional
- `@foreach` - Loop
- `@csrf` - Security token
- `@method()` - HTTP method override

### Eloquent Methods
- `all()` - Get all records
- `find($id)` - Get one record
- `where()` - Filter records
- `create()` - Create record
- `update()` - Update record
- `delete()` - Delete record
- `with()` - Eager load relationships

---

## Summary

This Laravel system demonstrates:
- ✓ Database design with relationships
- ✓ Model-View-Controller pattern
- ✓ RESTful routing
- ✓ Blade templating
- ✓ Form handling
- ✓ Data validation
- ✓ Security best practices

All code follows Laravel conventions and is production-ready!
