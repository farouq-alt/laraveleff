<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Activite extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'activities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nom',
        'description',
        'seminaire_id',
    ];

    /**
     * Get the seminar this activity belongs to.
     * An activity belongs to one seminar.
     */
    public function seminaire(): BelongsTo
    {
        return $this->belongsTo(Seminaire::class, 'seminaire_id');
    }
}
