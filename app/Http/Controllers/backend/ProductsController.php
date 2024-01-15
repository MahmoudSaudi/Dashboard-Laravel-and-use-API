<?php

namespace App\Http\Controllers\backend;

use App\Traits\generalTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductsController extends Controller
{
    use generalTrait;
    public function index(){
        // $products //->latest()
        // query builder, eloquent
        $products = DB::table('products')
            ->select('id','name_en', 'name_ar', 'price', 'quantity', 'status', 'created_at')
            ->orderBy('name_en','desc') 
            ->get();
        // print_r($products);die;
        // dd($products);
        return view('products.index',compact('products'));
    }
    public function create(){
        $brands = DB::table('brands')->select('name_en', 'name_ar', 'id')->get();
        $subcategories = DB::table('subcategories')->select('name_en', 'name_ar', 'id')->get();
        return view('products.create', compact('brands','subcategories'));
    }
    public function store(StoreProductRequest $request){
        // dependancy injection 
        // dd($request->all());
        // $request->validate($rules);
        $data =$request->except('_token','index','return','photo');
        $data = $this->uploadPhoto($request, $data, 'products\\');
        DB::table('products')->insert($data);
        return $this->redirectAcoordingRequest($request);   
    }
    public function edit($id){
        $brands = DB::table('brands')->select('name_en', 'name_ar', 'id')->get(); //collection array of object
        $subcategories = DB::table('subcategories')->select('name_en', 'name_ar', 'id')->get();
        $product = DB::table('products')->where('id','=',$id)->first(); //object
        return view('products.edit', compact('brands','subcategories', 'product'));
    }
    public function update(UpdateProductRequest $request){
        //validation $id
        $data =$request->except('_token','index','return','photo','_method');
        if($request->has('photo')){
            $data = $this->uploadPhoto($request, $data , 'products\\');
        }
        DB::table('products')->where('id',$request->id)->update($data);
        return $this->redirectAcoordingRequest($request); 
    }
    public function destroy($id){
        //validation $id digit
        // return $id;
        $product = DB::table('products')->where('id',$id)->first(); // if product exist in db or not
        if($product){
            DB::table('products')->where('id',$id)->delete();
            $photoPath= public_path('images\products\\'.$product->photo);
            if(file_exists($photoPath)){
                unlink($photoPath);
            }
        }else{
            abort(404, 'Product Not Found');
        }
        return redirect()->back()->with('success','Product successfully deleted');

    }


    
    public function redirectAcoordingRequest($request){
        if($request->has('index')){
            return redirect()->route('dashboard.products.index')->with('success','Operation Successfully');
        }else{
            return redirect()->back()->with('success','Operation Successfully'); //flash message
        }
    }
}
