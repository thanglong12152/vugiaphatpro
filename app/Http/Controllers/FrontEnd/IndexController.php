<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use App\Models\CartModel;
use App\Models\CustomerModel;
use Illuminate\Http\Request;
use App\Product;
use Aws\DynamoDb\Marshaler;
use DB;
use Session;
use Carbon\Carbon;
use AwsDynamoDB;

class IndexController extends Controller
{
    public static function scanData($proType)
    {
        $marshaler = new Marshaler();

        $eav = $marshaler->marshalJson('
            {
                ":name_prod_type": "' . $proType . '"
            }
        ');

        $params = [
            'TableName' => 'tb_san_pham',
            'ProjectionExpression' => 'id_san_pham, ten_san_pham, loai_san_pham, anh_sp, ten_sp, sale_price, gia_goc, xuat_xu, kich_thuoc_sp, slug_sp',
            'FilterExpression' => 'loai_san_pham = :name_prod_type',
            'ExpressionAttributeValues' => $eav
        ];

        return AwsDynamoDB::scan($params);
    }

    public function index()
    {
        $product_Bath = self::scanData("Bồn tắm");
        $product_sauna = self::scanData("Phòng xông hơi");
        $product_steam = self::scanData("Máy xông hơi");
        $product_tbvs = self::scanData("Thiết bị vệ sinh");
  
        return view('frontend/index')->with(compact('product_Bath', 'product_steam', 'product_sauna', 'product_tbvs'));
    }

    public static function settingsConsolePage($page, $slug, $res_tinhnang, $res, $res_xuatxu, $price, $thuong_hieu, $muc_gia, $xuat_xu, $kich_thuoc, $namespace, $request)
    {
        $feature = $request->feature;
        $datasp = explode(',', $feature);

        $marshaler = new Marshaler();

        $eav = $marshaler->marshalJson('
            {
                ":name_prod_type": "' . $slug . '"
            }
        ');

        $params = [
            'TableName' => 'tb_tinhnang_loaisp',
            'ProjectionExpression' => 'slug_tinh_nang, ten_tinh_nang',
            'FilterExpression' => 'loai_san_pham = :name_prod_type',
            'ExpressionAttributeValues' => $eav
        ];

        $tinh_nang = AwsDynamoDB::scan($params);

        if ($request->has('feature')) {
            //print_r($res_tinhnang);
            $arr = [];
            $queryTN = "";
            $eav1 = [
                ":name_prod_type" => [
                    "S" => $slug
                ]
            ];

            if (!empty($res)) {
                $i = 0;
                $str = "";
                foreach ($res as $rees) {
                    $i++;
                    if (count($res) < 2) {
                        $str .= ':thuong_hieu' . $i;
                    } else if ($i == count($res)) {
                        $str .= ':thuong_hieu' . $i;
                    } else {
                        $str .= ':thuong_hieu' . $i . ",";
                    }
                    $eav1[':thuong_hieu' . $i] = [
                        "N" => "$rees"
                    ];
                }
                $queryTN .= 'and id_thuong_hieu IN (' . $str . ')';
            }
            if (!empty($res_xuatxu)) {
                $i = 0;
                $str = "";
                foreach ($res as $rees) {
                    $i++;
                    if (count($res) < 2) {
                        $str .= ':xuat_xu' . $i;
                    } else if ($i == count($res)) {
                        $str .= ':xuat_xu' . $i;
                    } else {
                        $str .= ':xuat_xu' . $i . ",";
                    }
                    $eav1[':xuat_xu' . $i] = [
                        "N" => "$rees"
                    ];
                }
                $queryTN .= ' and id_xuat_xu IN (' . $str . ')';
            }

            if (!empty($res_tinhnang)) {
                $i = 0;
                $str = "";
                foreach ($res_tinhnang as $rees) {
                    $i++;
                    if (count($res_tinhnang) < 2) {
                        $str .= ':tinh_nang' . $i;
                    } else if ($i == count($res_tinhnang)) {
                        $str .= ':tinh_nang' . $i;
                    } else {
                        $str .= ':tinh_nang' . $i . ",";
                    }
                    $eav1[':tinh_nang' . $i] = [
                        "N" => "$rees"
                    ];
                }
                $queryTN .= ' and id_tinh_nang IN (' . $str . ')';
            }

            $table = "tb_tinhnang_sanpham";
            $params = [
                'TableName' => $table,
                'ProjectionExpression' => 'id_san_pham, ten_san_pham, loai_san_pham, anh_sp, ten_sp, sale_price, gia_goc, xuat_xu, kich_thuoc_sp, slug_sp, id_tinh_nang',
                'FilterExpression' => 'loai_san_pham = :name_prod_type ' . $queryTN . '',
                'ExpressionAttributeValues' => $eav1
            ];

            $productData = AwsDynamoDB::scan($params);

            if (!empty($productData['Items'])) {
                foreach ($productData['Items'] as $key => $value) {
                    $data = json_decode($marshaler->unmarshalJson($value));
                    array_push($arr, $data->id_san_pham);
                }
                $arrReturn = array_unique($arr);

                $eav2 = [
                    ":name_prod_type" => [
                        "S" => $slug
                    ]
                ];
                $x = 0;
                $strIdSp = "";
                $strId   = "";
                if (!empty($arrReturn)) {
                    foreach ($arrReturn as $dataId) {
                        $x++;
                        if (count($arrReturn) < 2) {
                            $strIdSp .= ':id' . $x;
                        } else if ($x == count($arrReturn)) {
                            $strIdSp .= ':id' . $x;
                        } else {
                            $strIdSp .= ':id' . $x . ",";
                        }
                        $eav2[':id' . $x] = [
                            "N" => "$dataId"
                        ];
                    }
                    $strId = 'and id_san_pham IN (' . $strIdSp . ')';
                }

                $params1 = [
                    'TableName' => "tb_san_pham",
                    'ProjectionExpression' => 'id_san_pham, ten_san_pham, loai_san_pham, anh_sp, ten_sp, sale_price, gia_goc, xuat_xu, kich_thuoc_sp, slug_sp, id_tinh_nang',
                    'FilterExpression' => 'loai_san_pham = :name_prod_type ' . $strId . '',
                    'ExpressionAttributeValues' => $eav2
                ];

                $product = AwsDynamoDB::scan($params1);
            }else{
                $product = $productData;
            }

            return view($page)->with(compact('product', 'tinh_nang', 'thuong_hieu', 'muc_gia', 'xuat_xu', 'kich_thuoc', 'namespace', 'slug', 'feature', 'datasp'));
        } else {
            $product = self::scanData($slug);


            $thuong_hieu = DB::table('tb_thuong_hieu')->get();
            $muc_gia = DB::table('tb_muc_gia')->get();
            $xuat_xu = DB::table('tb_xuat_xu')->get();
            $kich_thuoc = DB::table('tb_kich_thuoc')->get();

            return view($page)->with(compact('product', 'tinh_nang', 'thuong_hieu', 'muc_gia', 'xuat_xu', 'kich_thuoc', 'namespace', 'slug'));
        }
    }
    public function redirect(Request $request, $namespace = null, $string = null)
    {
        $feature_array = array();
        $feature = $request->feature;
        $datasp = explode(',', $feature);
        $data_thuonghieu = DB::table('tb_thuong_hieu')->select('slug', 'id')->get();
        $data_tinhnang = DB::table('tb_tinh_nang')->select('slug', 'id_tinh_nang')->get();
        $data_mucgia = DB::table('tb_muc_gia')->select('slug', 'id_muc_gia')->get();
        $data_xuatxu = DB::table('tb_xuat_xu')->select('slug', 'id_xuat_xu')->get();
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
                    array_push($res, $data->id);
                }
            }
        }
        /*=========================================================LOC TINH NANG=======================================*/

        for ($i = 0; $i < count($datasp); $i++) {
            foreach ($data_tinhnang as $data) {
                if ($data->slug === $datasp[$i]) {
                    array_push($res_tinhnang, $data->id_tinh_nang);
                }
            }
        }

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

        /*=========================================================LOC XUAT XU=======================================*/
        for ($i = 0; $i < count($datasp); $i++) {
            foreach ($data_xuatxu as $data) {
                if ($data->slug === $datasp[$i]) {
                    array_push($res_xuatxu, $data->id_xuat_xu);
                }
            }
            //print_r($datasp[$i]);
        }


        switch ($namespace) {

            case 'bon-tam':
                $slug = "Bồn tắm";
                $page = 'frontend/bath';
                return self::settingsConsolePage($page, $slug, $res_tinhnang, $res, $res_xuatxu, $price, $thuong_hieu, $muc_gia, $xuat_xu, $kich_thuoc, $namespace, $request);
                break;
            case 'phong-xong-hoi':
                $slug = "Phòng xông hơi";
                $page = 'frontend/sauna';
                return self::settingsConsolePage($page, $slug, $res_tinhnang, $res, $res_xuatxu, $price, $thuong_hieu, $muc_gia, $xuat_xu, $kich_thuoc, $namespace, $request);
                break;
            case 'may-xong-hoi':
                $slug = "Máy xông hơi";
                $page = 'frontend/steam_machine';
                return self::settingsConsolePage($page, $slug, $res_tinhnang, $res, $res_xuatxu, $price, $thuong_hieu, $muc_gia, $xuat_xu, $kich_thuoc, $namespace, $request);
                break;
            case 'quat-den-tran':
                $slug = "Quạt đèn trần";
                $page = 'frontend/ceiling_fan';
                return self::settingsConsolePage($page, $slug, $res_tinhnang, $res, $res_xuatxu, $price, $thuong_hieu, $muc_gia, $xuat_xu, $kich_thuoc, $namespace, $request);
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
        $data = DB::table('tb_san_pham')->where(['tb_san_pham.slug_sp' => $slug])
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

        if (!empty($respon)) {
            $json = json_encode($respon);
        } else {
            $json = "";
        }


        $arrUpdate = CartModel::where([
            'id_cart' => $request->cartId
        ])->update([
            'cart' => $json,
            'updated_at' => $time
        ]);


        if ($arrUpdate) {
            return "Đã xóa";
        } else {
            return "Thất bại";
        }
    }
    public function hello()
    {
        dd("a");
    }
}
