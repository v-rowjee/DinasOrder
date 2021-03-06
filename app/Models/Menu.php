<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'mid',
        'title',
        'desc',
        'price',
        'category',
        'path'
    ];

    public function cart()
    {
        return $this->belongsTo(Cart::class,'id');
    }
}
