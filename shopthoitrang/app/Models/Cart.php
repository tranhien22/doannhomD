<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $primaryKey = 'id_cart';
    public $incrementing = true;
    protected $fillable = [
        'id_user',
        'id_product',
        'quantity_product',
        'total_cart',
    ]; 
}
