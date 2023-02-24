<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer_model;
use Illuminate\Http\Request;
use DB;
use Validator;

class CustomerController extends Controller
{
    public function index()
    {
        return view('customer');   
    }

    public function getList()
    {
        $customer = Customer_model::get();
        return response()->json($customer, 200);
    }

    public function getDetail($id)
    {
        if(!$id) return response()->json(["error" => "Harap masukkan id"]);
        
        $customer = Customer_model::where("id",$id)->first();
        if(!$customer) return response()->json(["error" => "Customer tidak ditemukan"]);
        return response()->json([$customer], 200);
    }

    public function addCustomer(Request $request){
        \Log::debug($request);
        $validator = Validator::make($request->all(), [
            'name' => 'bail|required|max:100',
            'email' => 'bail|required|max:100',
            'password' => 'bail|required|max:100',
            'gender' => 'bail|required|in:FEMALE,MALE',
            'is_married' => 'bail|required',
            'address' => 'bail|required|max:100'
        ]);
        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()->first()], 422);
        }
        try {
            DB::beginTransaction();

            $customer = new Customer_model;
            $customer->name = $request->input("name");
            $customer->email = $request->input("email");
            $customer->password = bcrypt($request->input("password"));
            $customer->gender = $request->input("gender");
            $customer->is_married = $request->input("is_married");
            $customer->address = $request->input("address");
            $customer->save();
            
            $response = [
                'success' => true,
                'data_saved' =>$customer
            ];
            DB::commit();

            return response()->json($response,200);
        }
        catch(\Exception $e) {
            DB::rollback();
            \Log::info($e);
            return response()->json(["success" => false]);
        }
    }

    public function updateCustomer(Request $request,$id){
        $validator = Validator::make($request->all(), [
            'name' => 'bail|required|max:100',
            'email' => 'bail|required|max:100',
            'gender' => 'bail|required|max:10',
            'is_married' => 'bail|required',
            'address' => 'bail|required|max:100'
        ]);
        if ($validator->fails()) {
            return response()->json(["error" => $validator->errors()->first()], 422);
        }
        
        if(!$id) return response()->json(["error" => "Harap masukkan id"]);
        
        $customer = Customer_model::where("id",$id)->first();
        if(!$customer) return response()->json(["error" => "Customer tidak ditemukan"]);

        try {
            DB::beginTransaction();

            $customer->name = $request->input("name");
            $customer->email = $request->input("email");
            $customer->gender = $request->input("gender");
            $customer->is_married = $request->input("is_married");
            $customer->address = $request->input("address");
            $customer->save();
            
            $response = [
                'success' => true,
                'data_saved' =>$customer
            ];
            DB::commit();

            return response()->json($response,200);
        }
        catch(\Exception $e) {
            DB::rollback();
            \Log::info($e);
            return response()->json(["success" => "False"]);
        }
    }

    public function deleteCustomer($id){
        if(!$id) return response()->json(["error" => "Harap masukkan id"]);
        try {
            DB::beginTransaction();

            Customer_model::find($id)->delete();
            
            $response = [
                'success' => true,
                'deleted_id' =>$id
            ];

            DB::commit(); 
            return response()->json($response,200);

        }
        catch(\Exception $e) {
            DB::rollback();
            \Log::info($e);
            return response()->json(["error" => "Delete gagal"]);
        }
    }
}
