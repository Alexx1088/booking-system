<?php

namespace App\Observers;

use App\Models\Booking;
use Illuminate\Support\Facades\Log;

class BookingObserver
{
    /**
     * Handle the Booking "created" event.
     */
    public function created(Booking $booking): void
    {
        Log::info('Booking created', ['booking' => $booking->id]);
    }


    /**
     * Handle the Booking "deleted" event.
     */
    public function deleted(Booking $booking): void
    {
        Log::info("Booking cancelled: " . $booking->id);
    }

}
