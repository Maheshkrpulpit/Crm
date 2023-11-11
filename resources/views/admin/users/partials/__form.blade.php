<div class="col-6">
    <div class="mb-3">
        {!! Form::label('name', trans('Name'), array('class' => 'form-label')); !!}
        {!! Form::text('name',old('name',null), ['id'=>'name','class' => 'form-control','required' =>true, 'placeholder' => trans('Enter name')]) !!}                                    
    </div>
</div>

<div class="col-6">
    <div class="mb-3">
        {!! Form::label('username', trans('Username'), array('class' => 'form-label')); !!}
        {!! Form::text('username',old('username',null), ['id'=>'username','class' => 'form-control','required' =>true, 'placeholder' => trans('Enter user name')]) !!}                                    
    </div>
</div>

<div class="col-6">
    <div class="mb-3">
        {!! Form::label('email', trans('Email'), array('class' => 'form-label')); !!}
        {!! Form::email('email',old('email',null), ['id'=>'email','class' => 'form-control','required' =>true, 'placeholder' => trans('Enter email')]) !!}                                    
    </div>
</div>

<div class="col-6">
    <div class="mb-3">
        {!! Form::label('phone', trans('Phone Number'), array('class' => 'form-label')); !!}
        {!! Form::text('phone',old('phone',null), ['id'=>'phone','class' => 'form-control','required' =>true, 'placeholder' => trans('Enter phone number')]) !!}                                    
    </div>
</div>

<div class="col-12">
    <div class="mb-3">
        {!! Form::label('roles', trans('Role'), array('class' => 'form-label')); !!}        
        {!! Form::select('roles', $roles, isset($user->roles)? $user->roles : null, ['class' => 'form-control select2', 'placeholder' => trans('Select role')]) !!}
    </div>
</div>
<div class="col-12">
    <div class="mb-3">
        {!! Form::label('department_id', trans('Department'), array('class' => 'form-label')); !!}        
        {!! Form::select('department_id', $department, isset($user) ? $user->department_id : null, ['class' => 'form-control select2', 'placeholder' => trans('Select Department')]) !!}
    </div>
</div>

<div class="col-6">
    <div class="mb-3">
        {!! Form::label('new-password', trans('Password'), array('class' => 'form-label')); !!}
        {!! Form::password('password',['id'=>'new-password','class' => 'form-control','required' =>false, 'placeholder' => trans('Enter password')]) !!}       
    </div>
</div>

<div class="col-6">
    <div class="mb-3">
        {!! Form::label('password_confirmation', trans('Confirm Password'), array('class' => 'form-label')); !!}
        {!! Form::password('password_confirmation',['id'=>'password_confirmation','class' => 'form-control','required' =>false, 'placeholder' => trans('Enter confirm password')]) !!}       
    </div>
</div>

<div class="col-12">
    <div class="mb-3">
        <div class="form-check form-switch form-switch-lg" dir="ltr">
            {!! Form::label('customSwitchsizelg', trans('Status'), array('class' => 'form-check-label')); !!}
            {!! Form::checkbox('status',true,old('status',isset($user) && $user->status ?  true : false),['id'=>'customSwitchsizelg','class' => 'form-check-input']) !!} 
        </div>
    </div>
</div>