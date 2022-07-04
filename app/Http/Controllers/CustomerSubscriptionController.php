<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerSubscription;
use App\Models\Customer;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\CustomerSubscriptionsResource;
use Illuminate\Support\Facades\Validator;

class CustomerSubscriptionController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $customerSubscriptions = CustomerSubscription::join('subscriptions', 'customer_subscriptions.subscription_id', '=', 'subscriptions.id')
            ->join('customers', 'customer_subscriptions.customer_id', '=', 'customers.id')
            ->get(['customer_subscriptions.*', 'subscriptions.name as name', 'customers.name as customer_name', 'customers.id as customer_id']);

        return $this->sendResponse(CustomerSubscriptionsResource::collection($customerSubscriptions), 'CustomerSubscriptions retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $customerSubscription = CustomerSubscription::create($input);

        return $this->sendResponse(new CustomerSubscriptionsResource($customerSubscription), 'CustomerSubscription created successfully.');
    }

    /**
     * Display the specified resource by customer id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function byCustomer($id)
    {
        $customerSubscriptions = Customer::find($id)->customerSubscriptions;

        if (is_null($customerSubscriptions)) {
            return $this->sendError('CustomerSubscription not found.');
        }

        return $this->sendResponse(CustomerSubscriptionsResource::collection($customerSubscriptions), 'CustomerSubscriptions retrieved successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


        $customerSubscription = CustomerSubscription::join('subscriptions', 'customer_subscriptions.subscription_id', '=', 'subscriptions.id')
            ->where('customer_subscriptions.id', '=', $id)
            ->get(['customer_subscriptions.*', 'subscriptions.name as name'])
            ->first();


        if (is_null($customerSubscription)) {
            return $this->sendError('CustomerSubscription not found.');
        }

        return $this->sendResponse(new CustomerSubscriptionsResource($customerSubscription), 'CustomerSubscription retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerSubscription $customerSubscription)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        if(isset($input['frequency'])) {
            $customerSubscription->frequency = $input['frequency'];
        }

        if(isset($input['subscription_id'])) {
            $customerSubscription->subscription_id = $input['subscription_id'];
        }

        if(isset($input['customer_id'])) {
            $customerSubscription->customer_id = $input['customer_id'];
        }

        if(isset($input['quantity'])) {
            $customerSubscription->quantity = $input['quantity'];
        }

        if(isset($input['status'])) {
            $customerSubscription->status = $input['status'];
        }

        if(isset($input['term'])) {
            $customerSubscription->term = $input['term'];
        }

        if(isset($input['price'])) {
            $customerSubscription->price = $input['price'];
        }

        $customerSubscription->save();

        return $this->sendResponse(new CustomerSubscriptionsResource($customerSubscription), 'CustomerSubscription updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerSubscription $customerSubscription)
    {
        $customerSubscription->delete();

        return $this->sendResponse([], 'CustomerSubscription deleted successfully.');
    }
}
