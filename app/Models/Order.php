<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // Specify which fields can be mass-assigned
    protected $fillable = [
        'customer_id',
        'service_id',
        'order_date',
        'status',
        'weight',
        'price', // Uncomment this if you want to allow price to be mass-assigned
        'date_taken',
    ];

    // Define the relationship to the Customer model
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Define the relationship to the Service model
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    // Optionally, you might want to define an accessor for formatted price
    public function getFormattedPriceAttribute()
    {
        return 'Rp ' . number_format($this->price, 2);
    }

    // Optionally, you might want to define an accessor for formatted order date
    public function getFormattedOrderDateAttribute()
    {
        return date('d M Y', strtotime($this->order_date)); // Format the order date
    }
}

