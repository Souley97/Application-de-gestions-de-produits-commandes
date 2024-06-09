<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;



class Produit extends Model
{
    use HasFactory;
    protected $fillable = [
        'reference',
        'designation',
        'prix_unitaire',
        'image',
        'etat',
        'categorie_id',
        'user_id'
    ];


    public function categorie()
    {
        return $this->belongsTo(Categorie::class);
    }
    
    public function user()
     {
        return $this->belongsTo(User::class);
    }
    public function commandes()
    {
        return $this->belongsToMany(Commande::class);
    }


    
}
