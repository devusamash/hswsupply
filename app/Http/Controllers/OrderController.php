<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class OrderController extends Controller
{
    public function createOrder(Request $request)
{   
    $validator = Validator::make($request->all(),[
        'orderId' => 'required',
        'customerId' => 'required',
        'orderDate' => 'required',
        'orderTotal' => 'required|numeric',
    ]);

    if($validator->fails()){
        $result = array('status'=>'true', 'message'=>'Validation Error', 'error_message'=>$validator->errors());
        $responseCode = '400';
        return response()->json(['data'=>$result, 'response code'=>$responseCode]);
    }
    
    $order = Order::create([
        'orderId' => $request->orderId,
        'customerId' => $request->customerId,
        'orderDate' => $request->orderDate,
        'orderTotal' => $request->orderTotal,
    ]);

    $customer = Customer::find($request->customerId);
    if (!$customer) {
        $result = array('status' => 'true', 'message' => 'Validation Error', 'error_message' => 'Customer with provided ID not found');
        $responseCode = '400';
        return response()->json(['data' => $result, 'response code' => $responseCode]);
    }

    if ($order->orderId){
        $result = array('status'=>'true', 'message'=>'Order created successfully', 'data'=>$order);
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
        $orders = Order::all();
        if(!$orders){
            $result = array('status'=>'true', 'message'=>'No orders found');
            $responseCode = '200';
        }elseif($orders){
            $result = array('status'=>'true', 'message'=>count($orders). ' orders(s) found', 'data'=>$orders);
            $responseCode = '200';
        }else{
            $result = array('status'=>'false', 'message'=> 'Something went wrong');
            $responseCode = '400';
        }
        
        return response()->json(['data'=>$result, 'response code'=>$responseCode]);
    }

    # Display single order
    public function showSingle($id)
    {
        $order = Order::where('orderID', $id)->first();
        if(!$order){
            $result = array('status'=>'true', 'message'=>'Order not found');
            $responseCode = '200'; 
        } else {
            $result = array('status'=>'true', 'message'=>'Order fetched successfully', 'data'=>$order);
            $responseCode = '200';  
        }
        return response()->json(['data'=>$result, 'response code'=>$responseCode]);
    }


    #Order delete
    public function destroy($id)
    {
        $order=Order::destroy($id);
        if(!$order){
            return response()->json(['message'=>'Order not found']);
        }elseif($order){
            return response()->json(['message'=>'Order deleted successfully']);
        }else{
            return response()->json(['message'=>'Something went wrong']);
        }
    }

    public function showCustomerOrders($customerId)
{
    // Find the customer by their ID
    $customer = Customer::find($customerId);

    if(!$customer){
        $result = array('status'=>'true', 'message'=>'Customer not found');
        $responseCode = '404';
        return response()->json(['data'=>$result, 'response code'=>$responseCode]);
    }

    // Fetch orders associated with the customer using the defined relationship
    $orders = $customer->orders;

    if($orders->isEmpty()){
        $result = array('status'=>'true', 'message'=>'No orders found for this customer');
        $responseCode = '200';
    } else {
        $result = array('status'=>'true', 'message'=>count($orders). ' order(s) found for this customer', 'data'=>$orders);
        $responseCode = '200';
    }

    return response()->json(['data'=>$result, 'response code'=>$responseCode]);
}


    
}
