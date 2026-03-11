# Setup and Testing Guide

## Step-by-Step Setup

### Step 1: Verify All Files Are Created

Check that all files exist:

```bash
# Check migrations
ls -la database/migrations/

# Check models
ls -la app/Models/

# Check controller
ls -la app/Http/Controllers/SeminairController.php

# Check views
ls -la resources/views/seminaires/

# Check routes
cat routes/web.php
```

### Step 2: Install Dependencies

```bash
# Install PHP dependencies
composer install

# Install Node dependencies (if needed)
npm install
```

### Step 3: Setup Environment

```bash
# Copy environment file
cp .env.example .env

# Generate app key
php artisan key:generate

# Update .env with database settings
# Edit .env and set:
# DB_CONNECTION=sqlite
# Or use MySQL/PostgreSQL as needed
```

### Step 4: Run Migrations

```bash
# Run all migrations
php artisan migrate

# Check migration status
php artisan migrate:status
```

**Expected Output:**
```
Migrated: 2024_01_01_000000_create_users_table
Migrated: 2024_01_01_000001_create_cache_table
Migrated: 2024_01_01_000002_create_jobs_table
Migrated: 2024_01_01_000003_create_animateurs_table
Migrated: 2024_01_01_000004_create_seminaires_table
Migrated: 2024_01_01_000005_create_activities_table
```

### Step 5: Create Sample Data (Optional)

Create a seeder to add test data:

```bash
php artisan make:seeder SeminairSeeder
```

Edit `database/seeders/SeminairSeeder.php`:

```php
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Animateur;
use App\Models\Seminaire;
use App\Models\Activite;

class SeminairSeeder extends Seeder
{
    public function run(): void
    {
        // Create animators
        $animator1 = Animateur::create([
            'nom' => 'Jean Dupont',
            'email' => 'jean@example.com',
            'telephone' => '0123456789',
            'bio' => 'Expert en développement web',
        ]);

        $animator2 = Animateur::create([
            'nom' => 'Marie Martin',
            'email' => 'marie@example.com',
            'telephone' => '0987654321',
            'bio' => 'Spécialiste en design',
        ]);

        // Create seminars
        $seminar1 = Seminaire::create([
            'theme' => 'Séminaire Web Development',
            'date_debut' => '2024-03-01',
            'date_fin' => '2024-03-03',
            'description' => 'Séminaire avancé sur le développement web',
            'cout_journalier' => 500.00,
            'animateur_id' => $animator1->id,
        ]);

        $seminar2 = Seminaire::create([
            'theme' => 'Atelier PHP',
            'date_debut' => '2024-04-15',
            'date_fin' => '2024-04-16',
            'description' => 'Introduction approfondie à PHP',
            'cout_journalier' => 350.00,
            'animateur_id' => $animator1->id,
        ]);

        $seminar3 = Seminaire::create([
            'theme' => 'Design Thinking Workshop',
            'date_debut' => '2024-05-10',
            'date_fin' => '2024-05-12',
            'description' => 'Séminaire pratique sur le design thinking',
            'cout_journalier' => 600.00,
            'animateur_id' => $animator2->id,
        ]);

        // Create activities
        Activite::create([
            'nom' => 'Atelier pratique de développement web',
            'description' => 'Séance pratique sur les concepts avancés de développement web',
            'seminaire_id' => $seminar1->id,
        ]);

        Activite::create([
            'nom' => 'Séance de Q&A',
            'description' => 'Questions et réponses interactives sur les nouvelles technologies web',
            'seminaire_id' => $seminar1->id,
        ]);

        Activite::create([
            'nom' => 'Atelier pratique PHP',
            'description' => 'Séance pratique sur les concepts avancés de PHP',
            'seminaire_id' => $seminar2->id,
        ]);

        Activite::create([
            'nom' => 'Atelier pratique de design thinking',
            'description' => 'Séance pratique sur les concepts avancés de design thinking',
            'seminaire_id' => $seminar3->id,
        ]);
    }
}
```

Run the seeder:

```bash
php artisan db:seed --class=SeminairSeeder
```

### Step 6: Start Development Server

```bash
php artisan serve
```

**Expected Output:**
```
Laravel development server started: http://127.0.0.1:8000
```

---

## Testing the Application

### Test 1: View Seminars List

1. Open browser
2. Visit: `http://localhost:8000/seminaires`
3. Should see:
   - Page title: "Liste des Séminaires"
   - Table with columns: Thème, Date début, Date fin, Description, Coût journalier, Animateur_id, Actions
   - Rows with seminar data (if seeded)
   - Three buttons per row: Consulter, Modifier, Supprimer

**Expected Result:** ✓ List page displays correctly

### Test 2: View Seminar Details

1. On seminars list page
2. Click "Consulter" button on any seminar
3. Should see:
   - Page title: "Détails du séminaire : [ID]"
   - Seminar details card with:
     - Thème
     - Date début
     - Date fin
     - Description
     - Coût journalier
     - Animateur
   - Activities section with table showing:
     - Nom de l'activité
     - Description de l'activité
   - "Retour à la liste" button

**Expected Result:** ✓ Details page displays correctly with activities

### Test 3: Delete Seminar

1. On seminars list page
2. Click "Supprimer" button on any seminar
3. Confirmation dialog appears asking: "Êtes-vous sûr de vouloir supprimer ce séminaire?"
4. Click "OK" to confirm
5. Should see:
   - Redirect to seminars list
   - Green success message: "Séminaire supprimé avec succès"
   - Deleted seminar no longer in list

**Expected Result:** ✓ Seminar deleted successfully

### Test 4: Check Database

```bash
# Open Laravel Tinker
php artisan tinker

# Check seminars count
>>> Seminaire::count()
=> 2  (or whatever number you have)

# Get all seminars with animator
>>> Seminaire::with('animateur')->get()

# Get activities for a seminar
>>> Seminaire::find(1)->activities

# Exit Tinker
>>> exit
```

**Expected Result:** ✓ Data correctly stored in database

---

## Troubleshooting

### Issue: "Class not found" Error

**Solution:**
```bash
# Regenerate autoloader
composer dump-autoload

# Clear cache
php artisan cache:clear
php artisan route:clear
```

### Issue: "Table not found" Error

**Solution:**
```bash
# Check migration status
php artisan migrate:status

# Run migrations
php artisan migrate

# If needed, reset and re-run
php artisan migrate:reset
php artisan migrate
```

### Issue: "View not found" Error

**Solution:**
- Check file path: `resources/views/seminaires/index.blade.php`
- Check file extension: `.blade.php`
- Check directory structure exists

### Issue: Routes Not Working

**Solution:**
```bash
# List all routes
php artisan route:list

# Clear route cache
php artisan route:clear

# Check routes/web.php has the resource route
cat routes/web.php
```

### Issue: Database Connection Error

**Solution:**
```bash
# Check .env file
cat .env

# Verify database settings:
# DB_CONNECTION=sqlite (or mysql, pgsql, etc.)
# DB_DATABASE=database/database.sqlite (for SQLite)

# For SQLite, ensure file exists
touch database/database.sqlite

# Run migrations again
php artisan migrate
```

### Issue: 404 Error on Routes

**Solution:**
1. Check URL is correct: `http://localhost:8000/seminaires`
2. Check route is defined in `routes/web.php`
3. Run `php artisan route:list` to verify routes exist
4. Clear route cache: `php artisan route:clear`

---

## Verification Checklist

- [ ] All migration files created
- [ ] All model files created
- [ ] Controller file created
- [ ] View files created
- [ ] Routes defined
- [ ] Migrations ran successfully
- [ ] Database tables created
- [ ] Sample data seeded (optional)
- [ ] Development server running
- [ ] Seminars list page loads
- [ ] Seminar details page loads
- [ ] Delete functionality works
- [ ] Success messages display
- [ ] No console errors

---

## Performance Testing

### Check Query Count

Add this to controller to see how many queries run:

```php
use Illuminate\Support\Facades\DB;

public function index()
{
    DB::enableQueryLog();
    
    $seminaires = Seminaire::with('animateur')->get();
    
    dd(DB::getQueryLog()); // Shows all queries
    
    return view('seminaires.index', compact('seminaires'));
}
```

**Expected:** Should see 2 queries (one for seminaires, one for animateurs)

### Check Page Load Time

```bash
# Use Apache Bench
ab -n 100 -c 10 http://localhost:8000/seminaires

# Or use curl with timing
curl -w "@curl-format.txt" -o /dev/null -s http://localhost:8000/seminaires
```

---

## Common Test Scenarios

### Scenario 1: Empty Database
1. Run migrations
2. Don't seed data
3. Visit `/seminaires`
4. Should see: "Aucun séminaire trouvé."

### Scenario 2: Multiple Seminars
1. Seed data with multiple seminars
2. Visit `/seminaires`
3. Should see all seminars in table
4. Click each "Consulter" button
5. Should see correct details for each

### Scenario 3: Delete and Verify
1. Note seminar count
2. Delete one seminar
3. Verify count decreased by 1
4. Verify deleted seminar not in list
5. Check database: `Seminaire::count()`

### Scenario 4: Cascade Delete
1. Delete an animator
2. Check if all their seminars deleted
3. Check if all activities deleted

```php
// In Tinker
>>> $animator = Animateur::find(1);
>>> $animator->delete();
>>> Seminaire::where('animateur_id', 1)->count()
=> 0  // Should be 0 if cascade works
```

---

## Deployment Checklist

Before deploying to production:

- [ ] All tests pass
- [ ] No console errors
- [ ] No database errors
- [ ] Environment variables set correctly
- [ ] Database migrations run
- [ ] Cache cleared
- [ ] Routes cached (optional)
- [ ] Assets compiled
- [ ] Error logging configured
- [ ] Security headers set
- [ ] HTTPS enabled
- [ ] Backups configured

---

## Useful Commands Reference

```bash
# Development
php artisan serve                    # Start dev server
php artisan tinker                   # Interactive shell

# Database
php artisan migrate                  # Run migrations
php artisan migrate:rollback         # Undo last migration
php artisan migrate:reset            # Reset all migrations
php artisan db:seed                  # Run seeders
php artisan db:seed --class=SeminairSeeder

# Cache
php artisan cache:clear              # Clear cache
php artisan route:clear              # Clear route cache
php artisan view:clear               # Clear view cache

# Code Generation
php artisan make:migration name      # Create migration
php artisan make:model ModelName     # Create model
php artisan make:controller ControllerName --resource
php artisan make:seeder SeederName   # Create seeder

# Debugging
php artisan route:list               # List all routes
php artisan tinker                   # Debug in shell
php artisan config:cache             # Cache config
php artisan config:clear             # Clear config cache
```

---

## Success Indicators

You'll know everything is working when:

1. ✓ Migrations run without errors
2. ✓ Database tables created with correct columns
3. ✓ Models load without errors
4. ✓ Controller methods execute
5. ✓ Views render without errors
6. ✓ Seminars list displays
7. ✓ Seminar details display
8. ✓ Delete functionality works
9. ✓ Success messages appear
10. ✓ No console errors or warnings

---

## Next Steps

After successful setup:

1. **Add More Features**
   - Create functionality
   - Edit functionality
   - Search/filter

2. **Add Validation**
   - Form validation
   - Error messages

3. **Add Authentication**
   - User login
   - Authorization

4. **Add Testing**
   - Unit tests
   - Feature tests

5. **Deploy**
   - Choose hosting
   - Configure server
   - Deploy code

---

## Support Resources

- Laravel Documentation: https://laravel.com/docs
- Blade Syntax: https://laravel.com/docs/blade
- Eloquent ORM: https://laravel.com/docs/eloquent
- Routing: https://laravel.com/docs/routing
- Controllers: https://laravel.com/docs/controllers

Good luck with your Laravel project!
