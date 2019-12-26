<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use DB;
class IndexController extends Controller
{
    public function index(){
        $product_Bath = DB::table('tb_san_pham')->join('tb_loai_san_pham','tb_san_pham.id_loai_san_pham', '=','tb_loai_san_pham.id_loai_san_pham')
        ->where(['tb_loai_san_pham.loai_san_pham'=>'Bồn tắm'])->limit(5)->get();
        $product_sauna =DB::table('tb_san_pham')->join('tb_loai_san_pham','tb_san_pham.id_loai_san_pham', '=','tb_loai_san_pham.id_loai_san_pham')
        ->where(['tb_loai_san_pham.loai_san_pham'=>'Phòng xông hơi'])->limit(5)->get();
        $product_steam =DB::table('tb_san_pham')->join('tb_loai_san_pham','tb_san_pham.id_loai_san_pham', '=','tb_loai_san_pham.id_loai_san_pham')
        ->where(['tb_loai_san_pham.loai_san_pham'=>'Máy xông hơi'])->limit(5)->get();
        $product_tbvs=DB::table('tb_san_pham')->join('tb_loai_san_pham','tb_san_pham.id_loai_san_pham', '=','tb_loai_san_pham.id_loai_san_pham')
        ->where(['tb_loai_san_pham.loai_san_pham'=>'Thiết bị vệ sinh'])->limit(5)->get();
        return view('frontend/index')->with(compact('product_Bath','product_steam','product_sauna','product_tbvs'));
    }
    public function redirect(Request $request,$namespace=null){
        switch($namespace){
            
            case 'bon-tam':
                $product = DB::table('tb_san_pham')->join('tb_loai_san_pham','tb_san_pham.id_loai_san_pham', '=','tb_loai_san_pham.id_loai_san_pham')
                ->where(['tb_loai_san_pham.loai_san_pham'=>'Bồn tắm'])->paginate(1);
                return view('frontend/bath')->with(compact('product'));
                break;
            case 'phong-xong-hoi':
                $product = DB::table('tb_san_pham')->join('tb_loai_san_pham','tb_san_pham.id_loai_san_pham', '=','tb_loai_san_pham.id_loai_san_pham')
                ->where(['tb_loai_san_pham.loai_san_pham'=>'Phòng xông hơi'])->paginate(1);
                
                return view('frontend/sauna')->with(compact('product'));
                break;
            case 'may-xong-hoi':
                $product = DB::table('tb_san_pham')->join('tb_loai_san_pham','tb_san_pham.id_loai_san_pham', '=','tb_loai_san_pham.id_loai_san_pham')
                ->where(['tb_loai_san_pham.loai_san_pham'=>'Máy xông hơi'])->paginate(1);
                
                return view('frontend/steam_machine')->with(compact('product'));
                break;  
            case 'quat-den-tran':
                $product = DB::table('tb_san_pham')->join('tb_loai_san_pham','tb_san_pham.id_loai_san_pham', '=','tb_loai_san_pham.id_loai_san_pham')
                ->where(['tb_loai_san_pham.loai_san_pham'=>'Quạt đèn trần'])->paginate(1);
                
                return view('frontend/ceiling_fan')->with(compact('product'));
                break; 
            case 'chi-tiet-san-pham':
                return view('frontend/product_detail');
                break;  
            case 'tin-tuc':
                return view('frontend/news');
                break;     
            case 'du-an':
                return view('frontend/project');
                break;    
           
        }
    }

    public function detailProduct(Request $request, $slug= null){
        $data = DB::table('tb_san_pham')->where(['slug'=>$slug])
        ->join('tb_thuong_hieu',function($join){
            $join->on('tb_san_pham.id_thuong_hieu', '=','tb_thuong_hieu.id');
        })
        ->first();

        return view('frontend/product_detail')->with(compact('data'));
    }

    public function search(request $request){
        if ($request->ajax()) {
            $name = $request->name_prod;
            if(empty($name)){
                $output = '<div class="autocomplete-suggestions" style="position: absolute; max-height: 300px; z-index: 9999; top: 54px; left: 571.5px; width: 550px; display: none;"><div class="autocomplete-group">Không có dữ liệu</div></div>';
            }else{
                $data = DB::table('tb_san_pham')
            ->join('tb_loai_san_pham',function($join){
                $join->on('tb_san_pham.id_loai_san_pham', '=','tb_loai_san_pham.id_loai_san_pham');
            })
            ->where('tb_san_pham.ten_sp','like','%'.$name.'%')->get();

            if($data->isEmpty()){
                $output = '<div class="autocomplete-suggestions" style="position: absolute; max-height: 300px; z-index: 9999; top: 54px; left: 571.5px; width: 550px; display: block;"><div class="autocomplete-group">Không có dữ liệu</div></div>';
            }
            else{
                $output = '<div class="autocomplete-suggestions" style="position: absolute; max-height: 300px; z-index: 9999; top: 54px; left: 571.5px; width: 550px; display: block;">';
                foreach($data as $key){
                    $output .= '<div class="autocomplete-group">'.$key->loai_san_pham.'</div>
                        <div class="autocomplete-suggestion" data-index="0"> 
                        <a href="/chi-tiet-san-pham/'.$key->slug.'"> 
                        <img src="/image/product/small/'.$key->anh_sp.'"> 
                        <label> 
                        <span>'.$key->ten_sp.'</span> 
                        <span class="price">'.number_format($key->sale_price,0,".",".").'₫</span>
                        </label>
                        </a>
                        </div>';
                }
                //echo "<pre>"; print_r($data);die;
                $output .= "</div>";
            }
            }
            
        }
        return response($output);
    }
}
