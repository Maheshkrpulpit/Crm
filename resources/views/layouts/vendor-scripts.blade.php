<script type="text/javascript">
  const APP_URL_FOR_SCRIPT='{{url("/")}}';
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{ URL::asset('assets/libs/bootstrap/bootstrap.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/node-waves/node-waves.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/feather-icons/feather-icons.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/plugins/lord-icon-2.1.0.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/plugins.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/common.js') }}"></script>

<script>
    function submitform(lang_code){
        //console.log(lang_code);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url : "{{ route('settings.general_save') }}",
            data : {'default_language' : lang_code},
            type : 'POST',
            dataType : 'json',
            success : function(result){
                if(result.success){
                    window.location.reload();
                }
            }
        });
    }
</script>
<script type="text/javascript">
  const THEME_SETTING_URL='{{route("settings.theme.setting")}}';
  //let customizer=$('');

  //$(document).on('change','[name^="data-layout"],[name="data-topbar"],[name="data-sidebar"]',function(){
  $(document).on('change','#theme-settings-offcanvas',function(){
      updateThemeSettings();
  })

  var updateNotifications=function(){
    var selectedNotifications=[];
    $('.topNotifications').each(function(){
      if($(this).prop('checked')){
        selectedNotifications.push($(this).val());
      }
    })
    {{--__postRequest('{{route("office.notification.read")}}',{'notifications':selectedNotifications},showSmallMessage);--}} 
  }
</script>

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="{{ URL::asset('/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- <script src="{{ URL::asset('assets/js/pages/datatables.init.js') }}"></script> -->

<!-- Modern colorpicker bundle -->
<script src="{{asset('assets/libs/@simonwep/pickr/pickr.min.js')}}"></script>

<!-- init js -->
<script src="{{asset('assets/js/pages/form-pickers.init.js')}}"></script>
<script src="{{ URL::asset('/assets/js/app.js') }}"></script>
<script src="{{ asset('vendor/datatables/buttons.server-side.js')}}" defer></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>
@yield('script')
@yield('script-bottom')