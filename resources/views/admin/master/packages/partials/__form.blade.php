<div class="mb-3">
    {!! Form::label('name', trans('Name'), array('class' => 'form-label')); !!}
    {!! Form::text ('name',old('name',null), ['id'=>'name','class' => 'form-control','required' =>true, 'placeholder' => trans('Enter Name')]) !!}  
</div>
<div class="mb-3">
    {!! Form::label('amount', trans('Amount'), array('class' => 'form-label')); !!}
    {!! Form::number ('amount',old('amount',null), ['id'=>'amount','class' => 'form-control','required' =>true, 'placeholder' => trans('Enter Amount')]) !!}  
</div>
<div class="mb-3">
    {!! Form::label('comission', trans('Comission'), array('class' => 'form-label')); !!}
    {!! Form::number ('comission',old('comission',null), ['id'=>'comission','class' => 'form-control','required' =>true, 'placeholder' => trans('Enter Comission')]) !!}  
</div>
<div class="mb-3">
    {!! Form::label('brand_id', trans('Brand'), array('class' => 'form-label')); !!}
    {!! Form::select ('brand_id',$brands,old('brand_id',null), ['id'=>'brand_id','class' => 'form-control','required' =>true, 'placeholder' => trans('Select Brand')]) !!}  
</div>
<div class="mb-3">
    <div class="form-check form-switch form-switch-lg" dir="ltr">
        {!! Form::label('customSwitchsizelg', trans('Status'), array('class' => 'form-check-label')); !!}
        {!! Form::checkbox('status',true,old('status',isset($package) && $package->status ?  true : false),['id'=>'customSwitchsizelg','class' => 'form-check-input']) !!} 
    </div>
</div>

