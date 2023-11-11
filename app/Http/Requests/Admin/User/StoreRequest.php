<?php

namespace App\Http\Requests\Admin\User;

use Gate;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\JsonRequest;

class StoreRequest extends JsonRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('user.create'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return true;
    }


    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:191'
            ],
            'email' => [
                'required',
                'email',
                'max:191',
                'unique:App\Models\User,email,NULL,id',
            ],
            'username' => [
                'required',
                'string',
                'max:191',
                'unique:App\Models\User,username,NULL,id',
            ],
            'phone' => 'required|numeric',
            'roles' => 'required',
            'department_id'=>'nullable',
            'password' => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
            'status' => 'nullable|in:1,0'
        ];

    }
}
