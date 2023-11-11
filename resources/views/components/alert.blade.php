
@if(isset($response['success']) && $response['success']==1)
<!-- Success Alert -->

<div class="alert alert-success alert-dismissible alert-label-icon rounded-label fade show" role="alert">
<i class="ri-notification-off-line label-icon"></i><strong>{{$response['msg']??''}}</strong>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@elseif(isset($response['success']))

<!-- Danger Alert -->
<div class="alert alert-danger alert-dismissible alert-label-icon rounded-label fade show" role="alert">
<i class="ri-error-warning-line label-icon"></i><strong>{{$response['msg']??''}}</strong>
<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

@endif