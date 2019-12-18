<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProductType;

class ProductTypeController extends Controller
{
    public function all(){
        $productType = ProductType::all();

        $productType = json_decode(json_encode($productType));

        return view('admin/productType/all')->with(compact('productType'));
    }

    public function add(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
             $productType = new ProductType;
             $productType->loai_san_pham = $data['loai_san_pham'];
             $productType->save();
             return redirect('admin/productType/all')->with('flash_message_success','Thêm loại sản phẩm thành công');
        }
        return view('admin/productType/add');
    }

    public function edit(Request $request, $id=null){
        //$productType = ProductType::all();
        if ($request->isMethod('post')) {
            $data = $request->all();
            $dt= array(
                'loai_san_pham'=> $data['loai_san_pham']
            );
            ProductType::where(['id_loai_san_pham'=>$id])->update($dt);
            return redirect('admin/productType/all')->with('flash_message_success','Sửa loại sản phẩm thành công');
        }
        $productType = ProductType::where(['id_loai_san_pham'=>$id])->first();
        return view('admin/productType/edit')->with(compact('productType'));
    }

    public function delete($id=null){
        if (!empty($id)) {
            ProductType::where(['id_loai_san_pham'=>$id])->delete();
            return redirect()->back()->with('flash_message_success','Xóa thành công');
        }
    }
}
