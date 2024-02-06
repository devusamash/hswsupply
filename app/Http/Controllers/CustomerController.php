<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    #Create Customer
    public function createCustomer(Request $request)
    {   
        $validator = Validator::make($request->all(),[
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|string|unique:customers',
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'password' => 'required|string|min:8',
            'company' => 'string',
        ]);

        if($validator->fails()){
            $result = array('status'=>'True', 'message'=>'Validation Error', 'error_message'=>$validator->errors());
            $responseCode = '400';
            return response()->json(['data'=>$result, 'response code'=>$responseCode]);
        }

        $customer=Customer::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'state' => $request->state,
            'country' => $request->country,
            'password' => $request->password,
            'company' => $request->company,
        ]);

        if ($customer->id){
            $result = array('status'=>'true', 'message'=>'Customer created successfully', 'data'=>$customer);
            $responseCode = '200';
        }
        else{
            $result = array('status'=>'true', 'message'=>'Something went wrong');
            $responseCode = '400';
        }
        return response()->json(['data'=>$result, 'response code'=>$responseCode]);
    }

    #Display all users
    public function show()
    {
        $Customers = Customer::all();
        if(!$Customers){
            $result = array('status'=>'true', 'message'=>'No customers found');
            $responseCode = '200';
        }elseif($Customers){
            $result = array('status'=>'true', 'message'=>count($Customers). ' customer(s) found', 'data'=>$Customers);
            $responseCode = '200';
        }else{
            $result = array('status'=>'false', 'message'=> 'Something went wrong');
            $responseCode = '400';
        }
        
        return response()->json(['data'=>$result, 'response code'=>$responseCode]);
    }

    #Display single user
    public function showSingle($id)
    {
        $Customer = Customer::find($id);
        if(!$Customer){
            $result = array('status'=>'true', 'message'=>'Customer not found');
            $responseCode = '200'; 
        }elseif($Customer){
            $result = array('status'=>'true', 'message'=>'Customer fetched successfully', 'data'=>$Customer);
            $responseCode = '200';  
        }else{
            $result = array('status'=>'false', 'message'=>'Something went wrong');
            $responseCode = '400';  
        }
        return response()->json(['data'=>$result, 'response code'=>$responseCode]);
    }

    #Customer update
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);
        if(!$customer){
            $result = array('status'=>'false', 'message'=>'Customer not found');
            $responseCode = '400'; 
        }
        $validator = Validator::make($request->all(),[
            'firstName' => 'required|string',
            'lastName' => 'required|string',
            'email' => 'required|string|unique:customers,email,'.$id,
            'phone' => 'required|numeric',
            'address' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'company' => 'string',
        ]);

        if($validator->fails()){
            $result = array('status'=>'True', 'message'=>'Validation Error', 'error_message'=>$validator->errors());
            $responseCode = '400';
            return response()->json(['data'=>$result, 'response code'=>$responseCode]);
        };

        $customer->firstName=$request->firstName;
        $customer->lastName=$request->lastName;
        $customer->email=$request->email;
        $customer->phone=$request->phone;
        $customer->company=$request->company;
        $customer->address=$request->address;
        $customer->state=$request->state;
        $customer->country=$request->country;
        $customer->save();

        if ($customer->id){
            $result = array('status'=>'true', 'message'=>'Customer updated successfully', 'data'=>$customer);
            $responseCode = '200';
        }
        else{
            $result = array('status'=>'True', 'message'=>'Something went wrong');
            $responseCode = '400';
        }
        return response()->json(['data'=>$result, 'response code'=>$responseCode]);
    }

    #Customer delete
    public function destroy($id)
    {
        $customer=Customer::destroy($id);
        if(!$customer){
            return response()->json(['message'=>'Customer not found']);
        }elseif($customer){
            return response()->json(['message'=>'Customer deleted successfully']);
        }else{
            return response()->json(['message'=>'Something went wrong']);
        }
        
    }
}
