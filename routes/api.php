<?php

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Resources\CustomerResource;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/customers', function(){
    $customers = Customer::orderBy('id', 'DESC')->paginate(5);
    return CustomerResource::collection($customers);
});

Route::get('/customers/{id}', function($id){
    $customer = new CustomerResource(Customer::findOrFail($id));
    return response()->json([
        'data' => $customer,
        'status' => 200
    ]);
});
