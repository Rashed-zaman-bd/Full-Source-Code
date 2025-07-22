<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ['title', 'ticket_price', 'description', 'start_time', 'end_time'];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
