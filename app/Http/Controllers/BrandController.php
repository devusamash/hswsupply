<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    #Create Brand
    public function createBrand(Request $request)
    {   
        $validator = Validator::make($request->all(),[
            'brandId' => 'required|string',
            'brandName' => 'required|string',
            'brandDescription' => 'required|string',
        ]);

        if($validator->fails()){
            $result = array('status'=>'True', 'message'=>'Validation Error', 'error_message'=>$validator->errors());
            $responseCode = '400';
            return response()->json(['data'=>$result, 'response code'=>$responseCode]);
        }

        $brand=Brand::create([
            'brandId' => $request->brandId,
            'brandName' => $request->brandName,
            'brandDescription' => $request->brandDescription,
        ]);

        if ($brand->brandId){
            $result = array('status'=>'true', 'message'=>'Brand created successfully', 'data'=>$brand);
            $responseCode = '200';
        }
        else{
            $result = array('status'=>'true', 'message'=>'Something went wrong');
            $responseCode = '400';
        }
        return response()->json(['data'=>$result, 'response code'=>$responseCode]);
    }

    #Update Brand
    public function updateBrand(Request $request, $id){
        
        $brand = Brand::find($id);
        if(!$brand){
            $result = array('status'=>'false', 'message'=>'Brand not found');
            $responseCode = '404'; 
        }
        $validator = Validator::make($request->all(),[
            'brandName' => 'required|string',
            'brandDescription' => 'required|string',
        ]);

        if($validator->fails()){
            $result = array('status'=>'True', 'message'=>'Validation Error', 'error_message'=>$validator->errors());
            $responseCode = '400';
            return response()->json(['data'=>$result, 'response code'=>$responseCode]);
        }

        $brand->BrandName = $request->brandName;
        $brand->BrandDescription = $request->brandDescription;
        $updated = $brand->save();
        

        if ($updated){
            $result = array('status'=>'true', 'message'=>'Brand updated successfully', 'data'=>$brand);
            $responseCode = '200';
        }
        else{
            $result = array('status'=>'True', 'message'=>'Something went wrong');
            $responseCode = '400';
        }
        return response()->json(['data'=>$result, 'response code'=>$responseCode]);

    }

    #Delete Brand
    public function deleteBrand($id){
        $brand=Brand::destroy($id);
        if(!$brand){
            return response()->json(['message'=>'Brand not found']);
        }elseif($brand){
            return response()->json(['message'=>'Brand deleted successfully']);
        }else{
            return response()->json(['message'=>'Something went wrong']);
        }
    }

    #get single Brand
    public function getSingleBrand($id){
        $brand=Brand::find($id);
        if(!$brand){
            return response()->json(['message'=>'Brand not found']);
        }elseif($brand){
            $result = array('status'=>'true', 'message'=>'Brand fetched successfully', 'data'=>$brand);
            $responseCode = '200';  
        }else{
            return response()->json(['message'=>'Something went wrong']);
            $responseCode = '400'; 
        }
        return response()->json(['data'=>$result, 'response code'=>$responseCode]);
    }

    #get all brands
    public function getAllBrands(){
        $brand = Brand::all();
        if(!$brand){
            $result = array('status'=>'true', 'message'=>'No brands were found');
            $responseCode= '200';
        }elseif($brand){
            $result = array('status'=>'true', 'message'=>'Brands fetched successfully', 'data'=>$brand);
            $responseCode='200';
        }else{
            $result = array('status'=>'true', 'message'=>'Something went wrong');
            $responseCode = '400';
        }
        return response()->json(['data'=>$result, 'response code'=>$responseCode]);
        
    }

}
