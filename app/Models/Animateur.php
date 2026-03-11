<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Animateur extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'animateurs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'email',
        'telephone',
        'bio',
    ];

    /**
     * Get all seminars for this animator.
     * One animator can have many seminars.
     */
    public function seminaires(): HasMany
    {
        return $this->hasMany(Seminaire::class, 'animateur_id');
    }
}
