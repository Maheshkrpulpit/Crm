<?php

namespace App\Http\Requests\Admin\User;

use Gate;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\JsonRequest;

class UpdateRequest extends JsonRequest
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
                'string',
                'max:191',
                'unique:App\Models\User,email,'. $this->user->id.',id',              
            ],
            'username' => [
                'required',
                'string',
                'max:191',
                'unique:App\Models\User,username,'. $this->user->id.',id',
            ],
            'phone' => 'required|numeric',
            'roles' => 'required',
            'department_id' => 'nullable',
            'password' => 'nullable|confirmed|min:6',
            'status' => [
                'nullable',
                'in:1,0'
            ]
        ];

    }
}
