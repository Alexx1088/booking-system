<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookingRequest;
use App\Http\Resources\BookingResource;
use App\Models\Booking;
use App\Services\BookingService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

/**
 * @OA\Info(
 *      title="Booking Management API",
 *      version="1.0",
 *      description="API for managing resource bookings"
 * )
 * @OA\Tag(
 *     name="Bookings",
 *     description="API Endpoints for Bookings"
 * )
 */

class BookingController extends Controller
{
    public function __construct(protected BookingService $bookingService)
    {}

    /**
     * @OA\Post(
     *      path="/api/bookings",
     *      tags={"Bookings"},
     *      summary="Create a new booking",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(
     *              required={"resource_id","user_id","start_time","end_time"},
     *              @OA\Property(property="resource_id", type="integer", example=1),
     *              @OA\Property(property="user_id", type="integer", example=1),
     *              @OA\Property(property="start_time", type="string", format="date-time", example="2025-02-23 14:49:55"),
     *              @OA\Property(property="end_time", type="string", format="date-time", example="2025-02-23 18:03:55")
     *          )
     *      ),
     *      @OA\Response(response=201, description="Booking created"),
     *      @OA\Response(response=400, description="Validation error")
     * )
     */

    public function store(StoreBookingRequest $request): BookingResource
    {
        $booking = $this->bookingService->createBooking($request->validated());
        return new BookingResource($booking);
    }

    /**
     * @OA\Delete(
     *      path="/api/bookings/{id}",
     *      tags={"Bookings"},
     *      summary="Cancel a booking",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="Booking ID",
     *          @OA\Schema(type="integer", example=1)
     *      ),
     *      @OA\Response(response=200, description="Booking has been cancelled"),
     *      @OA\Response(response=404, description="Booking not found")
     * )
     */

    public function destroy($id): \Illuminate\Http\JsonResponse
    {
        try {
            $booking = Booking::findOrFail($id);
            $this->bookingService->cancelBooking($booking);

            return response()->json(['message' => 'Booking has been cancelled'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([
                'error' => 'Not Found',
                'message' => 'The booking does not exist or has already been deleted.'
            ], 404);
        }
    }

    /**
     * @OA\Get(
     *      path="/api/resources/{id}/bookings",
     *      tags={"Bookings"},
     *      summary="Get all bookings for a specific resource",
     *      @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="Resource ID",
     *          @OA\Schema(type="integer", example=1)
     *      ),
     *      @OA\Response(response=200, description="List of bookings"),
     *      @OA\Response(response=404, description="Resource not found")
     * )
     */

    public function getByResource($resourceId): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return BookingResource::collection($this->bookingService->getBookingByResource($resourceId));
    }

}
