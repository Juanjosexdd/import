<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'serie',
        'correlaive',
        'base',
        'iva',
        'total',
        'user_id'
    ];

    /** QUERY SCOPE */

    public function scopeFilter($query, $filters)
    {
        $query->when($filters['serie'] ?? null, function($query, $serie){
            $query->where('serie', $serie);
        })->when($filters['fromNumber'] ?? null, function($query, $fromNumber){
            $query->where('correlative', '>=', $fromNumber);
        })->when($filters['toNumber'] ?? null, function($query, $toNumber){
            $query->where('correlative', '<=', $toNumber);
        })->when($filters['fromDdate'] ?? null, function($query, $fromDdate){
            $query->where('created_at', '>=', $fromDdate);
        })->when($filters['toDdate'] ?? null, function($query, $toDdate){
            $query->where('created_at', '<=', $toDdate);
        });
    }

    /** RELACION UNO A MUCHOS INVERSO */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
