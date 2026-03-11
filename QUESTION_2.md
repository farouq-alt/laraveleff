# Question 2: Migration up() Method for Seminaires Table

## What We Need to Do
Write the `up()` method for the seminaires migration file. This method defines what columns the seminaires table will have.

## Simple Explanation
The `up()` method is like a recipe that tells Laravel exactly what ingredients (columns) to add to the seminaires table. Each column stores different information about a seminar.

## What Columns We Need

| Column Name | Type | Purpose |
|------------|------|---------|
| id | Integer (Primary Key) | Unique identifier for each seminar |
| theme | String | The title/topic of the seminar |
| date_debut | Date | When the seminar starts |
| date_fin | Date | When the seminar ends |
| description | Text | Detailed description of the seminar |
| cout_journalier | Decimal | Cost per day |
| animateur_id | Integer (Foreign Key) | Links to the animator/instructor |
| created_at | Timestamp | When the record was created |
| updated_at | Timestamp | When the record was last updated |

## The Code

```php
public function up(): void
{
    Schema::create('seminaires', function (Blueprint $table) {
        $table->id();                                    // Auto-incrementing ID
        $table->string('theme');                         // Seminar title
        $table->date('date_debut');                      // Start date
        $table->date('date_fin');                        // End date
        $table->text('description')->nullable();         // Description (optional)
        $table->decimal('cout_journalier', 8, 2);       // Cost with 2 decimal places
        $table->unsignedBigInteger('animateur_id');     // Foreign key
        $table->timestamps();                            // created_at & updated_at

        // This line connects seminaires to animateurs table
        $table->foreign('animateur_id')
              ->references('id')
              ->on('animateurs')
              ->onDelete('cascade');
    });
}
```

## Understanding the Foreign Key
- `animateur_id` is a foreign key that links each seminar to an animator
- `->references('id')` means it points to the id column in animateurs table
- `->onDelete('cascade')` means if an animator is deleted, all their seminars are deleted too

## The down() Method
This reverses the migration (deletes the table):

```php
public function down(): void
{
    Schema::dropIfExists('seminaires');
}
```
