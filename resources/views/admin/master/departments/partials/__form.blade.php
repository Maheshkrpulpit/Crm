<div class="mb-3">
    {!! Form::label('name', trans('Name'), array('class' => 'form-label')); !!}
    {!! Form::text ('name',old('name',null), ['id'=>'name','class' => 'form-control','required' =>true, 'placeholder' => trans('Enter Name')]) !!}  
</div>
<div class="mb-3">
    {!! Form::label('code', trans('Code'), array('class' => 'form-label')); !!}
    {!! Form::text ('code',old('code',null), ['id'=>'code','class' => 'form-control','required' =>true, 'placeholder' => trans('Enter Code')]) !!}  
</div>

<div class="mb-3">
    <div class="form-check form-switch form-switch-lg" dir="ltr">
        {!! Form::label('customSwitchsizelg', trans('Status'), array('class' => 'form-check-label')); !!}
        {!! Form::checkbox('status',true,old('status',isset($department) && $department->status ?  true : false),['id'=>'customSwitchsizelg','class' => 'form-check-input']) !!} 
    </div>
</div>

