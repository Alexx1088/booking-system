<?php

namespace App\Services;

use App\Models\Booking;
use App\Repositories\BookingRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookingService
{
    public function __construct(protected BookingRepository $bookingRepository)
    {
    }

    public function createBooking(array $data): Booking
    {
        return $this->bookingRepository->create($data);
    }

    public function getBookingByResource($resourceId): \Illuminate\Database\Eloquent\Collection
    {
        return $this->bookingRepository->getByResource($resourceId);
    }

    public function cancelBooking(Booking $booking): void
    {
        try {
            $booking->delete();
        } catch (Exception $e) {
            throw new ModelNotFoundException("Failed to cancel booking: " . $e->getMessage());
        }
    }
}
