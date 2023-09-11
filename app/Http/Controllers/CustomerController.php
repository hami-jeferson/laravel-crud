<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomeCreateRequest;
use App\Http\Requests\CustomeUpdateRequest;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::all();
        return response()->json(['message' => 'Customer list',
                                 'customer' => CustomerResource::collection($customers)], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomeCreateRequest $request)
    {
        $customer = Customer::create($request->all());
        return response()->json(['message' => 'Customer created successfully',
                                'customer' => new CustomerResource($customer)], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::findOrFail($id);
        return response()->json(['message' => 'Customer',
                                 'customer' => new CustomerResource($customer)], 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomeUpdateRequest $request, string $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->fill($request->all());
        $customer->save();

        return response()->json(['message' => 'Customer Updated',
                                 'customer' => new CustomerResource($customer)], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Customer::destroy($id);
        return response()->json(['message' => 'Customer deleted successfully'], 200);
    }
}
