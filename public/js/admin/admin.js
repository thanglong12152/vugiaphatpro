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
$(document).on("change","#productType",function(){
  var productType = $("#productType").val();

  $.ajax({
    type:'get',
    url:'check-product',
    data:{productType:productType},
    success: function (resp){
      //alert(resp);
      if(resp==="Bồn tắm"){
        $('.phong-xong-hoi').hide();
        $('.may-xong-hoi').hide();
        $('.quat-den-tran').hide();
        $('.cong_suat_may').hide();
        $('.chat_lieu').show();
        $('.kich_thuoc').show();
        $('.thuong_hieu').show();
        $('.thiet_ke').show();
        $('.thoi_gian_bh').show();
        $('.chuc_nang').show();
        $('.phu_kien_di_kem').show();
      }
      else if(resp==="Máy xông hơi"){
        $('.cong_suat_may').show();
        $('.may-xong-hoi').show();
        $('.phong-xong-hoi').hide();
        $('.quat-den-tran').hide();
        $('.chat_lieu').hide();
        $('.thiet_ke').hide();
        $('.chuc_nang').hide();
        $('.quat-den-tran').hide();
      }
      else if(resp==="Phòng xông hơi"){
        $('.phong-xong-hoi').show();
        $('.cong_suat_may').show();
        $('.may-xong-hoi').hide();
        $('.quat-den-tran').hide();
        $('.chat_lieu').show();
        $('.kich_thuoc').show();
        $('.thuong_hieu').show();
        $('.thiet_ke').show();
        $('.thoi_gian_bh').show();
        $('.chuc_nang').show();
        $('.phu_kien_di_kem').show();
      }
      else if(resp==="Quạt đèn trần"){
        $('.phong-xong-hoi').hide();
        $('.cong_suat_may').hide();
        $('.may-xong-hoi').hide();
        $('.quat-den-tran').show();
        $('.kich_thuoc').hide();
        $('.thuong_hieu').hide();
        $('.thiet_ke').hide();
        $('.thoi_gian_bh').hide();
        $('.chuc_nang').hide();
        $('.phu_kien_di_kem').hide();
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
