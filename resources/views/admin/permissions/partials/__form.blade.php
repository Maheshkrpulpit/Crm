<div class="col-12">
    <div class="mb-3">
        {!! Form::label('name', trans('Name'), array('class' => 'form-label')); !!}
        {!! Form::text('name',old('name',null), ['id'=>'name','class' => 'form-control','required' =>true, 'placeholder' => trans('Enter name')]) !!}                                    
    </div>
</div>