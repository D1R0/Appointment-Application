<?php

use App\Models\Appointments;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/schedules', function (Request $request) {
    $data = $request->content;
    if (Appointments::validator($data)) {
        if (!(Appointments::existInterval($data))) {
            $appointment = new Appointments();
            $appointment->date = $data['date'];
            $appointment->interval = $data['interval'];
            $appointment->name = $data['fullname'];
            $appointment->email = $data['email'];
            $appointment->save();
            $msg = "success";
            return response()->json($msg);
        }
        $msg = "This interval is not operable";
        return response()->json($msg);
    }
    $msg = "All fields are mandatory!";
    return response()->json($msg);
});
Route::post('/allschedules', function (Request $request) {
    $date = $request->date;
    $all = Appointments::findByDate($date);
    $response = ["status" => "ok", "data" => $all];
    return response()->json($response);
});
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});