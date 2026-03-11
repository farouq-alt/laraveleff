<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seminaire extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'seminaires';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'theme',
        'date_debut',
        'date_fin',
        'description',
        'cout_journalier',
        'animateur_id',
    ];

    /**
     * Get the animator for this seminar.
     * A seminar belongs to one animator.
     */
    public function animateur(): BelongsTo
    {
        return $this->belongsTo(Animateur::class, 'animateur_id');
    }

    /**
     * Get all activities for this seminar.
     * A seminar can have many activities.
     */
    public function activities(): HasMany
    {
        return $this->hasMany(Activite::class, 'seminaire_id');
    }
}
