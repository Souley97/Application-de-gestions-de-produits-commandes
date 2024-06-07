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
        'type',
        'prix_unitaire',
        'image',
        'etat',
        'categorie_id',
        'user_id'
    ];


    public function categorie(){
        return $this->belongsTo(Categorie::class);
    }
    
    public function admin() {
        return $this->belongsTo(User::class);
    }


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($produit) {
            $produit->reference = 'ref-' . str::random(8);
        });
    }
}
