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
        return view('frontend/index')->with(compact('product_Bath','product_sauna'));
    }
    public function redirect(Request $request,$namespace=null){
        switch($namespace){
            
            case 'bon-tam':
                return view('frontend/bath');
                break;
            case 'phong-xong-hoi':
                return view('frontend/sauna');
                break;
            case 'may-xong-hoi':
                return view('frontend/steam_machine');
                break;  
            case 'quat-den-tran':
                return view('frontend/ceiling_fan');
                break; 
            case 'tin-tuc':
                return view('frontend/news');
                break;     
            case 'du-an':
                return view('frontend/project');
                break; 
            case 'chi-tiet-san-pham':
                return view('fontend/product_detail');
                break;  
        }
    }
}
