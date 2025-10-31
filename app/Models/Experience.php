<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    /**
     * Les attributs qu'on peut remplir en masse
     */
    protected $fillable = [
        'position',
        'start_date',
        'end_date',
        'city',
        'address',
        'company',
        'description',
        'user_id',
    ];

    /**
     * Relation : une expérience appartient à un utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
