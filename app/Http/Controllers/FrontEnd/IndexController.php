<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\CartModel;
use App\Models\CustomerModel;
use Illuminate\Http\Request;
use App\Product;
use DB;
use Session;
use Carbon\Carbon;


class IndexController extends Controller
{
    public function index()
    {
        $product_Bath = DB::table('tb_san_pham')
            ->selectRaw('
            anh_sp,
            ten_sp,
            sale_price,
            gia_goc,
            xuat_xu,
            kich_thuoc_sp,
            tb_loai_san_pham.slug as loaiSp,
            tb_san_pham.slug as slugSp
        ')
            ->join('tb_loai_san_pham', 'tb_san_pham.id_loai_san_pham', '=', 'tb_loai_san_pham.id_loai_san_pham')
            ->join('tb_xuat_xu', 'tb_san_pham.id_xuat_xu', '=', 'tb_xuat_xu.id_xuat_xu')
            ->where(['tb_loai_san_pham.loai_san_pham' => 'Bồn tắm'])->limit(5)->get();
        $product_sauna = DB::table('tb_san_pham')
            ->join('tb_loai_san_pham', 'tb_san_pham.id_loai_san_pham', '=', 'tb_loai_san_pham.id_loai_san_pham')
            ->join('tb_xuat_xu', 'tb_san_pham.id_xuat_xu', '=', 'tb_xuat_xu.id_xuat_xu')
            ->where(['tb_loai_san_pham.loai_san_pham' => 'Phòng xông hơi'])->limit(5)->get();
        $product_steam = DB::table('tb_san_pham')
            ->join('tb_loai_san_pham', 'tb_san_pham.id_loai_san_pham', '=', 'tb_loai_san_pham.id_loai_san_pham')
            ->join('tb_xuat_xu', 'tb_san_pham.id_xuat_xu', '=', 'tb_xuat_xu.id_xuat_xu')
            ->where(['tb_loai_san_pham.loai_san_pham' => 'Máy xông hơi'])->limit(5)->get();
        $product_tbvs = DB::table('tb_san_pham')
            ->join('tb_loai_san_pham', 'tb_san_pham.id_loai_san_pham', '=', 'tb_loai_san_pham.id_loai_san_pham')
            ->join('tb_xuat_xu', 'tb_san_pham.id_xuat_xu', '=', 'tb_xuat_xu.id_xuat_xu')
            ->where(['tb_loai_san_pham.loai_san_pham' => 'Thiết bị vệ sinh'])->limit(5)->get();
        return view('frontend/index')->with(compact('product_Bath', 'product_steam', 'product_sauna', 'product_tbvs'));
    }
    public function redirect(Request $request, $namespace = null, $string = null)
    {
        $feature_array = array();
        $feature = $request->feature;
        $datasp = explode(',', $feature);
        $data_thuonghieu = DB::table('tb_thuong_hieu')->select('slug')->get();
        $data_tinhnang = DB::table('tb_tinh_nang')->select('slug')->get();
        $data_mucgia = DB::table('tb_muc_gia')->select('slug')->get();
        $data_xuatxu = DB::table('tb_xuat_xu')->select('slug')->get();
        //print_r($datasp);
        //print_r($data_tinhnang);

        $res = array();
        $res_tinhnang = array();
        $res_mucgia = array();
        $res_xuatxu = array();

        $thuong_hieu = DB::table('tb_thuong_hieu')->get();
        $muc_gia = DB::table('tb_muc_gia')->get();
        $xuat_xu = DB::table('tb_xuat_xu')->get();
        $kich_thuoc = DB::table('tb_kich_thuoc')->get();

        /*=========================================================LOC THUONG HIEU=======================================*/
        for ($i = 0; $i < count($datasp); $i++) {
            foreach ($data_thuonghieu as $data) {
                if ($data->slug === $datasp[$i]) {
                    array_push($res, $datasp[$i]);
                }
            }
        }
        $res = implode(',', $res);
        /*=========================================================LOC TINH NANG=======================================*/

        for ($i = 0; $i < count($datasp); $i++) {
            foreach ($data_tinhnang as $data) {
                if ($data->slug === $datasp[$i]) {
                    array_push($res_tinhnang, $datasp[$i]);
                }
            }
        }
        $res_tinhnang = implode(',', $res_tinhnang);
        /*=========================================================LOC GIA=======================================*/
        for ($i = 0; $i < count($datasp); $i++) {
            foreach ($data_mucgia as $data) {
                if ($data->slug === $datasp[$i]) {
                    array_push($res_mucgia, $datasp[$i]);
                }
            }
        }

        $res_mucgia = implode('-', $res_mucgia);

        //print_r(explode('-',$res_mucgia));
        $price = array();
        $number_mucgia = explode('-', $res_mucgia);

        for ($i = 0; $i < count($number_mucgia); $i++) {
            if (is_numeric($number_mucgia[$i])) {
                $hundred = $number_mucgia[$i] * 1000000;
                array_push($price, $hundred);
                //print_r($number_mucgia[$i]);
            }
        }

        //print_r(array_pop($price));

        /*=========================================================LOC THUONG HIEU=======================================*/
        for ($i = 0; $i < count($datasp); $i++) {
            foreach ($data_xuatxu as $data) {
                if ($data->slug === $datasp[$i]) {
                    array_push($res_xuatxu, $datasp[$i]);
                }
            }
            //print_r($datasp[$i]);
        }
        $res_xuatxu = implode(',', $res_xuatxu);

        switch ($namespace) {

            case 'bon-tam':
                $slug = "Bồn tắm";
                if (request()->has('feature')) {
                    $tinh_nang = DB::table('tb_tinh_nang')
                        ->join('tb_loai_san_pham', function ($join) {
                            $join->on('tb_tinh_nang.id_loai_sp', '=', 'tb_loai_san_pham.id_loai_san_pham');
                        })->where(['tb_loai_san_pham.loai_san_pham' => 'Bồn tắm'])->get();

                    //print_r($res_tinhnang);


                    if (empty($res_mucgia)) {
                        $product = DB::table('tb_san_pham')
                            ->join('tb_tinhnang_sanpham', function ($join) {
                                $join->on('tb_san_pham.id_san_pham', '=', 'tb_tinhnang_sanpham.id_san_pham');
                            })
                            ->join('tb_loai_san_pham', 'tb_san_pham.id_loai_san_pham', '=', 'tb_loai_san_pham.id_loai_san_pham')
                            ->join('tb_xuat_xu', 'tb_san_pham.id_xuat_xu', '=', 'tb_xuat_xu.id_xuat_xu')
                            ->join('tb_thuong_hieu', 'tb_san_pham.id_thuong_hieu', '=', 'tb_thuong_hieu.id')
                            ->where([
                                ['loai_san_pham', 'like', '%' . $slug . '%'],
                                ['tinh_nang', 'like', '%' . $res_tinhnang . '%'],
                                ['tb_thuong_hieu.slug', 'like', '%' . $res . '%'],
                                ['tb_xuat_xu.slug', 'like', '%' . $res_xuatxu . '%']

                            ])
                            ->paginate(5)
                            ->appends('feature', request('feature'));
                    } else {
                        if (count($price) <= 1) {
                            $product = DB::table('tb_san_pham')
                                ->join('tb_tinhnang_sanpham', function ($join) {
                                    $join->on('tb_san_pham.id_san_pham', '=', 'tb_tinhnang_sanpham.id_san_pham');
                                })
                                ->join('tb_xuat_xu', 'tb_san_pham.id_xuat_xu', '=', 'tb_xuat_xu.id_xuat_xu')
                                ->join('tb_thuong_hieu', 'tb_san_pham.id_thuong_hieu', '=', 'tb_thuong_hieu.id')
                                ->where([
                                    ['tinh_nang', 'like', '%' . $res_tinhnang . '%'],
                                    ['tb_thuong_hieu.slug', 'like', '%' . $res . '%'],
                                    ['tb_xuat_xu.slug', 'like', '%' . $res_xuatxu . '%'],

                                ])
                                ->whereBetween('tb_san_pham.sale_price', array(0, max($price)))
                                ->paginate(5)
                                ->appends('feature', request('feature'));
                        } else {
                            $product = DB::table('tb_san_pham')
                                ->join('tb_tinhnang_sanpham', function ($join) {
                                    $join->on('tb_san_pham.id_san_pham', '=', 'tb_tinhnang_sanpham.id_san_pham');
                                })
                                ->join('tb_xuat_xu', 'tb_san_pham.id_xuat_xu', '=', 'tb_xuat_xu.id_xuat_xu')
                                ->join('tb_thuong_hieu', 'tb_san_pham.id_thuong_hieu', '=', 'tb_thuong_hieu.id')
                                ->where([
                                    ['tinh_nang', 'like', '%' . $res_tinhnang . '%'],
                                    ['tb_thuong_hieu.slug', 'like', '%' . $res . '%'],
                                    ['tb_xuat_xu.slug', 'like', '%' . $res_xuatxu . '%'],

                                ])
                                ->whereBetween('tb_san_pham.sale_price', array(min($price), max($price)))
                                ->paginate(5)
                                ->appends('feature', request('feature'));
                        }
                    }
                    return view('frontend/bath')->with(compact('product', 'tinh_nang', 'thuong_hieu', 'muc_gia', 'xuat_xu', 'kich_thuoc', 'namespace', 'slug', 'feature', 'datasp'));
                } else {
                    $product = DB::table('tb_san_pham')
                        ->join('tb_loai_san_pham', 'tb_san_pham.id_loai_san_pham', '=', 'tb_loai_san_pham.id_loai_san_pham')
                        ->join('tb_xuat_xu', 'tb_san_pham.id_xuat_xu', '=', 'tb_xuat_xu.id_xuat_xu')
                        ->where(['tb_loai_san_pham.loai_san_pham' => 'Bồn tắm'])->paginate(5);


                    $tinh_nang = DB::table('tb_tinh_nang')
                        ->join('tb_loai_san_pham', function ($join) {
                            $join->on('tb_tinh_nang.id_loai_sp', '=', 'tb_loai_san_pham.id_loai_san_pham');
                        })->where(['tb_loai_san_pham.loai_san_pham' => 'Bồn tắm'])->get();

                    $thuong_hieu = DB::table('tb_thuong_hieu')->get();
                    $muc_gia = DB::table('tb_muc_gia')->get();
                    $xuat_xu = DB::table('tb_xuat_xu')->get();
                    $kich_thuoc = DB::table('tb_kich_thuoc')->get();
                    return view('frontend/bath')->with(compact('product', 'tinh_nang', 'thuong_hieu', 'muc_gia', 'xuat_xu', 'kich_thuoc', 'namespace', 'slug'));
                }

                break;


            case 'phong-xong-hoi':
                $slug = "Phòng xông hơi";
                if (request()->has('feature')) {
                    $tinh_nang = DB::table('tb_tinh_nang')
                        ->join('tb_loai_san_pham', function ($join) {
                            $join->on('tb_tinh_nang.id_loai_sp', '=', 'tb_loai_san_pham.id_loai_san_pham');
                        })->where(['tb_loai_san_pham.loai_san_pham' => 'Bồn tắm'])->get();

                    //print_r($res_tinhnang);


                    if (empty($res_mucgia)) {
                        $product = DB::table('tb_san_pham')
                            ->join('tb_tinhnang_sanpham', function ($join) {
                                $join->on('tb_san_pham.id_san_pham', '=', 'tb_tinhnang_sanpham.id_san_pham');
                            })
                            ->join('tb_loai_san_pham', 'tb_san_pham.id_loai_san_pham', '=', 'tb_loai_san_pham.id_loai_san_pham')
                            ->join('tb_xuat_xu', 'tb_san_pham.id_xuat_xu', '=', 'tb_xuat_xu.id_xuat_xu')
                            ->join('tb_thuong_hieu', 'tb_san_pham.id_thuong_hieu', '=', 'tb_thuong_hieu.id')
                            ->where([
                                ['loai_san_pham', 'like', '%' . $slug . '%'],
                                ['tinh_nang', 'like', '%' . $res_tinhnang . '%'],
                                ['tb_thuong_hieu.slug', 'like', '%' . $res . '%'],
                                ['tb_xuat_xu.slug', 'like', '%' . $res_xuatxu . '%']

                            ])
                            ->paginate(5)
                            ->appends('feature', request('feature'));
                    } else {
                        if (count($price) <= 1) {
                            $product = DB::table('tb_san_pham')
                                ->join('tb_tinhnang_sanpham', function ($join) {
                                    $join->on('tb_san_pham.id_san_pham', '=', 'tb_tinhnang_sanpham.id_san_pham');
                                })
                                ->join('tb_loai_san_pham', 'tb_san_pham.id_loai_san_pham', '=', 'tb_loai_san_pham.id_loai_san_pham')
                                ->join('tb_xuat_xu', 'tb_san_pham.id_xuat_xu', '=', 'tb_xuat_xu.id_xuat_xu')
                                ->join('tb_thuong_hieu', 'tb_san_pham.id_thuong_hieu', '=', 'tb_thuong_hieu.id')
                                ->where([
                                    ['loai_san_pham', 'like', '%' . $slug . '%'],
                                    ['tinh_nang', 'like', '%' . $res_tinhnang . '%'],
                                    ['tb_thuong_hieu.slug', 'like', '%' . $res . '%'],
                                    ['tb_xuat_xu.slug', 'like', '%' . $res_xuatxu . '%'],

                                ])
                                ->whereBetween('tb_san_pham.sale_price', array(0, max($price)))
                                ->paginate(5)
                                ->appends('feature', request('feature'));
                        } else {
                            $product = DB::table('tb_san_pham')
                                ->join('tb_tinhnang_sanpham', function ($join) {
                                    $join->on('tb_san_pham.id_san_pham', '=', 'tb_tinhnang_sanpham.id_san_pham');
                                })
                                ->join('tb_loai_san_pham', 'tb_san_pham.id_loai_san_pham', '=', 'tb_loai_san_pham.id_loai_san_pham')
                                ->join('tb_xuat_xu', 'tb_san_pham.id_xuat_xu', '=', 'tb_xuat_xu.id_xuat_xu')
                                ->join('tb_thuong_hieu', 'tb_san_pham.id_thuong_hieu', '=', 'tb_thuong_hieu.id')
                                ->where([
                                    ['loai_san_pham', 'like', '%' . $slug . '%'],
                                    ['tinh_nang', 'like', '%' . $res_tinhnang . '%'],
                                    ['tb_thuong_hieu.slug', 'like', '%' . $res . '%'],
                                    ['tb_xuat_xu.slug', 'like', '%' . $res_xuatxu . '%'],

                                ])
                                ->whereBetween('tb_san_pham.sale_price', array(min($price), max($price)))
                                ->paginate(5)
                                ->appends('feature', request('feature'));
                        }
                    }

                    return view('frontend/sauna')->with(compact('product', 'tinh_nang', 'thuong_hieu', 'muc_gia', 'xuat_xu', 'kich_thuoc', 'namespace', 'slug', 'feature', 'datasp'));
                } else {
                    $product = DB::table('tb_san_pham')
                        ->join('tb_loai_san_pham', 'tb_san_pham.id_loai_san_pham', '=', 'tb_loai_san_pham.id_loai_san_pham')
                        ->join('tb_xuat_xu', 'tb_san_pham.id_xuat_xu', '=', 'tb_xuat_xu.id_xuat_xu')
                        ->where(['tb_loai_san_pham.loai_san_pham' => $slug])->paginate(5);





                    $tinh_nang = DB::table('tb_tinh_nang')
                        ->join('tb_loai_san_pham', function ($join) {
                            $join->on('tb_tinh_nang.id_loai_sp', '=', 'tb_loai_san_pham.id_loai_san_pham');
                        })->where(['tb_loai_san_pham.loai_san_pham' => $slug])->get();

                    $thuong_hieu = DB::table('tb_thuong_hieu')->get();
                    $muc_gia = DB::table('tb_muc_gia')->get();
                    $xuat_xu = DB::table('tb_xuat_xu')->get();
                    $kich_thuoc = DB::table('tb_kich_thuoc')->get();
                    return view('frontend/sauna')->with(compact('product', 'tinh_nang', 'thuong_hieu', 'muc_gia', 'xuat_xu', 'kich_thuoc', 'namespace', 'slug'));
                }

                break;
            case 'may-xong-hoi':
                $slug = "Máy xông hơi";
                if (request()->has('feature')) {
                    $tinh_nang = DB::table('tb_tinh_nang')
                        ->join('tb_loai_san_pham', function ($join) {
                            $join->on('tb_tinh_nang.id_loai_sp', '=', 'tb_loai_san_pham.id_loai_san_pham');
                        })->where(['tb_loai_san_pham.loai_san_pham' => 'Bồn tắm'])->get();

                    //print_r($res_tinhnang);


                    if (empty($res_mucgia)) {
                        $product = DB::table('tb_san_pham')
                            ->join('tb_tinhnang_sanpham', function ($join) {
                                $join->on('tb_san_pham.id_san_pham', '=', 'tb_tinhnang_sanpham.id_san_pham');
                            })
                            ->join('tb_loai_san_pham', 'tb_san_pham.id_loai_san_pham', '=', 'tb_loai_san_pham.id_loai_san_pham')
                            ->join('tb_xuat_xu', 'tb_san_pham.id_xuat_xu', '=', 'tb_xuat_xu.id_xuat_xu')
                            ->join('tb_thuong_hieu', 'tb_san_pham.id_thuong_hieu', '=', 'tb_thuong_hieu.id')
                            ->where([
                                ['loai_san_pham', 'like', '%' . $slug . '%'],
                                ['tinh_nang', 'like', '%' . $res_tinhnang . '%'],
                                ['tb_thuong_hieu.slug', 'like', '%' . $res . '%'],
                                ['tb_xuat_xu.slug', 'like', '%' . $res_xuatxu . '%']

                            ])
                            ->paginate(5)
                            ->appends('feature', request('feature'));
                    } else {
                        if (count($price) <= 1) {
                            $product = DB::table('tb_san_pham')
                                ->join('tb_tinhnang_sanpham', function ($join) {
                                    $join->on('tb_san_pham.id_san_pham', '=', 'tb_tinhnang_sanpham.id_san_pham');
                                })
                                ->join('tb_loai_san_pham', 'tb_san_pham.id_loai_san_pham', '=', 'tb_loai_san_pham.id_loai_san_pham')
                                ->join('tb_xuat_xu', 'tb_san_pham.id_xuat_xu', '=', 'tb_xuat_xu.id_xuat_xu')
                                ->join('tb_thuong_hieu', 'tb_san_pham.id_thuong_hieu', '=', 'tb_thuong_hieu.id')
                                ->where([
                                    ['loai_san_pham', 'like', '%' . $slug . '%'],
                                    ['tinh_nang', 'like', '%' . $res_tinhnang . '%'],
                                    ['tb_thuong_hieu.slug', 'like', '%' . $res . '%'],
                                    ['tb_xuat_xu.slug', 'like', '%' . $res_xuatxu . '%'],

                                ])
                                ->whereBetween('tb_san_pham.sale_price', array(0, max($price)))
                                ->paginate(5)
                                ->appends('feature', request('feature'));
                        } else {
                            $product = DB::table('tb_san_pham')
                                ->join('tb_tinhnang_sanpham', function ($join) {
                                    $join->on('tb_san_pham.id_san_pham', '=', 'tb_tinhnang_sanpham.id_san_pham');
                                })
                                ->join('tb_loai_san_pham', 'tb_san_pham.id_loai_san_pham', '=', 'tb_loai_san_pham.id_loai_san_pham')
                                ->join('tb_xuat_xu', 'tb_san_pham.id_xuat_xu', '=', 'tb_xuat_xu.id_xuat_xu')
                                ->join('tb_thuong_hieu', 'tb_san_pham.id_thuong_hieu', '=', 'tb_thuong_hieu.id')
                                ->where([
                                    ['loai_san_pham', 'like', '%' . $slug . '%'],
                                    ['tinh_nang', 'like', '%' . $res_tinhnang . '%'],
                                    ['tb_thuong_hieu.slug', 'like', '%' . $res . '%'],
                                    ['tb_xuat_xu.slug', 'like', '%' . $res_xuatxu . '%'],

                                ])
                                ->whereBetween('tb_san_pham.sale_price', array(min($price), max($price)))
                                ->paginate(5)
                                ->appends('feature', request('feature'));
                        }
                    }

                    return view('frontend/steam_machine')->with(compact('product', 'tinh_nang', 'thuong_hieu', 'muc_gia', 'xuat_xu', 'kich_thuoc', 'namespace', 'slug', 'feature', 'datasp'));
                } else {
                    $product = DB::table('tb_san_pham')
                        ->join('tb_loai_san_pham', 'tb_san_pham.id_loai_san_pham', '=', 'tb_loai_san_pham.id_loai_san_pham')
                        ->join('tb_xuat_xu', 'tb_san_pham.id_xuat_xu', '=', 'tb_xuat_xu.id_xuat_xu')
                        ->where(['tb_loai_san_pham.loai_san_pham' => $slug])->paginate(5);





                    $tinh_nang = DB::table('tb_tinh_nang')
                        ->join('tb_loai_san_pham', function ($join) {
                            $join->on('tb_tinh_nang.id_loai_sp', '=', 'tb_loai_san_pham.id_loai_san_pham');
                        })->where(['tb_loai_san_pham.loai_san_pham' => $slug])->get();

                    $thuong_hieu = DB::table('tb_thuong_hieu')->get();
                    $muc_gia = DB::table('tb_muc_gia')->get();
                    $xuat_xu = DB::table('tb_xuat_xu')->get();
                    $kich_thuoc = DB::table('tb_kich_thuoc')->get();
                    return view('frontend/steam_machine')->with(compact('product', 'tinh_nang', 'thuong_hieu', 'muc_gia', 'xuat_xu', 'kich_thuoc', 'namespace', 'slug'));
                }
                break;
            case 'quat-den-tran':
                $slug = "Quạt đèn trần";
                if (request()->has('feature')) {
                    $tinh_nang = DB::table('tb_tinh_nang')
                        ->join('tb_loai_san_pham', function ($join) {
                            $join->on('tb_tinh_nang.id_loai_sp', '=', 'tb_loai_san_pham.id_loai_san_pham');
                        })->where(['tb_loai_san_pham.loai_san_pham' => 'Bồn tắm'])->get();

                    //print_r($res_tinhnang);


                    if (empty($res_mucgia)) {
                        $product = DB::table('tb_san_pham')
                            ->join('tb_tinhnang_sanpham', function ($join) {
                                $join->on('tb_san_pham.id_san_pham', '=', 'tb_tinhnang_sanpham.id_san_pham');
                            })
                            ->join('tb_loai_san_pham', 'tb_san_pham.id_loai_san_pham', '=', 'tb_loai_san_pham.id_loai_san_pham')
                            ->join('tb_xuat_xu', 'tb_san_pham.id_xuat_xu', '=', 'tb_xuat_xu.id_xuat_xu')
                            ->join('tb_thuong_hieu', 'tb_san_pham.id_thuong_hieu', '=', 'tb_thuong_hieu.id')
                            ->where([
                                ['loai_san_pham', 'like', '%' . $slug . '%'],
                                ['tinh_nang', 'like', '%' . $res_tinhnang . '%'],
                                ['tb_thuong_hieu.slug', 'like', '%' . $res . '%'],
                                ['tb_xuat_xu.slug', 'like', '%' . $res_xuatxu . '%']

                            ])
                            ->paginate(5)
                            ->appends('feature', request('feature'));
                    } else {
                        if (count($price) <= 1) {
                            $product = DB::table('tb_san_pham')
                                ->join('tb_tinhnang_sanpham', function ($join) {
                                    $join->on('tb_san_pham.id_san_pham', '=', 'tb_tinhnang_sanpham.id_san_pham');
                                })
                                ->join('tb_loai_san_pham', 'tb_san_pham.id_loai_san_pham', '=', 'tb_loai_san_pham.id_loai_san_pham')
                                ->join('tb_xuat_xu', 'tb_san_pham.id_xuat_xu', '=', 'tb_xuat_xu.id_xuat_xu')
                                ->join('tb_thuong_hieu', 'tb_san_pham.id_thuong_hieu', '=', 'tb_thuong_hieu.id')
                                ->where([
                                    ['loai_san_pham', 'like', '%' . $slug . '%'],
                                    ['tinh_nang', 'like', '%' . $res_tinhnang . '%'],
                                    ['tb_thuong_hieu.slug', 'like', '%' . $res . '%'],
                                    ['tb_xuat_xu.slug', 'like', '%' . $res_xuatxu . '%'],

                                ])
                                ->whereBetween('tb_san_pham.sale_price', array(0, max($price)))
                                ->paginate(5)
                                ->appends('feature', request('feature'));
                        } else {
                            $product = DB::table('tb_san_pham')
                                ->join('tb_tinhnang_sanpham', function ($join) {
                                    $join->on('tb_san_pham.id_san_pham', '=', 'tb_tinhnang_sanpham.id_san_pham');
                                })
                                ->join('tb_loai_san_pham', 'tb_san_pham.id_loai_san_pham', '=', 'tb_loai_san_pham.id_loai_san_pham')
                                ->join('tb_xuat_xu', 'tb_san_pham.id_xuat_xu', '=', 'tb_xuat_xu.id_xuat_xu')
                                ->join('tb_thuong_hieu', 'tb_san_pham.id_thuong_hieu', '=', 'tb_thuong_hieu.id')
                                ->where([
                                    ['loai_san_pham', 'like', '%' . $slug . '%'],
                                    ['tinh_nang', 'like', '%' . $res_tinhnang . '%'],
                                    ['tb_thuong_hieu.slug', 'like', '%' . $res . '%'],
                                    ['tb_xuat_xu.slug', 'like', '%' . $res_xuatxu . '%'],

                                ])
                                ->whereBetween('tb_san_pham.sale_price', array(min($price), max($price)))
                                ->paginate(5)
                                ->appends('feature', request('feature'));
                        }
                    }

                    return view('frontend/ceiling_fan')->with(compact('product', 'tinh_nang', 'thuong_hieu', 'muc_gia', 'xuat_xu', 'kich_thuoc', 'namespace', 'slug', 'feature', 'datasp'));
                } else {
                    $product = DB::table('tb_san_pham')
                        ->join('tb_loai_san_pham', 'tb_san_pham.id_loai_san_pham', '=', 'tb_loai_san_pham.id_loai_san_pham')
                        ->join('tb_xuat_xu', 'tb_san_pham.id_xuat_xu', '=', 'tb_xuat_xu.id_xuat_xu')
                        ->where(['tb_loai_san_pham.loai_san_pham' => $slug])->paginate(5);




                    $tinh_nang = DB::table('tb_tinh_nang')
                        ->join('tb_loai_san_pham', function ($join) {
                            $join->on('tb_tinh_nang.id_loai_sp', '=', 'tb_loai_san_pham.id_loai_san_pham');
                        })->where(['tb_loai_san_pham.loai_san_pham' => $slug])->get();

                    $thuong_hieu = DB::table('tb_thuong_hieu')->get();
                    $muc_gia = DB::table('tb_muc_gia')->get();
                    $xuat_xu = DB::table('tb_xuat_xu')->get();
                    $kich_thuoc = DB::table('tb_kich_thuoc')->get();
                    return view('frontend/ceiling_fan')->with(compact('product', 'tinh_nang', 'thuong_hieu', 'muc_gia', 'xuat_xu', 'kich_thuoc', 'namespace', 'slug'));
                }
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
    public function logout()
    {
        Session::flush();
        return redirect('/')->with('flash_message_logout', 'Logged out');
    }
    public function detailProduct(Request $request, $slug = null)
    {
        $data = DB::table('tb_san_pham')->where(['tb_san_pham.slug' => $slug])
            ->join('tb_thuong_hieu', function ($join) {
                $join->on('tb_san_pham.id_thuong_hieu', '=', 'tb_thuong_hieu.id');
            })
            ->join('tb_loai_san_pham', 'tb_san_pham.id_loai_san_pham', '=', 'tb_loai_san_pham.id_loai_san_pham')
            ->first();

        return view('frontend/product_detail')->with(compact('data'));
    }

    public function search(request $request)
    {
        $output = "";
        if ($request->ajax()) {
            $name = $request->name_prod;
            if (empty($name)) {
                $output = '<div class="autocomplete-suggestions" style="position: absolute; max-height: 300px; z-index: 9999; top: 54px; left: calc(31.6% - 100px); width: 550px; display: none;"><div class="autocomplete-group">Không có dữ liệu</div></div>';
            } else {
                $data = DB::table('tb_san_pham')
                    ->join('tb_loai_san_pham', function ($join) {
                        $join->on('tb_san_pham.id_loai_san_pham', '=', 'tb_loai_san_pham.id_loai_san_pham');
                    })
                    ->where('tb_san_pham.ten_sp', 'like', '%' . $name . '%')->get();

                if ($data->isEmpty()) {
                    $output = '<div class="autocomplete-suggestions" style="position: absolute; max-height: 300px; z-index: 9999; top: 54px; left: calc(31.6% - 100px); width: 550px; display: block;"><div class="autocomplete-group">Không có dữ liệu</div></div>';
                } else {
                    $output = '<div class="autocomplete-suggestions" style="position: absolute; max-height: 300px; z-index: 9999; top: 54px; left: calc(31.6% - 100px); width: 550px; display: block;">';
                    foreach ($data as $key) {
                        $output .= '<div class="autocomplete-group">' . $key->loai_san_pham . '</div>
                        <div class="autocomplete-suggestion" data-index="0"> 
                        <a href="/chi-tiet-san-pham/' . $key->slug . '"> 
                        <img src="/image/product/small/' . $key->anh_sp . '"> 
                        <label> 
                        <span>' . $key->ten_sp . '</span> 
                        <span class="price">' . number_format($key->sale_price, 0, ".", ".") . '₫</span>
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

    public function login()
    {
        return view('frontend/login');
    }
    public function register()
    {
        return view('frontend/register');
    }

    public function caculatePriceAjax(Request $request)
    {
        $price = $request->price;
        $sl = $request->sl;

        $prices = number_format($price * $sl, 0, ".", ".") . "đ";

        return response($prices);
    }

    public function orderCart(Request $request)
    {
        $data = new CartModel;
        $res = $data->addToCart($request);
        //dd($res['id_cart']);

        return redirect('show/cart/' . $res . '');
    }

    public function showCart($cartId = null)
    {
        $data = DB::table('tb_cart')
            ->select('id_cart as cartId', 'tb_cart.cart', 'tb_cart.id_user', 'ten_khach_hang', 'dia_chi', 'so_dt', 'tb_cart.created_at as ngayDatHang')
            ->join('tb_khach_hang', 'tb_cart.id_user', '=', 'tb_khach_hang.id_khach_hang')
            ->where([
                'tb_cart.id_cart' => $cartId
            ])
            ->first();
       
        if (!empty($data->cart)) {
            $cart = json_decode($data->cart, true);
            $totalCart = 0;
            foreach ($cart as $key => $value) {
                $totalCart += $value['so_luong'] * $value['price'];
            }

            if (!empty($cart)) {
                $cartId = $data->cartId;
                $tenKH = $data->ten_khach_hang;
                $diaChi = $data->dia_chi;
                $soDt = $data->so_dt;
                $ngayDatHang = $data->ngayDatHang;
                return view('frontend.cart')->with(compact('cart', 'totalCart', 'tenKH', 'diaChi', 'soDt', 'ngayDatHang', 'cartId'));
            } else {
                return view('404');
            }
        } else {
            return view('404');
        }
    }

    public function deleteProduct(Request $request)
    {
        $time = Carbon::now();
        $data = DB::table('tb_cart')
            ->select('id_cart as cartId', 'tb_cart.cart', 'tb_cart.id_user', 'ten_khach_hang', 'dia_chi', 'so_dt', 'tb_cart.created_at as ngayDatHang')
            ->join('tb_khach_hang', 'tb_cart.id_user', '=', 'tb_khach_hang.id_khach_hang')
            ->where([
                'tb_cart.id_cart' => $request->cartId
            ])
            ->first();
        $respon = json_decode($data->cart, true);
        unset($respon[$request->id]);

        $json = json_encode($respon);

        if(count($data->cart) > 1){
            $arrUpdate = CartModel::where([
                'id_cart' => $request->cartId
            ])->update([
                'cart' => $json,
                'updated_at' => $time
            ]);
        }else if(count($data->cart) == 1){
            $arrUpdate = CartModel::where([
                'id_cart' => $request->cartId
            ])->update([
                'cart' => "",
                'updated_at' => $time
            ]);
        }

        if ($arrUpdate) {
            return "Đã xóa";
        } else {
            return "Thất bại";
        }
    }
}
