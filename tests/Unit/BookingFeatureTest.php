<?php

namespace Tests\Unit;

use App\Models\Booking;
use App\Models\Resource;
use App\Models\User;
use App\Services\BookingService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingFeatureTest extends TestCase
{
   use RefreshDatabase;

   protected BookingService  $bookingService;

    protected function setUp(): void
    {
       parent::setUp();
       $this->bookingService = app(BookingService::class);
    }

    public function test_it_creates_a_booking()
    {
        $user = User::factory()->create();
        $resource = Resource::factory()->create();

        $bookingData = [
            'user_id' => $user->id,
            'resource_id' => $resource->id,
            'start_time' => now()->addHour(),
            'end_time' => now()->addHours(2),
        ];

        $booking = $this->bookingService->createBooking($bookingData);

        $this->assertInstanceOf(Booking::class, $booking);
        $this->assertDatabaseHas('bookings', $bookingData);
    }

    public function test_it_cancels_a_booking()
    {
        $booking = Booking::factory()->create();

        $this->bookingService->cancelBooking($booking);

        $this->assertDatabaseMissing('bookings', ['id' => $booking->id]);
    }
}
