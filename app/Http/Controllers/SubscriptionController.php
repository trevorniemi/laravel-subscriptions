<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\SubscriptionResource;
use Illuminate\Validation\Validator;

class SubscriptionController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $subscriptions = Subscription::join('companies', 'subscriptions.company_id', '=', 'companies.id')
            ->get(['subscriptions.*', 'companies.name as company_name']);

        return $this->sendResponse(SubscriptionResource::collection($subscriptions), 'Subscriptions retrieved successfully.');
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
            'name' => 'required',
            'detail' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $subscription = Subscription::create($input);

        return $this->sendResponse(new SubscriptionResource($subscription), 'Subscription created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subscription = Subscription::join('companies', 'subscriptions.company_id', '=', 'companies.id')
            ->where('subscriptions.id', '=', $id)
            ->get(['subscriptions.*', 'companies.name as company_name'])
            ->first();


        if (is_null($subscription)) {
            return $this->sendError('Subscription not found.');
        }

        return $this->sendResponse(new SubscriptionResource($subscription), 'Subscription retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscription $subscription)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'detail' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $subscription->name = $input['name'];
        $subscription->detail = $input['detail'];
        $subscription->save();

        return $this->sendResponse(new SubscriptionResource($subscription), 'Subscription updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subscription $subscription)
    {
        $subscription->delete();

        return $this->sendResponse([], 'Subscription deleted successfully.');
    }
}
