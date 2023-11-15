@extends('layouts.master')
@section('title')
    {{ lang('Create Sale') }}
@endsection
@section('content')
    {{-- @component('components.breadcrumb')
        @slot('li_1')
            {{ lang('Student') }}
        @endslot
        @slot('title')
            {{ lang('Admission') }}
        @endslot
    @endcomponent
    @component('components.alert', ['response' => session('status') ?? []])
    @endcomponent --}}

    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header border-0">
                        <form action="{{ route('sales.update', ['sale' => $sales->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <div class="row">
                                    @foreach (get_system_fields(true, '', []) as $field)
                                        <div class="{{$field->grid}}">
                                            <div class="mb-3">
                                                <label for="{{ $field->name }}"
                                                    class="form-label">{{ lang($field->label) }}
                                                    <span class="text-danger">{{ $field->is_required ? '*' : '' }}</span>
                                                </label>
                                                {{ $field->types }}
                                                @if (in_array($field->type, [
                                                        1 ,
                                                        2 => 'number',
                                                        3 => 'checkbox',
                                                        4 => 'radio',
                                                        5 => 'textarea',
                                                        6 => 'select',
                                                        7 => 'file',
                                                        8 => 'mutiple',
                                                        9 => 'email',
                                                        10 => 'date',
                                                    ]))
                                                    @php $field_name = $field->name @endphp
                                                
                                                    <input type="{{ $field->type }}" class="form-control"
                                                        id="{{ $field->name }}" name="{{ $field->name }}"
                                                        placeholder="{{ lang('Enter ' . $field->label) }}" value="{{$sales->$field_name}}"
                                                        {{ $field->is_required ? 'required' : '' }}>
                                                @elseif ($field->type == 2)
                                                @php $field_name = $field->name @endphp
                                                    <input type="number" class="form-control" id="{{ $field->name }}"
                                                        name="{{ $field->name }}" value="{{$sales->$field_name}}"
                                                        placeholder="{{ lang('Enter ' . $field->label) }}"
                                                        {{ $field->is_required ? 'required' : '' }}>
                                                @elseif ($field->type == 10)
                                                @php $field_name = $field->name @endphp
                                                    <input type="date" class="form-control" id="{{ $field->name }}"
                                                        name="{{ $field->name }}" value="{{$sales->$field_name}}"
                                                        placeholder="{{ lang('Enter ' . $field->label) }}"
                                                        {{ $field->is_required ? 'required' : '' }}>
                                                @elseif ($field->type == 9)
                                                @php $field_name = $field->name @endphp
                                                    <input type="email" class="form-control" id="{{ $field->name }}"
                                                        name="{{ $field->name }}" value="{{$sales->$field_name}}"
                                                        placeholder="{{ lang('Enter ' . $field->label) }}"
                                                        {{ $field->is_required ? 'required' : '' }}>
                                                @elseif($field->type == 6)
                                                @php $field_name = $field->name @endphp
                                                    <select id="{{ $field->name }}" name="{{ $field->name }}"
                                                        class="form-control" autocomplete="off"
                                                        {{ $field->is_required ? 'required' : '' }}>
                                                        <option value="">{{ lang('Select') }}</option>
                                                        @if (isset($field->values))
                                                            @foreach (json_decode($field->values) as $value)
                                                                <option value="{{ $value }}" {{$sales->$field_name == $value ? 'selected':''}}>
                                                                    {{ $value }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                @elseif($field->type == 5)
                                                @php $field_name = $field->name @endphp
                                                    <textarea id="{{ $field->name }}" name="{{ $field->name }}" class="form-control" rows="2" autocomplete="off" 
                                                        {{ $field->is_required ? 'required' : '' }} placeholder="{{ lang('Enter ' . $field->name) }}">{{ $sales->$field_name }}</textarea>
                                                @elseif ($field->type == 7)
                                                @php $field_name = $field->name @endphp
                                                    <input type="file" class="form-control" id="{{ $field->name }}"
                                                        name="{{ $field->name }}"
                                                        placeholder="{{ lang('Enter ' . $field->label) }}"
                                                        {{ $field->is_required ? 'required' : '' }}>
                                                @elseif ($field->type == 8)
                                                @php $field_name = $field->name @endphp
                                                    <input type="multiple" class="form-control" id="{{ $field->name }}"
                                                        name="{{ $field->name }}"
                                                        placeholder="{{ lang('Enter ' . $field->label) }}"
                                                        {{ $field->is_required ? 'required' : '' }}>
                                                @endif
                                                @error($field->name)
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endforeach
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label for="state_id"
                                                   class="form-label">{{ lang('State') }}<span
                                                        class="text-danger">*</span></label>
                                            <select id="state_id" name="state_id" class="form-control"
                                                    autocomplete="off" required>
                                                <option value="">{{lang('Select State')}}</option>
                                                @foreach(get_states() as $state)
                                                <option value="{{ $state->id }}" {{ $sales->state_id == $state->id ? 'selected' : '' }} >{{ $state->name }} ({{ $state->state_code }})</option>
                                                @endforeach
                                            </select>
                                            @error('state_id')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label for="package_id"
                                                   class="form-label">{{ lang('Package') }}<span
                                                        class="text-danger">*</span></label>
                                            <select id="package_id" name="package_id" class="form-control"
                                                    autocomplete="off" required>
                                                <option value="">{{lang('Select Package')}}</option>
                                                @foreach($package as $packages)
                                                <option value="{{ $packages->id }}"{{ $sales->package_id == $packages->id ? 'selected' : '' }}>{{ $packages->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('package_id')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="mb-3">
                                            <label for="comment" class="form-label">{{ lang('Comment') }}<span class="text-danger">*</span></label>
                                            <textarea id="comment" name="comment" class="form-control" rows="2" autocomplete="off" 
                                                 placeholder="Enter Comment"></textarea>
                                            @error('comment')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <input type="hidden" class="form-control" id="brand_id"
                                                        name="brand_id" value="{{isset($sales) ? $sales->brand_id : $brand_id}}"
                                                        placeholder="Brand Id"
                                                        required>
                                    <input type="hidden" class="form-control" id="user_id"
                                                        name="user_id" value="{{isset($sales) ? $sales->user_id : $userID}}"
                                                        placeholder="user Id"
                                                        required>
                                </div>
                            </div>
                            <div class="offcanvas-footer border-top p-3 text-center">
                                <div class="d-flex align-items-start gap-3 mt-4">
                                    <button type="submit" class="btn btn-primary btn-label right ms-auto nexttab"
                                        data-nexttab="pills-finish-tab">Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <a href="{{ $sales->screen_shot }}" target="_blank">
                                <img src="{{ $sales->screen_shot }}" height="100px" width="100px" alt="Sales Screenshot">
                            </a>
                        </div>
                        <div class="col-sm-6">
                            <audio controls>
                                <source src="{{ $sales->audio }}" type="audio/mp3"> <!-- Update the type attribute based on your audio file format -->
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
 

@endsection


