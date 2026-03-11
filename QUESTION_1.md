# Question 1: Migration Commands

## What We Need to Do
Create the commands to generate migration files for two tables:
- `animateurs_table` (Animators/Instructors table)
- `create_seminaires_table` (Seminars table)
- `create_activities_table` (Activities table)

## Simple Explanation
Think of migrations like blueprints for building a house. Each migration file tells Laravel how to build a table in the database. We need to create these blueprints before we can store data.

## Commands to Run

```bash
# Create migration for animateurs table
php artisan make:migration create_animateurs_table

# Create migration for seminaires table
php artisan make:migration create_seminaires_table

# Create migration for activities table
php artisan make:migration create_activities_table
```

## What Each Command Does
1. **create_animateurs_table** - Creates a table to store instructor/animator information
2. **create_seminaires_table** - Creates a table to store seminar information
3. **create_activities_table** - Creates a table to store activities associated with seminars

## Where Files Are Created
These commands will create files in: `database/migrations/`

The files will be named like:
- `YYYY_MM_DD_HHMMSS_create_animateurs_table.php`
- `YYYY_MM_DD_HHMMSS_create_seminaires_table.php`
- `YYYY_MM_DD_HHMMSS_create_activities_table.php`

The timestamp ensures migrations run in the correct order.
