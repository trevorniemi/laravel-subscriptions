<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Http\Controllers\Api\BaseController;
use App\Http\Resources\CustomerResource;
use App\Jobs\ImportCustomers;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Validator;

class CustomerController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Customer::all();

        return $this->sendResponse(CustomerResource::collection($products), 'Customers retrieved successfully.');
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
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $customer = Customer::create($input);

        return $this->sendResponse(new CustomerResource($customer), 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::find($id);

        if (is_null($customer)) {
            return $this->sendError('Customer not found.');
        }

        return $this->sendResponse(new CustomerResource($customer), 'Customer retrieved successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }


        if(isset($input['name'])) {
            $customer->name = $input['name'];
        }

        if(isset($input['email'])) {
            $customer->email = $input['email'];
        }

        $customer->save();

        return $this->sendResponse(new CustomerResource($customer), 'Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return $this->sendResponse([], 'Customer deleted successfully.');
    }

    public function customer()
    {
        return view('customer');
    }

    /**
     * Upload customer CSV with queue
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * 
     **/
    public function upload(Request $request)
    {
        if ($request->has('csv')) {

            $csv    = file($request->csv);
            $chunks = array_chunk($csv, 1000);
            $header = [];
            $batch  = Bus::batch([])->dispatch();

            foreach ($chunks as $key => $chunk) {
                $data = array_map('str_getcsv', $chunk);
                if ($key == 0) {
                    $header = $data[0];
                    unset($data[0]);
                }
                $batch->add(new ImportCustomers($data, $header));
            }
            return $batch;
        }
        return "Please upload a .csv file";
    }
}
