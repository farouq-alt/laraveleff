# Question 8: Routes for SeminairController

## What We Need to Do
Create routes that connect URLs to the SeminairController methods.

## Simple Explanation
Routes are like a map that tells Laravel:
- When someone visits this URL
- Call this controller method
- And show this result

Think of it like a restaurant menu:
- Customer asks for "Pasta" (URL)
- Waiter brings it to the kitchen (controller)
- Chef prepares it (method)
- Waiter brings it back (response)

## File Location
`routes/web.php`

## The Code

```php
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SeminairController;

Route::get('/', function () {
    return view('welcome');
});

// Resource route for seminaires
// This creates all the standard routes for the SeminairController
Route::resource('seminaires', SeminairController::class);
```

## Understanding Route::resource()

The `Route::resource()` method automatically creates 7 routes:

| HTTP Method | URL | Controller Method | Purpose |
|-------------|-----|-------------------|---------|
| GET | /seminaires | index() | Show list of all seminars |
| GET | /seminaires/create | create() | Show form to create new seminar |
| POST | /seminaires | store() | Save new seminar to database |
| GET | /seminaires/{id} | show() | Show details of one seminar |
| GET | /seminaires/{id}/edit | edit() | Show form to edit seminar |
| PUT/PATCH | /seminaires/{id} | update() | Update seminar in database |
| DELETE | /seminaires/{id} | destroy() | Delete seminar from database |

## For This Assignment, We Use

### 1. GET /seminaires
- **Controller Method:** index()
- **What it does:** Shows list of all seminars
- **URL:** http://localhost:8000/seminaires
- **View:** seminaires.index

### 2. GET /seminaires/{id}
- **Controller Method:** show($id)
- **What it does:** Shows details of one seminar
- **URL:** http://localhost:8000/seminaires/1
- **View:** seminaires.show

### 3. DELETE /seminaires/{id}
- **Controller Method:** destroy($id)
- **What it does:** Deletes a seminar
- **URL:** http://localhost:8000/seminaires/1 (with DELETE method)
- **Redirect:** Back to seminaires.index with success message

## How to Use Routes in Views

### Link to index page
```blade
<a href="{{ route('seminaires.index') }}">View All</a>
```
Generates: `/seminaires`

### Link to show page
```blade
<a href="{{ route('seminaires.show', $seminaire->id) }}">View</a>
```
Generates: `/seminaires/1` (if id is 1)

### Form to delete
```blade
<form action="{{ route('seminaires.destroy', $seminaire->id) }}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">Delete</button>
</form>
```
Sends DELETE request to: `/seminaires/1`

## Why Use Route::resource()?

### Without Route::resource()
```php
Route::get('/seminaires', [SeminairController::class, 'index']);
Route::get('/seminaires/{id}', [SeminairController::class, 'show']);
Route::delete('/seminaires/{id}', [SeminairController::class, 'destroy']);
// ... and 4 more routes
```

### With Route::resource()
```php
Route::resource('seminaires', SeminairController::class);
```

Much cleaner and follows Laravel conventions!

## Route Names

When you use `Route::resource()`, Laravel automatically creates route names:

- `seminaires.index` - List all seminars
- `seminaires.create` - Show create form
- `seminaires.store` - Save new seminar
- `seminaires.show` - Show one seminar
- `seminaires.edit` - Show edit form
- `seminaires.update` - Update seminar
- `seminaires.destroy` - Delete seminar

You use these names with the `route()` helper function in views.

## Testing Routes

You can test routes using:

```bash
# List all routes
php artisan route:list

# List routes for seminaires
php artisan route:list | grep seminaires
```

This shows you all available routes and their details.

## Important Notes

### {id} Parameter
- `{id}` is a placeholder for the seminar ID
- When you visit `/seminaires/1`, the `1` replaces `{id}`
- The controller method receives it as a parameter: `show($id)`

### @csrf Token
- Required for POST, PUT, PATCH, DELETE requests
- Protects against Cross-Site Request Forgery attacks
- Always include it in forms

### @method('DELETE')
- HTML forms only support GET and POST
- `@method('DELETE')` tells Laravel to treat it as DELETE
- Required for the destroy() method
