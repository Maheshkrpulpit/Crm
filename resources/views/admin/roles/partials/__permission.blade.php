<div class="col-lg-12 col-sm-12">
    <!-- Accordions with Plus Icon -->
    <div class="accordion custom-accordionwithicon-plus" id="permission">
        @foreach($permissions as $group => $groupPermissions)
            <div class="accordion-item">
                <h2 class="display-inline box-plus-panel" id="accordionwithplusExample{{ $loop->index }}">
                    <button class="accordion-button" type="button"
                            data-bs-toggle="collapse"
                            data-bs-target="#{{ $group }}_{{ $loop->index }}"
                            aria-expanded="true"
                            aria-controls="{{ $group }}_{{ $loop->index }}">
                        {{ strtoupper(str_replace('_', ' ', $group)) }}
                    </button>
                </h2>

                <div id="{{ $group }}_{{ $loop->index }}" class="accordion-collapse collapse show" aria-labelledby="accordionwithplusExample{{ $loop->index }}">
                    
                    <div class="accordion-body">
                        <div class="row {{ $group }}">
                            <div class="col-lg-2 col-md-6 col-sm-12">
                                <div class="form-check form-check-outline form-check-dark mb-3">
                                    <input class="btn-check check_group" type="checkbox" id="{{ $group }}" data-group="{{ $group }} ">
                                    <label class="btn btn-light btn-sm" for="{{ $group }}">
                                        @lang('Select all')
                                    </label>
                                </div>
                            </div>
                            @foreach($groupPermissions as $permission_id => $permission)
                                <div class="col-lg-2 col-md-6 col-sm-12">
                                    <div class="form-check form-check-outline form-check-primary mb-3">
                                        {!! Form::checkbox('permissions[]',$permission_id, (isset($roleAssignPermissions) && array_key_exists($permission_id, $roleAssignPermissions) ?  true : false),['id'=>$group.'_'.$permission,'class' => 'form-check-input '.$group]) !!} 
                                        {!! Form::label($group.'_'.$permission, trans($permission), array('class' => 'form-check-label')); !!}                                        
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>


@section('script')
  <script type="text/javascript">
    $(document).ready(function(){
        /*$('.check_group').on('change', function () {
            const $parentDiv = $(this).closest('.row');
            
            if ($(this).is(':checked')) {
                $parentDiv.addClass('active'); // Add the 'active' class to the parent div
            } else {
                $parentDiv.removeClass('active'); // Remove the 'active' class from the parent div
            }
        });*/

      $(document).on('change','.check_group',function(){
        console.log("check_group");



        var className = $(this).data('group');
        if($(this).prop('checked')){
            console.log(className,'checked');
            $(this).closest('.'+className).find('input').prop('checked',true);
        }else{
            console.log(className,'not checked checked');
            $(this).closest('.'+className).find('input').prop('checked',false);
        }
      })
    });
  </script>
@endsection