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
use App\XuatXu;
use App\KichThuoc;
use App\ProductType_Child;
use App\featureProduct;
use App\feature_Product;
use App\Http\Controllers\Backend\HandlingController;
use Aws\DynamoDb\Marshaler;
use DB;
use AwsDynamoDB;
use Carbon\Carbon;

class ProductController extends Controller
{

    public function all()
    {
        $product = HandlingController::scanTable("tb_san_pham");
        $productType = HandlingController::scanTable("tb_loai_san_pham");
        $productType_Child = HandlingController::scanTable("tb_sub_categories");
        $trademark = HandlingController::scanTable("tb_thuong_hieu");
        $size = HandlingController::scanTable("tb_kich_thuoc");
        return view('admin/product/all')->with(compact('product', 'productType', 'size', 'productType_Child', 'trademark'));
    }

    public function add(Request $request)
    {

        $madeby = HandlingController::scanTable("tb_xuat_xu");
        $product = HandlingController::scanTable("tb_san_pham");
        $prod_data = HandlingController::scanTableByIdAnItem("tb_san_pham", "id_san_pham");

        $trademarkAll = HandlingController::scanTable("tb_thuong_hieu");
        $productType = HandlingController::scanTable("tb_loai_san_pham");
        $productType_Child = HandlingController::scanTable("tb_sub_categories");
        $featureProduct = HandlingController::scanTable("tb_tinh_nang");
        if ($request->isMethod('post')) {

            $data = $request->all();
            //Upload image
            if ($request->hasFile('anh_sp')) {
                $image_tmp = $request->file('anh_sp');
                if ($image_tmp->isValid()) {
                    //echo 'test'; die;
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'image/product/large/' . $filename;
                    $medium_image_path = 'image/product/medium/' . $filename;
                    $small_image_path = 'image/product/small/' . $filename;
                    //Resize image

                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(600, 600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300, 300)->save($small_image_path);

                    // $product->anh_sp = $filename;
                }
            }
            if ($data['mo_ta'] === '') {
                $res = '';
                // $product->mo_ta = $res;
            } else {

                $res = html_entity_decode($data['mo_ta']);
                // $product->mo_ta = $res;
            }

            // $product->save();

            $marshaler = new Marshaler();
            /*********Lay loai san pham*********** */
            $eav1 = $marshaler->marshalJson('
                {
                    ":id_loai_san_pham": ' . $data['productType'] . '
                }
            ');

            $params1 = [
                'TableName' => 'tb_loai_san_pham',
                'FilterExpression' => 'id_loai_san_pham = :id_loai_san_pham',
                'ExpressionAttributeValues' => $eav1
            ];
            $loai_san_pham = HandlingController::getAnItemTable($params1);

            /*******************Lay xuat_xu ************/
            $eav2 = $marshaler->marshalJson('
                {
                    ":id_xuat_xu": ' . $data['xuat_xu'] . '
                }
            ');

            $params2 = [
                'TableName' => 'tb_xuat_xu',
                'FilterExpression' => 'id_xuat_xu = :id_xuat_xu',
                'ExpressionAttributeValues' => $eav2
            ];
            $xuat_xu = HandlingController::getAnItemTable($params2);

            /*******************Lay loai san pham con ************/
            $eav3 = $marshaler->marshalJson('
                {
                    ":id": ' . $data['productType_Child'] . '
                }
            ');

            $params3 = [
                'TableName' => 'tb_sub_categories',
                'FilterExpression' => 'id = :id',
                'ExpressionAttributeValues' => $eav3
            ];
            $sub_categories = HandlingController::getAnItemTable($params3);

            /*******************Lay thuong hieu ************/
            $eav4 = $marshaler->marshalJson('
                {
                    ":id": ' . $data['thuong_hieu'] . '
                }
            ');

            $params4 = [
                'TableName' => 'tb_thuong_hieu',
                'FilterExpression' => 'id = :id',
                'ExpressionAttributeValues' => $eav4
            ];
            $thuong_hieu = HandlingController::getAnItemTable($params4);

            $chung_loai = '';
            $created_at = Carbon::now();
            $id_sp = $prod_data[0]->id_san_pham + 1;
            $slug_sp  = Str::slug($data['name_prod'], '-');
            $json = json_encode($res);
            $item = $marshaler->marshalJson('
                {
                    "id_san_pham": ' . $id_sp . ',
                    "ten_san_pham": "' . $data['name_prod'] . '",
                    "anh_sp": "' . $filename . '",
                    "chat_lieu": "' . $data['chat_lieu'] . '",
                    "chuc_nang": "' . $data['chuc_nang'] . '",
                    "chung_loai": "' . $chung_loai . '",
                    "cong_suat_den": "' . $data['cong_suat_den'] . '",
                    "cong_suat_may": "' . $data['cong_suat_may'] . '",
                    "created_at": "' . $created_at . '",
                    "day_dien": "' . $data['day_dien'] . '",
                    "dien_nang": "' . $data['dien_nang'] . '",
                    "dong_co": "' . $data['dong_co'] . '",
                    "gia_goc": "' . $data['gia_sp'] . '",
                    "id_loai_sp_con": ' . $data['productType_Child'] . ',
                    "id_loai_san_pham": ' . $data['productType'] . ',
                    "id_thuong_hieu":' . $data['thuong_hieu'] . ',
                    "id_xuat_xu": ' . $data['xuat_xu'] . ',
                    "kich_thuoc_sp": "' . $data['kich_thuoc'] . '",
                    "kieu_dang": "' . $data['kieu_dang'] . '",
                    "loai_den": "' . $data['loai_den'] . '",
                    "loai_san_pham": "' . $loai_san_pham->loai_san_pham . '",
                    "ma_sp": "' . $data['ma_sp'] . '",
                    "mau_sac": "' . $data['mau_sac'] . '",
                    "max_people": "' . $data['max_people'] . '",
                    "ong_cap_nuoc": "' . $data['ong_cap_nuoc'] . '",
                    "phu_kien_di_kem": "' . $data['phu_kien_di_kem'] . '",
                    "sai_canh": "' . $data['sai_canh'] . '",
                    "sale_price": "' . $data['sale_price'] . '",
                    "slug_xuat_xu": "' . $xuat_xu->slug . '",
                    "slug_sp": "' . $slug_sp . '",
                    "ten_loai_sp_con": "' . $sub_categories->ten_loai_sp_con . '",
                    "ten_sp": "' . $data['name_prod'] . '",
                    "ten_thuong_hieu": "' . $thuong_hieu->ten_thuong_hieu . '",
                    "thiet_ke": "' . $data['thiet_ke'] . '",
                    "thoi_gian_bh": "' . $data['thoi_gian_bh'] . '",
                    "updated_at": "' . $created_at . '",
                    "xuat_xu": "' . $xuat_xu->xuat_xu . '",
                    "mo_ta": ' . $json . '
                }
            ');

            $params = [
                'TableName' => 'tb_san_pham',
                'Item' => $item
            ];

            AwsDynamoDB::create($params);

            foreach ($request->feature as $key => $value) {
                $id_tinh_nang = (int) $value;

                $eav5 = $marshaler->marshalJson('
                    {
                        ":id_tinh_nang": ' . $id_tinh_nang . '
                    }
                ');

                $params5 = [
                    'TableName' => 'tb_tinh_nang',
                    'FilterExpression' => 'id_tinh_nang = :id_tinh_nang',
                    'ExpressionAttributeValues' => $eav5
                ];
                $tinh_nang = HandlingController::getAnItemTable($params5);

                $item = $marshaler->marshalJson('
                    {
                        "id_tinh_nang": ' . $id_tinh_nang . ',
                        "ten_tinh_nang": "' . $tinh_nang->ten_tinh_nang . '",
                        "id_thuong_hieu": ' . $data['thuong_hieu'] . ',
                        "id_san_pham": ' . $id_sp . ',
                        "id_xuat_xu": ' . $data['xuat_xu'] . ',
                        "slug_sp": "' . $slug_sp . '",
                        "anh_sp": "' . $filename . '",
                        "ten_sp": "' . $data['name_prod'] . '",
                        "sale_price": "' . $data['sale_price'] . '",
                        "gia_goc": "' . $data['gia_sp'] . '",
                        "xuat_xu": "' . $xuat_xu->xuat_xu . '",
                        "kich_thuoc_sp": "' . $data['kich_thuoc'] . '",
                        "slug_tinh_nang": "' . $tinh_nang->ten_tinh_nang . '",
                        "loai_san_pham": "' . $loai_san_pham->loai_san_pham . '",
                        "thuong_hieu": "' . $thuong_hieu->ten_thuong_hieu . '"
                    }
                ');

                $params = [
                    'TableName' => 'tb_tinhnang_sanpham',
                    'Item' => $item
                ];

                AwsDynamoDB::create($params);
            }





            return redirect('admin/product/all')->with('flash_message_success', 'Thêm sản phẩm thành công');
        }
        return view('admin/product/add', compact('productType', 'trademarkAll', 'madeby', 'featureProduct', 'prod_data'));
    }

    public function edit(Request $request, $id = null)
    {
        $product = HandlingController::scanTable("tb_san_pham");
        $marshaler = new Marshaler();
        $eav = $marshaler->marshalJson('
            {
                ":id_san_pham": ' . $id . '
            }
        ');

        $params = [
            'TableName' => 'tb_san_pham',
            'FilterExpression' => 'id_san_pham = :id_san_pham',
            'ExpressionAttributeValues' => $eav
        ];
        $productDetails = HandlingController::getAnItemTable($params);

        $productType = HandlingController::scanTable("tb_loai_san_pham");


        $params1 = [
            'TableName' => 'tb_tinhnang_sanpham',
            'FilterExpression' => 'id_san_pham = :id_san_pham',
            'ExpressionAttributeValues' => $eav
        ];
        $dataSlugSp = HandlingController::getItemTable($params1);
        $arrSlugSp = [];
        foreach ($dataSlugSp as $value) {
            array_push($arrSlugSp, $value->slug_tinh_nang);
        }
        $prod_data = implode(',', $arrSlugSp);


        $productType_Child = HandlingController::scanTable("tb_sub_categories");
        $trademarkAll = HandlingController::scanTable("tb_thuong_hieu");
        $featureProduct = HandlingController::scanTable("tb_tinh_nang");

        if ($request->isMethod('post')) {
            $data = $request->all();

            //echo "<pre>"; print_r($data); die;
            //Upload image
            if ($request->hasFile('anh_sp')) {
                $image_tmp = $request->file('anh_sp');
                if ($image_tmp->isValid()) {
                    //echo 'test'; die;
                    $extension = $image_tmp->getClientOriginalExtension();
                    $filename = rand(111, 99999) . '.' . $extension;
                    $large_image_path = 'image/product/large/' . $filename;
                    $medium_image_path = 'image/product/medium/' . $filename;
                    $small_image_path = 'image/product/small/' . $filename;
                    //Resize image
                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(600, 600)->save($medium_image_path);
                    Image::make($image_tmp)->resize(300, 300)->save($small_image_path);
                }
            } else {
                $filename = $data['current_image'];
            }

            if ($data['mo_ta'] === '') {
                $res = '';
                // $product->mo_ta = $res;
            } else {

                $res = html_entity_decode($data['mo_ta']);
                // $product->mo_ta = $res;
            }
            $id_sp = $data['id_sp'];
            $chung_loai = '';
            $strItem = '';
            $slug_sp  = Str::slug($data['name_prod'], '-');
            $created_at = Carbon::now();
            $json = json_encode($res);

            $eav1 = $marshaler->marshalJson('
                {
                    ":id_loai_san_pham": ' . $data['loai_sp'] . '
                }
            ');

            $params1 = [
                'TableName' => 'tb_loai_san_pham',
                'FilterExpression' => 'id_loai_san_pham = :id_loai_san_pham',
                'ExpressionAttributeValues' => $eav1
            ];
            $loai_san_pham = HandlingController::getAnItemTable($params1);
            
            /*******************Lay xuat_xu ************/
            if (isset($data['xuat_xu'])) {
                $eav2 = $marshaler->marshalJson('
                {
                    ":id_xuat_xu": ' . $data['xuat_xu'] . '
                }
            ');

                $params2 = [
                    'TableName' => 'tb_xuat_xu',
                    'FilterExpression' => 'id_xuat_xu = :id_xuat_xu',
                    'ExpressionAttributeValues' => $eav2
                ];
                $xuat_xu = HandlingController::getAnItemTable($params2);
            }
            
            /*******************Lay loai san pham con ************/
            $eav3 = $marshaler->marshalJson('
                {
                    ":id": ' . $data['productType_Child'] . '
                }
            ');

            $params3 = [
                'TableName' => 'tb_sub_categories',
                'FilterExpression' => 'id = :id',
                'ExpressionAttributeValues' => $eav3
            ];
            $sub_categories = HandlingController::getAnItemTable($params3);
            
            /*******************Lay thuong hieu ************/
            if (isset($data['thuong_hieu'])) {
                $eav4 = $marshaler->marshalJson('
                {
                    ":id": ' . $data['thuong_hieu'] . '
                }
            ');

                $params4 = [
                    'TableName' => 'tb_thuong_hieu',
                    'FilterExpression' => 'id = :id',
                    'ExpressionAttributeValues' => $eav4
                ];
                $thuong_hieu = HandlingController::getAnItemTable($params4);
            }
     

            if (isset($data['name_prod'])) {
                $strItem .= '":ten_sp": "' . $data['name_prod'] . '"';
                $setString = 'ten_sp = :ten_sp';
            }
            

            $key = $marshaler->marshalJson('
                {
                    "id_san_pham": ' . $id_sp . ',
                    "ten_san_pham": "' . $productDetails->ten_san_pham . '"
                }
            ');

            $eavUpdate = $marshaler->marshalJson('
                {
                    ' . $strItem . '
                }
            ');


            $paramsUpdate = [
                'TableName' => 'tb_san_pham',
                'Key' => $key,
                'UpdateExpression' => 'set ' . $setString . '',
                'ExpressionAttributeValues' => $eavUpdate,
                'ReturnValues' => 'UPDATED_NEW'
            ];
 
            AwsDynamoDB::update($paramsUpdate);

            $eavScan = $marshaler->marshalJson('
                {
                    ":yyyy": 1 
                }
            ');

            $params = [
                'TableName' => 'tb_tinhnang_sanpham',
                'KeyConditionExpression' => 'id_san_pham = :yyyy',
                'ExpressionAttributeValues'=> $eavScan
            ];

            $scan = AwsDynamoDB::query($params);

            foreach($scan['Items'] as $key => $value){
                $data = json_decode($marshaler->unmarshalJson($value));

                $key = $marshaler->marshalJson('
                    {
                        "id_san_pham": ' . $id_sp . ',
                        "id_tinh_nang": ' . $data->id_tinh_nang . '
                    }
                ');
                $params = [
                    'TableName' => 'tb_tinhnang_sanpham',
                    'Key' => $key
                ];
        
                AwsDynamoDB::delete($params);
            }
 
            foreach ($request->feature as $key => $value) {
                $id_tinh_nang = (int) $value;
                $eav5 = $marshaler->marshalJson('
                    {
                        ":id_tinh_nang": ' . $id_tinh_nang . '
                    }
                ');

                $params5 = [
                    'TableName' => 'tb_tinh_nang',
                    'FilterExpression' => 'id_tinh_nang = :id_tinh_nang',
                    'ExpressionAttributeValues' => $eav5
                ];
                $tinh_nang = HandlingController::getAnItemTable($params5);

                $item = $marshaler->marshalJson('
                    {
                        "id_tinh_nang": ' . $id_tinh_nang . ',
                        "ten_tinh_nang": "' . $tinh_nang->ten_tinh_nang . '",
                        "id_thuong_hieu": ' . $productDetails->id_thuong_hieu . ',
                        "id_san_pham": ' . $id_sp . ',
                        "id_xuat_xu": ' . $productDetails->id_xuat_xu . ',
                        "slug_sp": "' . $productDetails->slug_sp . '",
                        "anh_sp": "' . $productDetails->anh_sp . '",
                        "ten_sp": "' . $productDetails->ten_sp . '",
                        "sale_price": "' . $productDetails->sale_price . '",
                        "gia_goc": "' . $productDetails->gia_goc . '",
                        "xuat_xu": "' . $productDetails->xuat_xu . '",
                        "kich_thuoc_sp": "' . $productDetails->kich_thuoc_sp . '",
                        "slug_tinh_nang": "' . $tinh_nang->ten_tinh_nang . '",
                        "loai_san_pham": "' . $productDetails->loai_san_pham . '",
                        "thuong_hieu": "' . $productDetails->ten_thuong_hieu . '"
                    }
                ');

                $params = [
                    'TableName' => 'tb_tinhnang_sanpham',
                    'Item' => $item
                ];
               AwsDynamoDB::create($params);
               
            }


            return redirect()->back()->with('flash_message_success', 'Sửa sản phẩm thành công');
        }

        //$productDetails = Product::where(['id_san_pham'=>$id])->first();
        $trademark = DB::table('tb_san_pham')->join('tb_thuong_hieu', 'tb_san_pham.id_thuong_hieu', '=', 'tb_thuong_hieu.id')->where(['id_san_pham' => $id])->first();

        //echo "<pre>"; print_r($data);
        return view('admin/product/edit')->with(compact('productDetails', 'productType', 'trademark', 'trademarkAll', 'productType_Child', 'prod_data', 'featureProduct'));
    }

    public function delete($id = null)
    {
        $marshaler = new Marshaler();
        if (!empty($id)) {
            $eav = $marshaler->marshalJson('
                {
                    ":id_san_pham": ' . $id . '
                }
            ');

        $params = [
            'TableName' => 'tb_san_pham',
            'FilterExpression' => 'id_san_pham = :id_san_pham',
            'ExpressionAttributeValues' => $eav
        ];
        $productDetails = HandlingController::getAnItemTable($params);

        $key = $marshaler->marshalJson('
            {
                "id_san_pham": ' . $productDetails->id_san_pham . ',
                "ten_san_pham": "' . $productDetails->ten_san_pham . '"
            }
        ');

        $params = [
            'TableName' => 'tb_san_pham',
            'Key' => $key
        ];

        AwsDynamoDB::delete($params);
            // Product::where(['id_san_pham' => $id])->delete();
            return redirect()->back()->with('flash_message_success', 'Xóa thành công');
        }
    }

    public function filter(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('tb_loai_san_pham')
                ->join('tb_sub_categories', function ($join) {
                    $join->on('tb_loai_san_pham.id_loai_san_pham', '=', 'tb_sub_categories.id_loai_san_pham');
                })
                ->where('tb_loai_san_pham.id_loai_san_pham', '=', $request->productType_s)->get();
            //echo "<pre>"; print_r($data); die;
            //   if ($data) {
            $output = "<select name='productType_Child' id='productType_Child' class='form-control'>";
            foreach ($data as $key) {
                $output .= "<option value='$key->id'>" . $key->ten_loai_sp_con . "</option>";
            }
            $output .= "</select>";
        }
        return response($output);
        // }
    }
}
