<div class="card-header d-flex align-items-center">
     @if(empty($header))
        @if(!empty($title) || !empty($tool))
                <h5 class="card-title mb-0 flex-grow-1">{{ $title ?? '' }}</h5>
                <div>
                      {!!$tool ?? ''!!}
                </div>

                @else
        
            {!! $header !!}
       
    @endif
    @endif
            </div>