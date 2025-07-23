<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Exception;
use Illuminate\Http\Request;

class BookingsController extends Controller
{
    public function allBookings()
    {
        $bookings = Booking::with(['user', 'event'])->orderBy('id', 'desc')->get();

        if ($bookings->isEmpty()){
            return response()->json([
                'status' => false,
                'message' => 'No bookings found',
                'data' => []
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Booking fashed successfully',
            'data' => $bookings,
        ], 200);
    }

    public function getBooking(Request $request, $id)
    {
        try{
            $booking = Booking::with(['user', 'event'])->findOrFail($id);

            return response()->json([
                'status' => true,
                'message' => 'Booking fashed successfully',
                'data' => $booking,
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'Booking not found',
            ], 404);
        }
    }
}
