<?php

namespace App\Http\Controllers\BackEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\TradeMark;

class TradeMarkController extends Controller
{
    public function all(){
        $trademark = TradeMark::all();

        $trademark = json_decode(json_encode($trademark));

        return view('admin/trademark/all')->with(compact('trademark'));
    }

    public function add(Request $request){
        if ($request->isMethod('post')) {
            $trademark = new TradeMark;

            $data = $request->all();

            $trademark->id=$data['id'];
            $trademark->ten_thuong_hieu=$data['ten_thuong_hieu'];
            $trademark->save();
            return redirect('admin/trademark/all')->with('flash_message_success','Thêm thương hiệu thành công');
        }
        return view('admin/trademark/add');
    }

    public function edit(Request $request, $id=null){
        //$data = ProductType::all();

        if ($request->isMethod('post')) {
            $data = $request->all();

            //$trademark = new TradeMark;

            $dt = array(
                'ten_thuong_hieu'=>$data['ten_thuong_hieu']
            );
            TradeMark::where(['id'=>$id])->update($dt);
            return redirect('admin/trademark/all')->with('flash_message_success','Sửa thương hiệu thành công');
        }
        $trademark = TradeMark::where(['id'=>$id])->first();
        return view('admin/trademark/edit')->with(compact('trademark'));
    }

    public function delete($id=null){
        if (!empty($id)) {
            TradeMark::where(['id'=>$id])->delete();
            return redirect()->back()->with('flash_message_success','Xóa thành công');
        }

    }
}
