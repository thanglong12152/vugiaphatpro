@include('block/header')

<div class="no-cart" style="background-color: #fff">
    <div class="page-content not-item text-center">
        <div class="img text-center">
            <img src="{{asset('image/empty_cart.png')}}" alt="Empty cart">
        </div>
        <p style="padding: 10px 0 0 0">Không có sản phẩm nào trong giỏ hàng của bạn</p>
        <div class="ctnBuy">
            <a href="/" class="btn btn-outline closeCartLine">Tiếp tục mua hàng</a>
        </div>
    </div>
</div>
@include('block/footer')