<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\featureProduct;
use App\productType;
use DB;
class featureProductController extends Controller
{
    public function all(){
        $featureProduct = DB::table('tb_tinh_nang')
        ->join('tb_loai_san_pham','tb_tinh_nang.id_loai_sp','=','tb_loai_san_pham.id_loai_san_pham')->get();
        return view('admin/featureProduct/all')->with(compact('featureProduct'));
    }
    public function add(Request $request){
        $productType = productType::all();
        // $table = featureProduct::all();
        if($request->isMethod('post')){
            $data = $request->all();

            $table = new featureProduct;
            $table->id_loai_sp = $data['productType_s'];
            $table->ten_tinh_nang = $data['tinh_nang'];

            $table->save();
            
            return redirect('admin/feature/all')->with('flash_message_success','Thêm tính năng thành công');
        }

        return view('admin/featureProduct/add')->with(compact('productType'));
    }
    public function edit(Request $request, $id=null){
        $productTypes= ProductType::all();
        
        if ($request->isMethod('post')) {
            $data = $request->all();
            echo "<pre>"; print_r($id); die();
            $dt= array(
                'loai_san_pham'=> $data['loai_san_pham'],
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
       
        return view('admin/featureProduct/edit');
    }
}   
