<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference' ,
        'montant_total' ,
        'etat_commande' ,
        'client_id' 
    ];

    public function produits()
    {
        return $this->belongsToMany(Produit::class);
    }


    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function commandeProduit()
    {
        return $this->hasMany(CommandeProduit::class);
    }
}


