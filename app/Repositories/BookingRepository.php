<?php

namespace App\Repositories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Collection;

class BookingRepository
{
    public function getByResource($resourceId): Collection
    {
        return Booking::where('resource_id', $resourceId)->get();
    }

    public function create(array $data): Booking
    {
        return Booking::create($data);
    }

    public function delete($booking): ?bool
    {
        return Booking::destroy($booking->id);
    }

}
