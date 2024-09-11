<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    // Specify the table name if it's not the plural form of the model name
    protected $table = 'review';

    // Define which attributes can be mass-assigned
    protected $fillable = ['reviewID','product_id','customerID', 'rating', 'reviewText', 'createdAt'];

    // If your table has timestamps (created_at, updated_at), this is true by default
    public $timestamps = true;

    // Define the relationship to the product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}