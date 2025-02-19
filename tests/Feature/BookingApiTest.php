<?php

namespace Tests\Feature;

use App\Models\Booking;
use App\Models\Resource;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookingApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_creates_a_booking_via_api():void
    {
        $user = User::factory()->create();
        $resource = Resource::factory()->create();

        $response = $this->postJson('/api/bookings', [
            'user_id' => $user->id,
            'resource_id' => $resource->id,
            'start_time' => now()->addHour(),
            'end_time' => now()->addHours(2),
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseCount('bookings', 1);
    }

    public function test_it_deletes_a_booking()
    {
        $booking = Booking::factory()->create();

        $response = $this->deleteJson("/api/bookings/{$booking->id}");

        $response->assertStatus(200);
        $this->assertDatabaseMissing('bookings', ['id' => $booking->id]);
    }
}
