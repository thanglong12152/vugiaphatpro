<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductType;
use App\ProductType_Child;
use App\featureProduct;
use DB;

class ProductTypeController extends Controller
{
    public function all(){
        $productType = DB::table('tb_loai_san_pham')->join('tb_sub_categories','tb_loai_san_pham.id_loai_san_pham', '=','tb_sub_categories.id_loai_san_pham')->get();
        $productTypes = ProductType::all();
        $productType = json_decode(json_encode($productType));

        return view('admin/productType/all')->with(compact('productType','productTypes'));
    }

    public function add(Request $request){
        $productType_Child = ProductType_Child::all();
        $product = ProductType::all();
        
        if ($request->isMethod('post')) {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
             $productType = new ProductType_Child;
             $productType->id_loai_san_pham = $data['productType_s'];
             $productType->ten_loai_sp_con = $data['ten_loai_san_pham'];
             $productType->save();
             return redirect('admin/productType/all')->with('flash_message_success','Thêm loại sản phẩm thành công');
        }
        return view('admin/productType/add')->with(compact('productType_Child','product'));
    }

    public function edit(Request $request, $id=null){
        $productTypes= ProductType::all();
        
        if ($request->isMethod('post')) {
            $data = $request->all();
            //echo "<pre>"; print_r($id); die();
            $dt= array(
                'tb_sub_categories.id_loai_san_pham'=> $data['loai_sp'],
                'ten_loai_sp_con' =>$data['productType_Child']
            );
            
            DB::table('tb_loai_san_pham')
        ->join('tb_sub_categories',function($join){
            $join->on('tb_loai_san_pham.id_loai_san_pham', '=','tb_sub_categories.id_loai_san_pham');
        })->where(['id'=>$id])->update($dt);
            return redirect('admin/productType/all')->with('flash_message_success','Sửa loại sản phẩm thành công');
        }
        $productType = DB::table('tb_loai_san_pham')
        ->join('tb_sub_categories',function($join){
            $join->on('tb_loai_san_pham.id_loai_san_pham', '=','tb_sub_categories.id_loai_san_pham');
        })
        ->where(['id'=>$id])->first();
        return view('admin/productType/edit')->with(compact('productType','productTypes'));
    }

    public function delete($id=null){
        if (!empty($id)) {
            ProductType::where(['id_loai_san_pham'=>$id])->delete();
            return redirect()->back()->with('flash_message_success','Xóa thành công');
        }
    }

    // public function filter(Request $request){
    //     if ($request->ajax()) {
    //         $data = DB::table('tb_loai_san_pham')
    //                 ->join('tb_sub_categories',function($join){
    //                     $join->on('tb_loai_san_pham.id_loai_san_pham', '=','tb_sub_categories.id_loai_san_pham');
    //                 })
    //                 ->where('tb_loai_san_pham.id_loai_san_pham','=',$request->productType_s)->get();
    //         //echo "<pre>"; print_r($data); die;
    //         //   if ($data) {
    //             $output = "<select name='productType_Child' id='productType_Child' class='form-control'>";
    //             foreach($data as $key ){
    //                 $output .= "<option value='$key->id'>".$key->ten_loai_sp_con."</option>";
    //               }
    //             $output .= "</select>";
    //          }                return response($output);

            
    //     // }
    // }
}
