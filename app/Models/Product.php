<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Specify the table name if it's not the plural form of the model name
    protected $table = 'product';

    // Define which attributes can be mass-assigned
    protected $fillable = ['productID', 'productName', 'stockLevel', 'description','price','image'];

    // If your table has timestamps (created_at, updated_at), this is true by default
    public $timestamps = true;

    // Define the relationship to reviews
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
