<script type="text/javascript">
    $(document).ready(function() {
        $(document).on('click','.toggle_switch_chk', function(){
            var status = $(this).val();
            var flag = true;
            if($(this).prop('checked')){
                flag = false;
            }
            var statusUrl = $(this).data('href');
            Swal.fire({
                    title: "{{trans('Are you sure?')}}",
                    text: "{{ trans('Do you want to change status ?')}}",
                    icon: "warning",
                    showDenyButton: true,  
                    showCancelButton: false,  
                    confirmButtonText: `Yes, I am sure`,  
                    denyButtonText: `No, cancel it!`,
            })
            .then(function(result) {
                if (result.isConfirmed) {  
                    $.ajax({
                        type: 'PUT',
                        url: statusUrl,
                        dataType: 'json',
                        data: {status: status },
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        success: function (response) {
                            if(response.status == 'true') {
                                fireSuccessSwal('Success',response.message);
                                $('#ajaxData_table').DataTable().ajax.reload(null, false);
                            }
                        },
                        error:function (response){
                            $this.prop('checked', flag);
                            Swal.fire({
                                title: 'Error', 
                                text: 'Something Went wrong!', 
                                type: "Error",
                                icon: "warning",
                                confirmButtonText: "Okay",
                                confirmButtonColor: "#04a9f5"
                            });
                        }
                    });
                }
                else {
                    $this.prop('checked', flag);
                }
            });
        });

    // Create new record
    
        $(document).on('submit', '#addRecordForm', function (e) {
        e.preventDefault();
        $('.validation-error-block').remove();
        $(".addSubmit").attr('disabled', true);
        $('#preloader').css('display', 'flex');

        // Create a FormData object to include file data
        var formData = new FormData(this);

        $.ajax({
            type: 'post',
            url: '', // Specify the URL where you want to send the form data
            processData: false, // Prevent jQuery from processing data
            contentType: false, // Prevent jQuery from setting content type
            data: formData,
            success: function (response) {
                $(".addSubmit").attr('disabled', false);
                if (response.success) {
                    $('#addRecordModals').modal('hide');
                    fireSuccessSwal('Success', response.message);
                    $('#ajaxData_table').DataTable().ajax.reload(null, false);
                    $('#preloader').css('display', 'none');
                } else {
                    var errorLabelTitle = '';
                    $.each(response.error, function (key, item) {
                        errorLabelTitle = '<span class="validation-error-block d-block">' + item + '</sapn>';
                        $(errorLabelTitle).insertAfter("input[name='" + key + "']");
                    });
                    $('#preloader').css('display', 'none');
                }
                }
            });
        });


        // Update record
        $(document).on('submit', '#updateRecordForm', function (e) {
            e.preventDefault();
            $('.validation-error-block').remove();
            $(".updateButton").attr('disabled', true);
            $('#preloader').css('display', 'flex');

            var formData = new FormData(this); // Use FormData to include file data
            var hrefUrl = $(this).attr('action');

            $.ajax({
                type: 'post',
                url: hrefUrl,
                dataType: 'json',
                data: formData,
                processData: false, // Prevent jQuery from processing the data
                contentType: false, // Set content type to false to prevent jQuery from adding a content-type header
                success: function (response) {
                    $(".updateButton").attr('disabled', false);
                    if (response.success) {
                        $('#editRecordModals').modal('hide');
                        fireSuccessSwal('Success', response.message);
                        $('#ajaxData_table').DataTable().ajax.reload(null, false);
                        $('#preloader').css('display', 'none');
                    } else {
                        var errorLabelTitle = '';
                        $.each(response.error, function (key, item) {
                            errorLabelTitle = '<span class="validation-error-block d-block">' + item + '</span>';
                            $(errorLabelTitle).insertAfter("input[name='" + key + "']");
                        });
                        $('#preloader').css('display', 'none');
                    }
                }
            });
        });


        // Create form
        $(document).on('click','.addRecordBtn', function(){
            $('#preloader').css('display', 'flex');
            var hrefUrl = $(this).attr('data-href');
            $.ajax({
                type: 'get',
                url: hrefUrl,
                dataType: 'json',
                success: function (response) {
                    $('#preloader').css('display', 'none');
                    if(response.success) {
                        $('.popup_render_div').html(response.htmlView);
                        $('#addRecordModals').modal('show');
                    }
                }
            });
        });

        // Edit form
        $(document).on('click','.editRecordBtn', function(){
            $('#preloader').css('display', 'flex');
            var hrefUrl = $(this).attr('data-href');
            $.ajax({
                type: 'get',
                url: hrefUrl,
                dataType: 'json',
                success: function (response) {
                    $('#preloader').css('display', 'none');
                    if(response.success) {
                        $('.popup_render_div').html(response.htmlView);
                        $('#editRecordModals').modal('show');
                    }
                }
            });
        });

        // Delete record
        $(document).on('click','.deleteRecordBtn', function(e){
            e.preventDefault();
            $('#preloader').css('display', 'flex');               
            var deleteUrl = $(this).data('href');

            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonClass: 'btn btn-primary w-xs me-2 mt-2',
                cancelButtonClass: 'btn btn-danger w-xs mt-2',
                confirmButtonText: "Yes, delete it!",
                buttonsStyling: false,
                showCloseButton: true
            }).then(function(willDelete) {
                if (willDelete.value) {
                    $.ajax({
                        type: 'DELETE',
                        url: deleteUrl,
                        dataType: 'json',
                        data: {},
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        success: function (response) {
                            if(response.success == true) {
                                fireSuccessSwal('Success',response.message);
                                $('#ajaxData_table').DataTable().ajax.reload(null, false);
                            }
                            else {                        
                                fireErrorSwal('Error',response.message);
                            }
                        }
                    });
                }
            });
        });
          // Search Fillters
        $("#searchTableInput").keyup(function () {
            // Apply status filters based on the selected values
            var searchTerm = $(this).val();
            if (searchTerm) {
                $('#ajaxData_table').DataTable().search(searchTerm).draw();
            }
        });  
    });
    
  
</script>