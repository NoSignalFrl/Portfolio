<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    /**
     * Les attributs qu'on peut remplir en masse
     */
    protected $fillable = [
        'skill',
        'description',
        'user_id',
    ];

    /**
     * Relation : une compétence appartient à un utilisateur
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
