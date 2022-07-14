<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
      'id',
      'order_id',
      'menu_id',
      'quantity',
      'subtotal',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id','id');
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class,'menu_id','id');
    }

}
