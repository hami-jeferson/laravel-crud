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
     * @OA\Schema(
     *     schema="CustomerResource",
     *     @OA\Property(property="id", type="integer"),
     *     @OA\Property(property="firstname", type="string"),
     *     @OA\Property(property="lastname", type="string"),
     *     @OA\Property(property="date_of_birth", type="string"),
     *     @OA\Property(property="phone_number", type="string"),
     *     @OA\Property(property="email", type="string"),
     *     @OA\Property(property="bank_account_number", type="string"),
     * )
     * @OA\Get(
     *     path="/api/customer",
     *     summary="Retrieve a list of customers",
     *     tags={"Customers"},
     *     @OA\Response(
     *         response=200,
     *         description="List of customers",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(
     *                 property="customer",
     *                 type="array",
     *                 @OA\Items(ref="#/components/schemas/CustomerResource")
     *             )
     *         )
     *     )
     * )
     */
    public function index()
    {
        $customers = Customer::all();
        return response()->json(['success' => true,
                                 'customer' => CustomerResource::collection($customers)], 200);
    }

    /**
     * @OA\Schema(
     *     schema="CustomerCreateRequest",
     *     @OA\Property(property="firstname", type="string"),
     *     @OA\Property(property="lastname", type="string"),
     *     @OA\Property(property="date_of_birth", type="string"),
     *     @OA\Property(property="phone_number", type="string"),
     *     @OA\Property(property="email", type="string"),
     *     @OA\Property(property="bank_account_number", type="string"),
     * )
     * @OA\Post(
     *     path="/api/customer",
     *     summary="Create a new customer",
     *     tags={"Customers"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/CustomerCreateRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Customer created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/CustomerResource")
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     ),
     *     @OA\Response(
     *         response=406,
     *         description="Not Acceptable",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Not Acceptable. You must specify 'application/json' in the Accept header.")
     *         )
     *     )
     * )
     */
    public function store(CustomeCreateRequest $request)
    {
        $customer = Customer::create($request->all());
        return response()->json(['success'=>true,
                                'message' => 'Customer created successfully',
                                'customer' => new CustomerResource($customer)], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/customer/{id}",
     *     summary="Retrieve a customer by ID",
     *     tags={"Customers"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Customer ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Customer details",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(
     *                 property="customer",
     *                 type="object",
     *                 ref="#/components/schemas/CustomerResource"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Customer not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Customer not found")
     *         )
     *     )
     * )
     */
    public function show(string $id)
    {
        $customer = Customer::findOrFail($id);
        return response()->json(['success' => true,
                                 'customer' => new CustomerResource($customer)], 200);
    }

    /**
     * @OA\Schema(
     *     schema="CustomeUpdateRequest",
     *     @OA\Property(property="firstname", type="string"),
     *     @OA\Property(property="lastname", type="string"),
     *     @OA\Property(property="date_of_birth", type="string"),
     *     @OA\Property(property="phone_number", type="string"),
     *     @OA\Property(property="email", type="string"),
     *     @OA\Property(property="bank_account_number", type="string"),
     * )
     * @OA\Put(
     *     path="/api/customer/{id}",
     *     summary="Update a customer by ID",
     *     tags={"Customers"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Customer ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Customer data to update",
     *         @OA\JsonContent(ref="#/components/schemas/CustomeUpdateRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Customer updated successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Customer updated successfully"),
     *             @OA\Property(
     *                 property="customer",
     *                 type="object",
     *                 ref="#/components/schemas/CustomerResource"
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Customer not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Customer not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="The given data was invalid."),
     *             @OA\Property(
     *                 property="errors",
     *                 type="object",
     *                 ref="#/components/schemas/CustomeUpdateRequest"
     *             )
     *         )
     *     )
     * )
     */
    public function update(CustomeUpdateRequest $request, string $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->fill($request->all());
        $customer->save();

        return response()->json(['success'=>true,
                                 'message' => 'Customer updated successfully',
                                 'customer' => new CustomerResource($customer)], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/customer/{id}",
     *     summary="Delete a customer by ID",
     *     tags={"Customers"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Customer ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Customer deleted successfully",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Customer deleted successfully")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Customer not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Customer not found")
     *         )
     *     )
     * )
     */
    public function destroy(string $id)
    {
        Customer::destroy($id);
        return response()->json(['success'=>true,
                                 'message' => 'Customer deleted successfully'], 200);
    }
}
