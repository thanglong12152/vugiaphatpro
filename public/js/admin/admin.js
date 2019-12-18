 //Validation admin
 $("#inputCurrentPassword").keyup(function(){
    var current_pwd = $("#inputCurrentPassword").val();
    // alert(current_pwd);
    $.ajax({
        type:'get',
        url:'check-password',
        data:{current_pwd:current_pwd},
        success:function(resp){
            // alert(resp);
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
