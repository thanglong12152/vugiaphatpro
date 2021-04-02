<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;

class CartModel extends Model
{
    protected $table = 'tb_cart';
    protected $fillable = [
        'id_cart',
        'id_user',
        'cart',
        'created_at',
        'updated_at'
    ];

    public function addToCart($request)
    {

        //dd($request->all());
        //dd(rand());
        //dd($request->all());
        $time = Carbon::now();
        $time2 = date('Y-m-d');
        //dd($request->all());

        $data = CustomerModel::updateOrInsert(
            ['ten_khach_hang' => $request->name_customer, 'so_dt' => $request->phone_customer],
            ['ten_khach_hang' => $request->name_customer, 'so_dt' => $request->phone_customer, 'dia_chi' => $request->address_customer]
        );

        $id = DB::getPdo()->lastInsertId();

        //dd($id);
        //Neu id user tra ve 0 thi tim kiem theo ten va so dt
        $user = DB::table('tb_khach_hang')
            ->where('ten_khach_hang', $request->name_customer)
            ->where('so_dt', $request->phone_customer)
            ->get();

        if ($id == 0) {
            $user = DB::table('tb_khach_hang')
                ->select('id_khach_hang as customerId', 'ten_khach_hang as customerName', 'so_dt as customerPhone')
                ->where(['ten_khach_hang' => $request->name_customer, 'so_dt' => $request->phone_customer])
                ->first();

            if (!empty($user)) {

                $array = [];
                $cart = DB::table('tb_cart')
                    ->select('id_cart as cartId', 'cart', 'id_user')
                    ->where([
                        'id_user' => $user->customerId,
                    ])
                    ->whereDate('created_at', $time2)
                    ->first();

                if (!empty($cart->cart)) {
                    // $arrReturn = [];

                    $arrReturn = [
                        "id_sp" => $request->id_sp,
                        "ten_sp" => $request->ten_sp,
                        "so_luong" => $request->quantity,
                        "price" => $request->price_old

                    ];

                    
                    $arr_cart = json_decode($cart->cart, true);

                    //$arr_cart[] = $arrReturn;
                    
                    //dd($arr_cart);
                    $tong = 0;
                    foreach ($arr_cart as $data) {
                        
                        if (($data['id_sp'] == $request->id_sp)) {
                            $quantity = $data['so_luong'] + $request->quantity;
                            $arr_cart[$request->id_sp] = [
                                "id_sp" => $data['id_sp'],
                                "ten_sp" => $data['ten_sp'],
                                "so_luong" => $quantity,
                                "price" => $data['price']
                            ];
                        } 
                    }
                //dd($arr_cart);

                    $json = json_encode($arr_cart);

                    $data = CartModel::where([
                        'id_cart' => $cart->cartId,
                        'id_user' => $cart->id_user,
                    ])->update([
                        'cart' => $json,
                        'updated_at' => $time
                    ]);
                } else if (empty($cart)) {
                    $user = DB::table('tb_khach_hang')->where(['ten_khach_hang' => $request->name_customer])->first();
                    
                    $arr = [
                        $request->id_sp => [
                            "id_sp" => $request->id_sp,
                            "ten_sp" => $request->ten_sp,
                            "so_luong" => $request->quantity,
                            "price" => $request->price_old
                        ]
                    ];
                    //dd($arr);
                    $arr_cart = json_encode($arr, true);

                    $data = CartModel::create([
                        'id_cart' => rand(),
                        'id_user' => $user->id_khach_hang,
                        'cart' => $arr_cart
                    ]);
                    $cart = DB::table('tb_cart')
                        ->select('id_cart as cartId', 'cart', 'id_user')
                        ->where([
                            'id_user' => $user->id_khach_hang,
                        ])
                        ->whereDate('created_at', $time)
                        ->first();
                    return $cart->cartId;
                }else if(empty($cart->cart)){
                    $user = DB::table('tb_khach_hang')->where(['ten_khach_hang' => $request->name_customer])->first();
                    
                    $arr = [
                        $request->id_sp => [
                            "id_sp" => $request->id_sp,
                            "ten_sp" => $request->ten_sp,
                            "so_luong" => $request->quantity,
                            "price" => $request->price_old
                        ]
                    ];
                    // dd($arr);
                    $arr_cart = json_encode($arr, true);

                    
                    $cart = DB::table('tb_cart')
                        ->select('id_cart as cartId', 'cart', 'id_user')
                        ->where([
                            'id_user' => $user->id_khach_hang,
                        ])
                        ->whereDate('created_at', $time)
                        ->first();

                        $data = CartModel::where('id_cart', $cart->cartId)
                        ->update([
                            'cart' => $arr_cart
                        ]);
                    return $cart->cartId;
                }
            } else {
                $arr = [
                    $request->id_sp => [
                        "id_sp" => $request->id_sp,
                        "ten_sp" => $request->ten_sp,
                        "so_luong" => $request->quantity,
                        "price" => $request->price_old
                    ]
                ];
                $arr_cart = json_encode($arr, true);




                $data = CartModel::create([
                    'id_cart' => rand(),
                    'id_user' => $user->customerId,
                    'cart' => $arr_cart
                ]);
            }
        }
        return $cart->cartId;
    }
}
