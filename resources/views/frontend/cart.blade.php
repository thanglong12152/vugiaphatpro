@include('block/header')

{{-- @foreach($data as $key => $value)
{{$value['name']}} Số lượng: {{$value['quantity']}} Tổng giá: {{$value['totalPrice']}}
@endforeach --}}
<div class="container">
    <section class="cart">

        <h1 class="cart">GIỎ HÀNG</h1>
        <div class="profile_customer">
            <h2 class="name">Họ và tên: {{$tenKH}}</h2>
            <h2 class="address">Địa chỉ: {{$diaChi}}</h2>
            <h2 class="phone_number">Số điện thoại: {{$soDt}}</h2>
            <h2 class="date">Ngày đặt hàng: {{$ngayDatHang}}</h2>
        </div>
        <div class="table-profile">
            <div class="table">
                <div class="thead">
                    <div class="tr">
                        <div class="td">Ảnh sản phẩm</div>
                        <div class="td">Tên sản phẩm</div>
                        <div class="td">Số lượng</div>
                        <div class="td">Giá</div>
                        <div class="td">Tổng</div>
                        <div class="td">Xóa</div>
                    </div>
                </div>
                <div class="tbody">
                    @foreach($cart as $key => $value)
                    <form action="/delete/{{$value['id_sp']}}" method="post" id="cart{{$value['id_sp']}}"></form>
                    <form class="tr">
                        <div class="td">Chưa có
                            <input type="hidden" class="id_sp" value={{$value['id_sp']}}>
                        </div>
                        <div class="td">{{$value['ten_sp']}}</div>
                        <div class="td">
                            <input class="sl" type="number" min="1" name="sl" value="{{$value['so_luong']}}" id="sl">
                        </div>
                        <div class="td">{{number_format($value['price'],0,".",".")}}</div>
                        <div class="td">{{number_format($value['price'] * $value['so_luong'],0,".",".")}}</div>
                        <div class="td action"><button type="button" data-ip="{{$value['id_sp']}}"
                                onClick="deleteProduct({{$value['id_sp']}},{{$cartId}})"
                                class="cart_submit cart_submit_{{$value['id_sp']}}" form="cart{{$value['id_sp']}}"><i
                                    class="fa fa-trash-o cart_order" aria-hidden="true"></i></button>

                        </div>
                    </form>
                    @endforeach
                </div>
                <div class="thead">
                    <div class="tr">
                        <div class="td">Tổng</div>
                        <div class="td"></div>
                        <div class="td"></div>
                        <div class="td"></div>
                        <div class="td">{{number_format($totalCart,0,".",".")}}</div>
                        <div class="td">VND</div>
                    </div>
                </div>
            </div>
            </table>
        </div>
    </section>
</div>

@include('block/footer')