# How to Run the Application

## Step 1: Run Migrations (if not already done)

```bash
php artisan migrate
```

## Step 2: Seed Sample Data

```bash
php artisan db:seed --class=SeminairSeeder
```

This will create:
- 2 animators (Jean Dupont, Marie Martin)
- 3 seminars with different themes
- 4 activities associated with the seminars

## Step 3: Start the Development Server

```bash
php artisan serve
```

You should see:
```
Laravel development server started: http://127.0.0.1:8000
```

## Step 4: Open in Browser

Visit: **http://localhost:8000/seminaires**

You should now see:
- A list of all seminars in a table
- Three action buttons for each seminar: Consulter, Modifier, Supprimer
- A success message area (if you delete a seminar)

## Testing the Features

### 1. View Seminars List
- Visit http://localhost:8000/seminaires
- You should see 3 seminars listed

### 2. View Seminar Details
- Click the "Consulter" button on any seminar
- You should see:
  - Seminar details (theme, dates, description, cost, animator)
  - List of activities for that seminar
  - A "Retour à la liste" button to go back

### 3. Delete a Seminar
- Click the "Supprimer" button on any seminar
- A confirmation dialog will appear
- Click "OK" to confirm deletion
- You should be redirected to the list with a success message
- The deleted seminar should no longer appear in the list

## If You Don't See Anything

### Problem 1: Blank Page
**Solution:** Make sure you ran the seeder:
```bash
php artisan db:seed --class=SeminairSeeder
```

### Problem 2: "View not found" Error
**Solution:** The layout file should now exist at `resources/views/layouts/app.blade.php`

### Problem 3: "Class not found" Error
**Solution:** Clear the cache:
```bash
php artisan cache:clear
php artisan route:clear
```

### Problem 4: Database Error
**Solution:** Check migrations ran:
```bash
php artisan migrate:status
```

All should show "Ran" status.

## Quick Verification

Run this command to verify everything is set up:

```bash
php artisan tinker
>>> Seminaire::count()
=> 3
>>> Animateur::count()
=> 2
>>> Activite::count()
=> 4
>>> exit
```

If you see the numbers above, everything is working!

## Summary

1. `php artisan migrate` - Create tables
2. `php artisan db:seed --class=SeminairSeeder` - Add sample data
3. `php artisan serve` - Start server
4. Visit `http://localhost:8000/seminaires` - See the application

That's it! You should now see the seminars management system working.
