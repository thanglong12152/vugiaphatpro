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
                return view('fontend/product_detail');
                break;  
        }
    }
}
