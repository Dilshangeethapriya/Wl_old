<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    
    protected $table = 'orders';
    protected $primaryKey = 'orderID';
    public $incrementing = false;
    protected $keyType = 'int';
    public $timestamps = false;

    // Specify the attributes that are mass assignable
    protected $fillable = [
        'customerID',
        'total',
        'orderDate',
        'paymentMethod',
        'orderStatus',
        'name',
        'phoneNumber',
        'houseNo',
        'streetName',
        'city',
        'postalCode',
        'email',
        'combPurchased',
        'quantity',
    ];

    // Define relationships (if any)
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customerID');
    }
}
