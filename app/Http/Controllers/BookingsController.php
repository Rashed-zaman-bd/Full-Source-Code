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
            'message' => 'Booking fetched successfully',
            'data' => $bookings,
        ], 200);
    }

    public function getBooking(Request $request, $id)
    {
        try{
            $booking = Booking::with(['user', 'event'])->findOrFail($id);

            return response()->json([
                'status' => true,
                'message' => 'Booking fetched successfully',
                'data' => $booking,
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'status' => false,
                'message' => 'Booking not found',
            ], 404);
        }
    }

    public function createBooking(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'event_id' => 'required',
            'ticket_qty' => 'required',
            'ticket_price' => 'required',
            'total_price' => 'required'
        ]);
        try{
            $booking = new Booking();
            $booking->user_id = $request->user_id;
            $booking->event_id = $request->event_id;
            $booking->ticket_qty = $request->ticket_qty;
            $booking->ticket_price = $request->ticket_price;
            $booking->total_price = $request->total_price;
            $booking->save();

            return response()->json([
                'message' => 'Insert successfully',
                'data' => $booking,
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'message' => 'Data not insert',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

   public function updateBooking(Request $request, $id)
    {
        $request->validate([
            'user_id'      => 'required|exists:users,id',
            'event_id'     => 'required|exists:events,id',
            'ticket_qty'   => 'required|integer|min:1',
            'ticket_price' => 'required|numeric|min:0',
        ]);

        $booking = Booking::findOrFail($id);

        $total_price = $request->ticket_qty * $request->ticket_price;

        $booking->update([
            'user_id'      => $request->user_id,
            'event_id'     => $request->event_id,
            'ticket_qty'   => $request->ticket_qty,
            'ticket_price' => $request->ticket_price,
            'total_price'  => $total_price,
        ]);

        return response()->json([
            'message' => 'Booking updated successfully',
            'data'    => $booking,
        ]);
    }

    // delete booking
        public function deleteBooking(Request $request, $id)
    {
        Booking::destroy($id);

        return response()->json([
            'message' => 'delete successfully',
            'data' => ''
        ]);
    }

}
