 //Validation admin
 $("#inputCurrentPassword").keyup(function(){
    var current_pwd = $("#inputCurrentPassword").val();
    // alert(current_pwd);
    $.ajax({
        type:'get',
        url:'check-password',
        data:{current_pwd:current_pwd},
        success:function(resp){
             //alert(resp);
            if(resp=="false"){
                $("#checkpass").html("<font color='red'>Current Password is Incorrect</font>");
            }
            else if(resp=="true"){
                $("#checkpass").html("<font color='green'>Current Password is Correct</font>");
            }
        },
        error:function(){
            alert("Error");
        }
    });
 });

$("#keyword").keyup(function(){
  var key_search = $("#keyword").val();
  $.ajax({
      type:'get',
      url:'search/product',
      data:{key_search:key_search},
      success:function(resp){
        // alert('OK');
        alert(resp);
      },
      error:function(){
        alert('Error');
      }

  });
});


$(document).on("change","#productType",function(){
  var productType = $("#productType").val();

  $.ajax({
    type:'get',
    url:'check-product',
    data:{productType:productType},
    success: function (resp){
      //alert(resp);
      if(resp==="Bồn tắm"){
        $('.name_prod').show();
        $('.ma_sp').show();
        $('.gia_sp').show();
        $('.sale_price').show();
        $('.max_people').hide();
        $('.cong_suat_may').hide();
       
        $('.dien_nang').hide();
        $('.ong_cap_nuoc').hide();
        $('.day_dien').hide();
        $('.kieu_dang').hide();
        $('.loai_den').hide();
        $('.mau_sac').hide();
        $('.sai_canh').hide();
        $('.dong_co').hide();
        $('.cong_suat_den').hide();
        $('.kich_thuoc').show();
        $('.thuong_hieu').show();
        $('.chat_lieu').show();
        $('.xuat_xu').show();
        $('.thiet_ke').show();
        $('.thoi_gian_bh').show();
        $('.chuc_nang').show();
        $('.phu_kien_di_kem').show();
        $('.anh_sp').show();
      }
      else if(resp==="Máy xông hơi"){
        $('.name_prod').show();
        $('.ma_sp').show();
        $('.gia_sp').show();
        $('.sale_price').show();
        $('.max_people').hide();
        $('.cong_suat_may').show();
       
        $('.dien_nang').show();
        $('.ong_cap_nuoc').show();
        $('.day_dien').show();
        $('.kieu_dang').hide();
        $('.loai_den').hide();
        $('.mau_sac').hide();
        $('.sai_canh').hide();
        $('.dong_co').hide();
        $('.cong_suat_den').hide();
        $('.kich_thuoc').show();
        $('.thuong_hieu').show();
        $('.chat_lieu').hide();
        $('.xuat_xu').show();
        $('.thiet_ke').hide();
        $('.thoi_gian_bh').show();
        $('.chuc_nang').hide();
        $('.phu_kien_di_kem').show();
        $('.anh_sp').show();
      }
      else if(resp==="Phòng xông hơi"){
        $('.name_prod').show();
        $('.ma_sp').show();
        $('.gia_sp').show();
        $('.sale_price').show();
        $('.max_people').show();
        $('.cong_suat_may').show();
        
        $('.dien_nang').hide();
        $('.ong_cap_nuoc').hide();
        $('.day_dien').hide();
        $('.kieu_dang').hide();
        $('.loai_den').hide();
        $('.mau_sac').hide();
        $('.sai_canh').hide();
        $('.dong_co').hide();
        $('.cong_suat_den').hide();
        $('.kich_thuoc').show();
        $('.thuong_hieu').show();
        $('.chat_lieu').show();
        $('.xuat_xu').show();
        $('.thiet_ke').show();
        $('.thoi_gian_bh').show();
        $('.chuc_nang').show();
        $('.phu_kien_di_kem').show();
        $('.anh_sp').show();
      }
      else if(resp==="Quạt đèn trần"){
        $('.name_prod').show();
        $('.ma_sp').show();
        $('.gia_sp').show();
        $('.sale_price').show();
        $('.max_people').hide();
        $('.cong_suat_may').hide();
        
        $('.dien_nang').hide();
        $('.ong_cap_nuoc').hide();
        $('.day_dien').hide();
        $('.kieu_dang').show();
        $('.loai_den').show();
        $('.mau_sac').show();
        $('.sai_canh').show();
        $('.dong_co').show();
        $('.cong_suat_den').show();
        $('.kich_thuoc').hide();
        $('.thuong_hieu').hide();
        $('.chat_lieu').show();
        $('.xuat_xu').hide();
        $('.thiet_ke').hide();
        $('.thoi_gian_bh').hide();
        $('.chuc_nang').hide();
        $('.phu_kien_di_kem').hide();
        $('.anh_sp').hide();
      }
      
    },
    error:function(){
      alert('Error');
    }
  });
});

$(document).on("change","#productType_s",function(){
  var productType_s = $("#productType_s").val();
  $.ajax({
    type:'get',
    url:'filter',
    data:{productType_s:productType_s},
    success: function (resp){
      //alert(resp);
     
      $('#productType_Child').replaceWith(resp);
      

    },
    error:function(){
      alert('Error');
    }
  });
});

$(document).on("change","#productType",function(){
  var productType_s = $("#productType").val();
  $.ajax({
    type:'get',
    url:'filter',
    data:{productType_s:productType_s},
    success: function (resp){
      //alert(resp);
     
      $('#productType_Child').replaceWith(resp);
      

    },
    error:function(){
      alert('Error');
    }
  });
});

 $('.deleteProduct').click(function(){
    var id = $(this).attr('rel');
    var deleteProduct = $(this).attr('rel1');
    swal({
        title: "Bạn chắc chứ ?",
        text: "Bạn sẽ không thể khôi phục sản phẩm",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Đồng ý",
        cancelButtonText: "Hủy bỏ",
        closeOnConfirm: false,
        closeOnCancel: false
      },
      function(isConfirm) {
        if (isConfirm) {
          swal("Deleted!", "Xóa sản phẩm thành công ! Vui lòng đợi 1 lát", "success");
          window.location.href="/admin/product/"+deleteProduct+"/"+id;
        } else {
          swal("Cancelled", "Đã hủy", "error");
        }
      });
});
