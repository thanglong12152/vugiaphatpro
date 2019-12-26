 //Sweet alert
 $('.deleteProduct').click(function(){
    var id = $(this).attr('rel');
    var deleteProduct = $(this).attr('rel1');
    swal({
        title: 'Bạn chắc chắn muốn xóa sản phẩm này ?',
        text: 'Bạn sẽ không thể khôi phục',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Xóa',
        cancelButtonText: 'Thoát',
        confirmButtonClass: 'btn btn-success',
        cancelButtonClass: 'btn btn-danger',
        buttonsStyling: false,
        reverseButtons:true
    }),
    function(){
        window.location.href="/admin/"+deleteProduct+"/"+id;
    }
});
