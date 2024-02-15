<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    #Create Customer
    public function createCategory(Request $request)
    {   
        $validator = Validator::make($request->all(),[
            'categoryId' => 'required|string',
            'categoryName' => 'required|string',
            'categoryDescription' => 'required|string',
        ]);

        if($validator->fails()){
            $result = array('status'=>'True', 'message'=>'Validation Error', 'error_message'=>$validator->errors());
            $responseCode = '400';
            return response()->json(['data'=>$result, 'response code'=>$responseCode]);
        }

        $category=Category::create([
            'categoryId' => $request->categoryId,
            'categoryName' => $request->categoryName,
            'categoryDescription' => $request->categoryDescription,
        ]);

        if ($category->categoryId){
            $result = array('status'=>'true', 'message'=>'Category created successfully', 'data'=>$category);
            $responseCode = '200';
        }
        else{
            $result = array('status'=>'true', 'message'=>'Something went wrong');
            $responseCode = '400';
        }
        return response()->json(['data'=>$result, 'response code'=>$responseCode]);
    }

    #Update Category
    public function updateCategory(Request $request, $id){
        
        $category = Category::find($id);
        if(!$category){
            $result = array('status'=>'false', 'message'=>'Category not found');
            $responseCode = '404'; 
        }
        $validator = Validator::make($request->all(),[
            'categoryName' => 'required|string',
            'categoryDescription' => 'required|string',
        ]);

        if($validator->fails()){
            $result = array('status'=>'True', 'message'=>'Validation Error', 'error_message'=>$validator->errors());
            $responseCode = '400';
            return response()->json(['data'=>$result, 'response code'=>$responseCode]);
        }

        $category->categoryName = $request->categoryName;
        $category->categoryDescription = $request->categoryDescription;
        $updated = $category->save();
        

        if ($updated){
            $result = array('status'=>'true', 'message'=>'Category updated successfully', 'data'=>$category);
            $responseCode = '200';
        }
        else{
            $result = array('status'=>'True', 'message'=>'Something went wrong');
            $responseCode = '400';
        }
        return response()->json(['data'=>$result, 'response code'=>$responseCode]);

    }

    #Delete Category
    public function deleteCategory($id){
        $category=Category::destroy($id);
        if(!$category){
            return response()->json(['message'=>'Category not found']);
        }elseif($category){
            return response()->json(['message'=>'Category deleted successfully']);
        }else{
            return response()->json(['message'=>'Something went wrong']);
        }
    }

    #get single category
    public function getSingleCategory($id){
        $category=Category::find($id);
        if(!$category){
            return response()->json(['message'=>'Category not found']);
        }elseif($category){
            $result = array('status'=>'true', 'message'=>'Category fetched successfully', 'data'=>$category);
            $responseCode = '200';  
        }else{
            return response()->json(['message'=>'Something went wrong']);
            $responseCode = '400'; 
        }
        return response()->json(['data'=>$result, 'response code'=>$responseCode]);
    }

    #get all categories
    public function getAllCategories(){
        $categories = Category::all();
        if(!$categories){
            $result = array('status'=>'true', 'message'=>'No categories were found');
            $responseCode= '200';
        }elseif($categories){
            $result = array('status'=>'true', 'message'=>'Categories fetched successfully', 'data'=>$categories);
            $responseCode='200';
        }else{
            $result = array('status'=>'true', 'message'=>'Something went wrong');
            $responseCode = '400';
        }
        return response()->json(['data'=>$result, 'response code'=>$responseCode]);
        
    }

}
