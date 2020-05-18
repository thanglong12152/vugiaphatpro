@include('block/header')

<div class="breadcrumbs">
   <div class="container cls">
      <div class="breadcrumbs_wrapper" itemscope="" itemtype="http://schema.org/WebPage">
         <ul class="breadcrumb" itemscope="itemscope" itemtype="https://schema.org/BreadcrumbList">
            <li class="breadcrumb__item" itemprop="itemListElement" itemscope="itemscope"
               itemtype="http://schema.org/ListItem">
               <a title="Vũ Gia Phát - Thiết bị phòng tắm, phòng bếp nhập khẩu" href="https://vugiaphat.vn/"
                  itemprop="item">
                  <span itemprop="name">Trang chủ</span>
                  <meta content="1" itemprop="position">
               </a>
            </li>
            <li class="breadcrumb__item" itemprop="itemListElement" itemscope="itemscope"
               itemtype="http://schema.org/ListItem">
               <a title="Tin tức" href="{{url('/bon-tam/')}}" itemprop="item">
                  <span itemprop="name">{{$slug}}</span>
                  <meta content="2" itemprop="position">
               </a>
            </li>
         </ul>
      </div>
   </div>
</div>
<div class="main_wrapper container">
   <div class="main-area main-area-1col main-area-full">
      <div class="clear"></div>
      <div class="products-cat">
         <div class="field-title">
            <div class="title-name">
               <div class="cat-title">
                  <div class="cat-title-main" id="cat-bon-tam">
                     <div class="cat_icon">
                        <i class="icon">
                           <svg x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;"
                              xml:space="preserve">
                              <g>
                                 <g>
                                    <rect x="133" y="158.5" width="30" height="30"></rect>
                                 </g>
                              </g>
                              <g>
                                 <g>
                                    <rect x="133" y="209.5" width="30" height="30"></rect>
                                 </g>
                              </g>
                              <g>
                                 <g>
                                    <rect x="89.5" y="158.5" width="30" height="30"></rect>
                                 </g>
                              </g>
                              <g>
                                 <g>
                                    <rect x="89.5" y="209.5" width="30" height="30"></rect>
                                 </g>
                              </g>
                              <g>
                                 <g>
                                    <rect x="177" y="158.5" width="30" height="30"></rect>
                                 </g>
                              </g>
                              <g>
                                 <g>
                                    <rect x="177" y="209.5" width="30" height="30"></rect>
                                 </g>
                              </g>
                              <g>
                                 <g>
                                    <path
                                       d="M76,263.795V58.5C76,42.785,88.785,30,104.5,30c15.715,0,28.5,12.785,28.5,28.5v1.82	c-20.077,6.375-34.667,25.186-34.667,47.347v33.666h99.334v-33.666c0-22.16-14.59-40.972-34.667-47.347V58.5	C163,26.243,136.757,0,104.5,0S46,26.243,46,58.5v205.295H0v57.75h512v-57.75H76z">
                                    </path>
                                 </g>
                              </g>
                              <g>
                                 <g>
                                    <path
                                       d="M16,351.545V372c0,77.196,62.804,140,140,140h195.813c77.196,0,140-62.804,140-140v-20.455H16z">
                                    </path>
                                 </g>
                              </g>
                           </svg>
                        </i>
                        <h1>Bồn tắm</h1>
                     </div>
                     <div class="icon-filter">
                        <span></span>
                        <div class="filter_inner mypopup">
                           <div class="block_products_filter">
                              <div class="block_product_filter">
                                 <div class="field_area field_item" id="m-tinh_nang">
                                    <div class="field_name normal field field_opened " data-id="id_field_tinh_nang">Tính
                                       Năng</div>
                                    <div id="tinh_nang"
                                       class="field_label filters_in_field filters_in_field_0_column filter_4_tinh_nang">
                                       <div class="filters_in_field_inner cls">
                                          <span class="close">
                                             <svg height="10px" viewBox="0 0 64 64" enable-background="new 0 0 64 64">
                                                <g>
                                                   <path fill="#4e4b4b"
                                                      d="M28.941,31.786L0.613,60.114c-0.787,0.787-0.787,2.062,0,2.849c0.393,0.394,0.909,0.59,1.424,0.59 c0.516,0,1.031-0.196,1.424-0.59l28.541-28.541l28.541,28.541c0.394,0.394,0.909,0.59,1.424,0.59c0.515,0,1.031-0.196,1.424-0.59 c0.787-0.787,0.787-2.062,0-2.849L35.064,31.786L63.41,3.438c0.787-0.787,0.787-2.062,0-2.849c-0.787-0.786-2.062-0.786-2.848,0 L32.003,29.15L3.441,0.59c-0.787-0.786-2.061-0.786-2.848,0c-0.787,0.787-0.787,2.062,0,2.849L28.941,31.786z">
                                                   </path>
                                                </g>
                                             </svg>
                                          </span>
                                          @php
                                          foreach($tinh_nang as $data){
                                          $activated = '';
                                          $comma ='';
                                          if(empty($feature)){
                                          $feature ='';

                                          }else{
                                          $comma = ',';

                                          for ($i = 0; $i < count($datasp) ;$i++){ if($data->slug === $datasp[$i]){
                                             $activated = 'activated';

                                             $array = array(
                                             'data' => $data->slug
                                             );
                                             $array2 = array(
                                             'data' => $datasp[$i]
                                             );
                                             $array3 = array_diff($datasp,$array);
                                             $array4 = implode(',',$array3);
                                             }

                                             }
                                             //unset($datasp[$place]);
                                             }

                                             if($activated === 'activated'){
                                             if(empty($array4)){
                                             echo '<div class="'.$activated.' cls item"><a href="/'.$namespace.'"
                                                   title="'.$data->ten_tinh_nang.'"><i
                                                      class="icon_v1 "></i>'.$data->ten_tinh_nang.'</a></div>';
                                             }else{
                                             echo '<div class="'.$activated.' cls item"><a
                                                   href="/'.$namespace.'/?feature='.$array4.'"
                                                   title="'.$data->ten_tinh_nang.'"><i
                                                      class="icon_v1 "></i>'.$data->ten_tinh_nang.'</a></div>';
                                             }
                                             }else{
                                             echo '<div class="'.$activated.' cls item"><a
                                                   href="/'.$namespace.'/?feature='.$feature.''.$comma.''.$data->slug.'"
                                                   title="'.$data->ten_tinh_nang.'"><i
                                                      class="icon_v1 "></i>'.$data->ten_tinh_nang.'</a></div>';
                                             }
                                             }
                                             @endphp
                                       </div>
                                    </div>
                                 </div>
                                 <div class="field_area field_item" id="m-manufactory">
                                    <div class="field_name normal field field_opened " data-id="id_field_manufactory">
                                       Hãng sản xuất</div>
                                    <div id="manufactory"
                                       class="field_label filters_in_field filters_in_field_1_column filter_4_manufactory">
                                       <div class="filters_in_field_inner cls">
                                          <span class="close">
                                             <svg height="10px" viewBox="0 0 64 64" enable-background="new 0 0 64 64">
                                                <g>
                                                   <path fill="#4e4b4b"
                                                      d="M28.941,31.786L0.613,60.114c-0.787,0.787-0.787,2.062,0,2.849c0.393,0.394,0.909,0.59,1.424,0.59 c0.516,0,1.031-0.196,1.424-0.59l28.541-28.541l28.541,28.541c0.394,0.394,0.909,0.59,1.424,0.59c0.515,0,1.031-0.196,1.424-0.59 c0.787-0.787,0.787-2.062,0-2.849L35.064,31.786L63.41,3.438c0.787-0.787,0.787-2.062,0-2.849c-0.787-0.786-2.062-0.786-2.848,0 L32.003,29.15L3.441,0.59c-0.787-0.786-2.061-0.786-2.848,0c-0.787,0.787-0.787,2.062,0,2.849L28.941,31.786z">
                                                   </path>
                                                </g>
                                             </svg>
                                          </span>
                                          @php
                                          foreach($thuong_hieu as $data){
                                          $activated = '';
                                          $comma ='';
                                          if(empty($feature)){
                                          $feature ='';

                                          }else{
                                          $comma = ',';

                                          for ($i = 0; $i < count($datasp) ;$i++){ if($data->slug === $datasp[$i]){
                                             $activated = 'activated';

                                             $array = array(
                                             'data' => $data->slug
                                             );
                                             $array2 = array(
                                             'data' => $datasp[$i]
                                             );
                                             $array3 = array_diff($datasp,$array);
                                             $array4 = implode(',',$array3);
                                             }

                                             }
                                             //unset($datasp[$place]);
                                             }

                                             if($activated === 'activated'){
                                             if(empty($array4)){
                                             echo '<div class="'.$activated.' cls item"><a href="/'.$namespace.'"
                                                   title="'.$data->ten_thuong_hieu.'"><i
                                                      class="icon_v1 "></i>'.$data->ten_thuong_hieu.'</a></div>';
                                             }else{
                                             echo '<div class="'.$activated.' cls item"><a
                                                   href="/'.$namespace.'/?feature='.$array4.'"
                                                   title="'.$data->ten_thuong_hieu.'"><i
                                                      class="icon_v1 "></i>'.$data->ten_thuong_hieu.'</a></div>';
                                             }
                                             }else{
                                             echo '<div class="'.$activated.' cls item"><a
                                                   href="/'.$namespace.'/?feature='.$feature.''.$comma.''.$data->slug.'"
                                                   title="'.$data->ten_thuong_hieu.'"><i
                                                      class="icon_v1 "></i>'.$data->ten_thuong_hieu.'</a></div>';
                                             }
                                             }
                                             @endphp
                                       </div>
                                    </div>
                                 </div>
                                 <div class="field_area field_item" id="m-price">
                                    <div class="field_name normal field field_opened " data-id="id_field_price">Giá
                                    </div>
                                    <div id="price"
                                       class="field_label filters_in_field filters_in_field_1_column filter_4_price">
                                       <div class="filters_in_field_inner cls">
                                          <span class="close">
                                             <svg height="10px" viewBox="0 0 64 64" enable-background="new 0 0 64 64">
                                                <g>
                                                   <path fill="#4e4b4b"
                                                      d="M28.941,31.786L0.613,60.114c-0.787,0.787-0.787,2.062,0,2.849c0.393,0.394,0.909,0.59,1.424,0.59 c0.516,0,1.031-0.196,1.424-0.59l28.541-28.541l28.541,28.541c0.394,0.394,0.909,0.59,1.424,0.59c0.515,0,1.031-0.196,1.424-0.59 c0.787-0.787,0.787-2.062,0-2.849L35.064,31.786L63.41,3.438c0.787-0.787,0.787-2.062,0-2.849c-0.787-0.786-2.062-0.786-2.848,0 L32.003,29.15L3.441,0.59c-0.787-0.786-2.061-0.786-2.848,0c-0.787,0.787-0.787,2.062,0,2.849L28.941,31.786z">
                                                   </path>
                                                </g>
                                             </svg>
                                          </span>
                                          @php
                                          foreach($muc_gia as $data){
                                          $activated = '';
                                          $comma ='';
                                          if(empty($feature)){
                                          $feature ='';

                                          }else{
                                          $comma = ',';

                                          for ($i = 0; $i < count($datasp) ;$i++){ if($data->slug === $datasp[$i]){
                                             $activated = 'activated';

                                             $array = array(
                                             'data' => $data->slug
                                             );
                                             $array2 = array(
                                             'data' => $datasp[$i]
                                             );
                                             $array3 = array_diff($datasp,$array);
                                             $array4 = implode(',',$array3);
                                             }

                                             }
                                             //unset($datasp[$place]);
                                             }

                                             if($activated === 'activated'){
                                             if(empty($array4)){
                                             echo '<div class="'.$activated.' cls item"><a href="/'.$namespace.'"
                                                   title="'.$data->muc_gia.'"><i
                                                      class="icon_v1 "></i>'.$data->muc_gia.'</a></div>';
                                             }else{
                                             echo '<div class="'.$activated.' cls item"><a
                                                   href="/'.$namespace.'/?feature='.$array4.'"
                                                   title="'.$data->muc_gia.'"><i
                                                      class="icon_v1 "></i>'.$data->muc_gia.'</a></div>';
                                             }
                                             }else{
                                             echo '<div class="'.$activated.' cls item"><a
                                                   href="/'.$namespace.'/?feature='.$feature.''.$comma.''.$data->slug.'"
                                                   title="'.$data->muc_gia.'"><i
                                                      class="icon_v1 "></i>'.$data->muc_gia.'</a></div>';
                                             }
                                             }
                                             @endphp
                                       </div>
                                    </div>
                                 </div>
                                 <div class="field_area field_item" id="m-origin">
                                    <div class="field_name normal field field_opened " data-id="id_field_origin">Xuất xứ
                                    </div>
                                    <div id="origin"
                                       class="field_label filters_in_field filters_in_field_1_column filter_4_origin">
                                       <div class="filters_in_field_inner cls">
                                          <span class="close">
                                             <svg height="10px" viewBox="0 0 64 64" enable-background="new 0 0 64 64">
                                                <g>
                                                   <path fill="#4e4b4b"
                                                      d="M28.941,31.786L0.613,60.114c-0.787,0.787-0.787,2.062,0,2.849c0.393,0.394,0.909,0.59,1.424,0.59 c0.516,0,1.031-0.196,1.424-0.59l28.541-28.541l28.541,28.541c0.394,0.394,0.909,0.59,1.424,0.59c0.515,0,1.031-0.196,1.424-0.59 c0.787-0.787,0.787-2.062,0-2.849L35.064,31.786L63.41,3.438c0.787-0.787,0.787-2.062,0-2.849c-0.787-0.786-2.062-0.786-2.848,0 L32.003,29.15L3.441,0.59c-0.787-0.786-2.061-0.786-2.848,0c-0.787,0.787-0.787,2.062,0,2.849L28.941,31.786z">
                                                   </path>
                                                </g>
                                             </svg>
                                          </span>
                                          @php
                                          foreach($xuat_xu as $data){
                                          $activated = '';
                                          $comma ='';
                                          if(empty($feature)){
                                          $feature ='';

                                          }else{
                                          $comma = ',';

                                          for ($i = 0; $i < count($datasp) ;$i++){ if($data->slug === $datasp[$i]){
                                             $activated = 'activated';

                                             $array = array(
                                             'data' => $data->slug
                                             );
                                             $array2 = array(
                                             'data' => $datasp[$i]
                                             );
                                             $array3 = array_diff($datasp,$array);
                                             $array4 = implode(',',$array3);
                                             }

                                             }
                                             //unset($datasp[$place]);
                                             }

                                             if($activated === 'activated'){
                                             if(empty($array4)){
                                             echo '<div class="'.$activated.' cls item"><a href="/'.$namespace.'"
                                                   title="'.$data->xuat_xu.'"><i
                                                      class="icon_v1 "></i>'.$data->xuat_xu.'</a></div>';
                                             }else{
                                             echo '<div class="'.$activated.' cls item"><a
                                                   href="/'.$namespace.'/?feature='.$array4.'"
                                                   title="'.$data->xuat_xu.'"><i
                                                      class="icon_v1 "></i>'.$data->xuat_xu.'</a></div>';
                                             }
                                             }else{
                                             echo '<div class="'.$activated.' cls item"><a
                                                   href="/'.$namespace.'/?feature='.$feature.''.$comma.''.$data->slug.'"
                                                   title="'.$data->xuat_xu.'"><i
                                                      class="icon_v1 "></i>'.$data->xuat_xu.'</a></div>';
                                             }
                                             }
                                             @endphp
                                       </div>
                                    </div>
                                 </div>
                                 <div class="field_area field_item" id="m-kich_thuoc">
                                    <div class="field_name normal field field_opened " data-id="id_field_kich_thuoc">
                                       Kích thước</div>
                                    <div id="kich_thuoc"
                                       class="field_label filters_in_field filters_in_field_2_column filter_4_kich_thuoc">
                                       <div class="filters_in_field_inner cls">
                                          <span class="close">
                                             <svg height="10px" viewBox="0 0 64 64" enable-background="new 0 0 64 64">
                                                <g>
                                                   <path fill="#4e4b4b"
                                                      d="M28.941,31.786L0.613,60.114c-0.787,0.787-0.787,2.062,0,2.849c0.393,0.394,0.909,0.59,1.424,0.59 c0.516,0,1.031-0.196,1.424-0.59l28.541-28.541l28.541,28.541c0.394,0.394,0.909,0.59,1.424,0.59c0.515,0,1.031-0.196,1.424-0.59 c0.787-0.787,0.787-2.062,0-2.849L35.064,31.786L63.41,3.438c0.787-0.787,0.787-2.062,0-2.849c-0.787-0.786-2.062-0.786-2.848,0 L32.003,29.15L3.441,0.59c-0.787-0.786-2.061-0.786-2.848,0c-0.787,0.787-0.787,2.062,0,2.849L28.941,31.786z">
                                                   </path>
                                                </g>
                                             </svg>
                                          </span>
                                          @foreach($kich_thuoc as $data)
                                          <div class="cls item"><a href="#" title="{{$data->kich_thuoc}}"><i
                                                   class="icon_v1 "></i>{{$data->kich_thuoc}}</a></div>
                                          @endforeach
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="clear"></div>
               </div>
            </div>

         </div>
         <article class="cat_summary cls">
            <li class="cat_soon"><a href="https://vugiaphat.vn/bon-tam-dung-pc8.html" title="Bồn tắm đứng ">Bồn tắm
                  đứng</a></li>
            <li class="cat_soon"><a href="https://vugiaphat.vn/bon-tam-nam-pc9.html" title="Bồn tắm nằm ">Bồn tắm
                  nằm</a></li>
            <li class="cat_soon"><a href="https://vugiaphat.vn/bon-tam-goc-pc10.html" title="Bồn tắm góc ">Bồn tắm
                  góc</a></li>
            <li class="cat_soon"><a href="https://vugiaphat.vn/bon-tam-xay-pc11.html" title="Bồn tắm xây ">Bồn tắm
                  xây</a></li>
            <li class="cat_soon"><a href="https://vugiaphat.vn/phu-kien-bon-tam-pc20.html" title="Phụ kiện bồn tắm ">Phụ
                  kiện bồn tắm</a></li>
            <li class="cat_soon"><a href="https://vugiaphat.vn/thiet-bi-be-boi-pc22.html" title="Thiết bị bể bơi ">Thiết
                  bị bể bơi</a></li>
         </article>
         <section class="products-cat-frame">
            <div class="products-cat-frame-inner descriptions">
               <article class="cat_summary cls">
                  <div class="banner_cat_summary">
                     <div class="block_banners banners-_banner banners_0 block" id="block_id_103"></div>
                  </div>
                  <div class="summary_content">
                     <p><strong>Bồn tắm, bồn tắm massage, bồn tắm đứng, nằm góc&nbsp;</strong>cao cấp tại Vũ Gia Phát
                        được lựa chọn từ các thương hiệu hàng đầu Châu Âu và Việt Nam. Tất cả các sản phẩm <strong>Bồn
                           tắm</strong> tại Vũ Gia Phát cung cấp trước khi xuất xưởng đã trải qua các công đoạn&nbsp;thử
                        nghiệm về chất lượng và độ bền bằng những máy móc, thiết bị&nbsp;tiên tiến nhất dưới bàn tay của
                        những kỹ sư hàng đầu.</p>
                     <p><strong>Thương hiệu:</strong> Tại <strong>Vũ Gia Phát</strong> cung cấp các thương hiệu nhập
                        khẩu hàng đầu như <strong>Nofer, Euroking, Daros, Kawa, Sara</strong> và các thương hiệu sản
                        xuất tại Việt Nam có thương hiệu lớn như <strong>Amazon, Euroca, Milano, Fantiny</strong> ... vv
                        Cam kết mang tới tay khách hàng sản phẩm chất lượng kèm dịch vụ hỗ trợ vận chuyển và lắp đặt
                        miễn phí tại Hà Nội và Hồ Chí Minh.</p>
                     <p><strong>Chế độ bảo hành :</strong>&nbsp;Tất cả các sản phẩm bồn tắm nằm được bảo hành từ 2
                        đến 5 năm&nbsp;tại nhà tuỳ vào từng thương hiệu&nbsp;trên toàn bộ hệ thống siêu thị Vũ Gia Phát.
                        Chúng tôi là đại lý phân phối bồn tắm nằm&nbsp;chính hãng tại Việt Nam. Chúng tôi cam kết về
                        chất lượng và giá là tốt nhất.</p>
                  </div>
               </article>
               <div class="product_grid">
                  @if($product->isEmpty())
                  <h1 class="text-center" style="width:100%">Không có dữ liệu</h1>
                  @else
                  @foreach($product as $data)
                  <div class="item" itemscope="" itemtype="http://schema.org/Product">
                     <div class="frame_inner">
                        <link itemprop="url"
                           href="https://vugiaphat.vn/bon-tam-nam/von-tam-nam-amazon-tp-7002-p1429.html">
                        <figure class="product_image ">
                           <a href="https://vugiaphat.vn/bon-tam-nam/von-tam-nam-amazon-tp-7002-p1429.html"
                              title="Bồn tắm nằm Amazon TP-7002" itemprop="url"><img itemprop="image"
                                 alt="Bồn tắm nằm Amazon TP-7002"
                                 src="{{url('image/product/small/'.$data->anh_sp)}}"></a>
                           <div class="button_area"><a href="javascript:void(0)" onclick="add_cart(1429,1)"
                                 class="add_cart"><i></i></a><a
                                 href="https://vugiaphat.vn/bon-tam-nam/von-tam-nam-amazon-tp-7002-p1429.html"
                                 class="detail_button" title="Chi tiết sản phẩm"><i></i></a></div>
                        </figure>
                        <h2 itemprop="name"><a
                              href="https://vugiaphat.vn/bon-tam-nam/von-tam-nam-amazon-tp-7002-p1429.html"
                              title="Bồn tắm nằm Amazon TP-7002" class="name">{{$data->ten_sp}}</a> </h2>
                        <div class="discount"><span>-{{100-ceil(($data->sale_price/ $data->gia_goc)*100)}}%</span></div>
                        <div class="price_arae" itemscope="" itemtype="http://schema.org/Offer">
                           <div class="price_current" itemprop="price">{{number_format($data->sale_price,0,".",".")}}₫
                           </div>
                           <div class="price_old"><span>{{number_format($data->gia_goc,0,".",".")}}₫</span></div>
                        </div>
                        <div class="origin">Xuất xứ: {{$data->xuat_xu}}</div>
                        <div class="size">Kích thước: {{$data->kich_thuoc_sp}}</div>
                     </div>
                     <!-- end .frame_inner -->
                     <div class="clear"></div>
                  </div>
                  @endforeach
                  @endif
                  <div class="clear"></div>
               </div>
               <!--end: .vertical-->
            </div>
         </section>
         <div class="pagination">
            @if($product->isEmpty())

            @else

            {{$product->links('vendor.pagination.bootstrap-4')}}
            @endif
         </div>
      </div>
   </div>
</div>
@include('block/hot_news')

@include('block/footer')