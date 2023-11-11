<div class="mb-3">
    {!! Form::label('name', trans('Name'), array('class' => 'form-label')); !!}
    {!! Form::text ('name',old('name',null), ['id'=>'name','class' => 'form-control','required' =>true, 'placeholder' => trans('Enter Name')]) !!}  
</div>
<div class="mb-3">
    {!! Form::label('attach_document', trans('Logo'), array('class' => 'form-label')); !!}
    {!! Form::file('attach_document', ['id'=>'attach_document','class' => 'form-control','required' =>isset($brand) && $brand->attach_document ? false : true,]) !!} 
</div>
@if(!empty($brand))
    <div class="mb-3">
        <div class="text-center">
            <img src="{{$brand->attach_document}}" class="rounded-3" style="height: 150px;
                width: 250px;" alt="Avatar" />
        </div>
    </div>
@endif
<div class="mb-3">
    <div class="form-check form-switch form-switch-lg" dir="ltr">
        {!! Form::label('customSwitchsizelg', trans('Status'), array('class' => 'form-check-label')); !!}
        {!! Form::checkbox('status',true,old('status',isset($brand) && $brand->status ?  true : false),['id'=>'customSwitchsizelg','class' => 'form-check-input']) !!} 
    </div>
</div>

