<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'description', 'stock', 'image'];

    protected $casts = [
        'price' => 'integer',
        'stock' => 'integer',
    ];

    /**
     * Get the formatted price
     */
    public function getFormattedPriceAttribute(): string
    {
        return '€' . number_format($this->price / 100, 2);
    }
}
