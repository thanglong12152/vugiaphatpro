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
            case 'tin-tuc':
                return view('frontend/news');
                break;     
            case 'du-an':
                return view('frontend/project');
                break; 
            case 'chi-tiet-san-pham':
                return view('frontend/product_detail');
                break;  
        }
    }

    public function search(Request $request){
        if($request->ajax()){
            $data=DB::table('tb_san_pham')->where('tb_san_pham.ten_sp','like','%'.$request->keyword.'%')->get();
            echo '<pre>';
            print_r($data);die;

            if($data){
                foreach($data as $key){
                    echo '<div class="autocomplete-group">'.$key->.'</div>
                    <div class="autocomplete-suggestion" data-index="0">
                        <a href="https://vugiaphat.vn/bon-cau-1-khoi/bon-cau-mot-khoi-inak-in-301-p1561.html"> <img src="https://vugiaphat.vn/images/products/2019/07/10/resized/inak-in301_1562722042.jpg">
                            <label> <span> <strong>Bồn</strong> cầu một khối Inak IN 301  </span> <span class="price"> 2.579.500₫</span>
                            </label>
                        </a>
                    </div>';
                }
            }
        }
    }
}
