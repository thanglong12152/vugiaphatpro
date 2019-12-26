<?php

namespace App\Http\Controllers\BackEnd;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Input;
use Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\ProductType;
use App\TradeMark;
use DB;
class ProductController extends Controller
{
    public function all(){
        $data = DB::table('tb_san_pham')
        ->join('tb_loai_san_pham','tb_san_pham.id_loai_san_pham', '=','tb_loai_san_pham.id_loai_san_pham')
        ->join('tb_thuong_hieu','tb_san_pham.id_thuong_hieu','=','tb_thuong_hieu.id')
        ->join('tb_sub_categories','tb_san_pham.id_loai_sp_con','=','tb_sub_categories.id')
        ->get();
  
        $product = json_decode(json_encode($data));
        
        //echo "<pre>"; print_r($data); die;
        return view('admin/product/all')->with(compact('product'));
    }

    public function add(Request $request){
        $trademarkAll = TradeMark::all();
        $productType = ProductType::all();
        if ($request->isMethod('post')) {
            
            $data = $request->all();
            //echo "<pre>"; print_r($data);
            //die;
            $product = new Product;
            $product->ten_sp = $data['name_prod'];
            $product->id_loai_san_pham = $data['productType'];
            $product->ma_sp = $data['ma_sp'];
            $product->gia_goc = $data['gia_sp'];
            $product->id_loai_sp_con = $data['productType_Child'];
            $product->id_thuong_hieu = $data['thuong_hieu'];
            $product->sale_price = $data['sale_price'];
            $product->kich_thuoc_sp= $data['kich_thuoc'];
            $product->chat_lieu = $data['chat_lieu'];
            $product->xuat_xu = $data['xuat_xu'];
            $product->thiet_ke = $data['thiet_ke'];
            $product->thoi_gian_bh = $data['thoi_gian_bh'];
            $product->chuc_nang = $data['chuc_nang'];
            $product->max_people = $data['max_people'];
            $product->cong_suat_may = $data['cong_suat_may'];
            // $product->chung_loai = $data['chung_loai'];
            $product->dien_nang = $data['dien_nang'];
            $product->ong_cap_nuoc = $data['ong_cap_nuoc'];
            $product->day_dien = $data['day_dien'];
            $product->kieu_dang = $data['kieu_dang'];
            $product->loai_den = $data['loai_den'];
            $product->mau_sac = $data['mau_sac'];
            $product->sai_canh = $data['sai_canh'];
            $product->dong_co = $data['dong_co'];
            $product->cong_suat_den = $data['cong_suat_den'];
            $product->slug = Str::slug($data['name_prod'],'-');
            if($data['phu_kien_di_kem'] === ''){
                $product->phu_kien_di_kem = '';
            }else{
                $product->phu_kien_di_kem = $data['phu_kien_di_kem'];
            }
            //Upload image
            if ($request->hasFile('anh_sp')) {
                $image_tmp = $request->file('anh_sp');
                if ($image_tmp->isValid()) {
                    //echo 'test'; die;
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $large_image_path = 'image/product/large/'.$filename;
                    $medium_image_path = 'image/product/medium/'.$filename;
                    $small_image_path = 'image/product/small/'.$filename;
                    //Resize image
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300,300)->save($small_image_path);

                    $product->anh_sp=$filename;
                }
            }
            
            $product->save();
            return redirect('admin/product/all')->with('flash_message_success','Thêm sản phẩm thành công');
        }
        return view('admin/product/add',compact('productType','trademarkAll'));
    }

    public function edit(Request $request, $id=null){
        $productType = ProductType::all();
        $trademarkAll = TradeMark::all();
        if ($request->isMethod('post')) {
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            //Upload image
            if ($request->hasFile('anh_sp')) {
                $image_tmp = $request->file('anh_sp');
                if ($image_tmp->isValid()) {
                    //echo 'test'; die;
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $large_image_path = 'image/product/large/'.$filename;
                    $medium_image_path = 'image/product/medium/'.$filename;
                    $small_image_path = 'image/product/small/'.$filename;
                    //Resize image
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300,300)->save($small_image_path);
                }
            }else{
                $filename = $data['current_image'];
                //echo "<pre>"; print_r($filename); die()
            }
            $dt = array(
                'ten_sp' => $data['name_prod'],
                'id_loai_san_pham' => $data['loai_sp'],
                'ma_sp' => $data['ma_sp'],
                'id_thuong_hieu' => $data['thuong_hieu'],
                'anh_sp' => $filename
            );
            Product::where(['id_san_pham'=>$id])->update($dt);
            return redirect()->back()->with('flash_message_success','Sửa sản phẩm thành công');
        }

        //$productDetails = Product::where(['id_san_pham'=>$id])->first();
        $trademark = DB::table('tb_san_pham')->join('tb_thuong_hieu','tb_san_pham.id_thuong_hieu', '=','tb_thuong_hieu.id')->where(['id_san_pham'=>$id])->first();
        $productDetails = DB::table('tb_san_pham')->join('tb_loai_san_pham','tb_san_pham.id_loai_san_pham', '=','tb_loai_san_pham.id_loai_san_pham')->where(['id_san_pham'=>$id])->first();
        //echo "<pre>"; print_r($data);
        return view('admin/product/edit')->with(compact('productDetails','productType','trademark','trademarkAll'));
    }

    public function delete($id=null){
        if (!empty($id)) {
            Product::where(['id_san_pham'=>$id])->delete();
            return redirect()->back()->with('flash_message_success','Xóa thành công');
        }
    }

    public function filter(Request $request){
        if ($request->ajax()) {
            $data = DB::table('tb_loai_san_pham')
                    ->join('tb_sub_categories',function($join){
                        $join->on('tb_loai_san_pham.id_loai_san_pham', '=','tb_sub_categories.id_loai_san_pham');
                    })
                    ->where('tb_loai_san_pham.id_loai_san_pham','=',$request->productType_s)->get();
            //echo "<pre>"; print_r($data); die;
            //   if ($data) {
                $output = "<select name='productType_Child' id='productType_Child' class='form-control'>";
                foreach($data as $key ){
                    $output .= "<option value='$key->id'>".$key->ten_loai_sp_con."</option>";
                  }
                $output .= "</select>";
             }               
              return response($output);
        // }
    }
    
}
