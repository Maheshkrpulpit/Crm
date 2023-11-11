@yield('css')
<!-- Layout config Js -->
<script type="text/javascript">
    var attributesValue1= document.documentElement.attributes;

    var CurrentLayoutAttributes1 = {};
    Object.entries(attributesValue1).forEach(function(key) {
        if (key[1] && key[1].nodeName && key[1].nodeName != "undefined") {
            var nodeKey = key[1].nodeName;
            CurrentLayoutAttributes1[nodeKey] = key[1].nodeValue;
        }
      });
    @if(isset($themeConfigs) &&!empty($themeConfigs) && !session('isThemeSet'))
        @foreach($themeConfigs as $key => $value)
            sessionStorage.setItem('{{$key}}','{{$value}}');
        @endforeach

        @php 
            session(['isThemeSet'=>1]) 
        @endphp
    @endif
</script>

<script src="{{ URL::asset('assets/js/layout.js') }}"></script>
<!-- Bootstrap Css -->
<link href="{{ URL::asset('assets/css/bootstrap.min.css') }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
<!-- Icons Css -->
<link href="{{ URL::asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
<!-- App Css-->
<link href="{{ URL::asset('assets/css/app.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />

<!-- Sweet Alert Css-->
<link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

<!-- dropzone css -->
<link rel="stylesheet" href="assets/libs/dropzone/dropzone.css" type="text/css" />

<!-- Sweet Alert css-->
<link href="assets/libs/sweetalert2/sweetalert2.min.css" rel="stylesheet" type="text/css" />
<!-- custom Css-->
<link href="{{ URL::asset('assets/css/custom.css') }}" id="app-style" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/css/custom.min.css') }}" id="app-style" rel="stylesheet" type="text/css" />
<style type="text/css">
    .dataTables_filter {
        display: none;
    }
    .table-responsive {
        overflow-x: hidden;
    }

    .was-validated .custom-select:invalid + .select2 .select2-selection{
        border-color: #dc3545!important;
    }
    .was-validated .custom-select:valid + .select2 .select2-selection{
        border-color: #28a745!important;
    }
    *:focus{
      outline:0px;
    }
    .tbody, td, tfoot, th, thead, tr {
  border-color: inherit;
  border-style: solid;
  border-width: 0;
  font-size: 13px;
}
</style>

<!--datatable css-->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- One of the following themes -->
<link rel="stylesheet" href="{{asset('assets/libs/@simonwep/pickr/themes/classic.min.css')}}" /> <!-- 'classic' theme -->
<link rel="stylesheet" href="{{asset('assets/libs/@simonwep/pickr/themes/monolith.min.css')}}" /> <!-- 'monolith' theme -->
<link rel="stylesheet" href="{{asset('assets/libs/@simonwep/pickr/themes/nano.min.css')}}" /> <!-- 'nano' theme -->
 <!--datatable css-->
 <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" />
 <!--datatable responsive css-->
 <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" />

 <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
