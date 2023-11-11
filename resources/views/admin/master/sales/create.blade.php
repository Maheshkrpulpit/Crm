@extends('layouts.master')
@section('title')
    {{ lang('Show Brands') }}
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
                        <form action="{{ route('sales.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
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
                                                    <input type="{{ $field->type }}" class="form-control"
                                                        id="{{ $field->name }}" name="{{ $field->name }}"
                                                        placeholder="{{ lang('Enter ' . $field->label) }}"
                                                        {{ $field->is_required ? 'required' : '' }}>
                                                @elseif ($field->type == 2)
                                                    <input type="number" class="form-control" id="{{ $field->name }}"
                                                        name="{{ $field->name }}"
                                                        placeholder="{{ lang('Enter ' . $field->label) }}"
                                                        {{ $field->is_required ? 'required' : '' }}>
                                                @elseif ($field->type == 10)
                                                    <input type="date" class="form-control" id="{{ $field->name }}"
                                                        name="{{ $field->name }}"
                                                        placeholder="{{ lang('Enter ' . $field->label) }}"
                                                        {{ $field->is_required ? 'required' : '' }}>
                                                @elseif ($field->type == 9)
                                                    <input type="email" class="form-control" id="{{ $field->name }}"
                                                        name="{{ $field->name }}"
                                                        placeholder="{{ lang('Enter ' . $field->label) }}"
                                                        {{ $field->is_required ? 'required' : '' }}>
                                                @elseif($field->type == 6)
                                                    <select id="{{ $field->name }}" name="{{ $field->name }}"
                                                        class="form-control" autocomplete="off"
                                                        {{ $field->is_required ? 'required' : '' }}>
                                                        <option value="">{{ lang('Select') }}</option>
                                                        @if (isset($field->values))
                                                            @foreach (json_decode($field->values) as $value)
                                                                <option value="{{ $value }}">
                                                                    {{ $value }}
                                                                </option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                @elseif($field->type == 5)
                                                    <textarea id="{{ $field->name }}" name="{{ $field->name }}" class="form-control" rows="2" autocomplete="off"
                                                        {{ $field->is_required ? 'required' : '' }} placeholder="{{ lang('Enter ' . $field->name) }}"></textarea>
                                                @elseif ($field->type == 7)
                                                    <input type="file" class="form-control" id="{{ $field->name }}"
                                                        name="{{ $field->name }}"
                                                        placeholder="{{ lang('Enter ' . $field->label) }}"
                                                        {{ $field->is_required ? 'required' : '' }}>
                                                @elseif ($field->type == 8)
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
                                                <option value="{{ $state->id }}">{{ $state->name }} ({{ $state->state_code }})</option>
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
                                                <option value="{{ $packages->id }}">{{ $packages->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('package_id')
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <input type="hidden" class="form-control" id="brand_id"
                                                        name="brand_id" value="{{$brand_id}}"
                                                        placeholder="Brand Id"
                                                        required>
                                    <input type="hidden" class="form-control" id="user_id"
                                                        name="user_id" value="{{$userID}}"
                                                        placeholder="user Id"
                                                        required>
                                </div>
                            </div>
                            <div class="offcanvas-footer border-top p-3 text-center">
                                <div class="d-flex align-items-start gap-3 mt-4">
                                    <button type="submit" class="btn btn-primary btn-label right ms-auto nexttab"
                                        data-nexttab="pills-finish-tab">Submit
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- 
    </div>
    </div>
    </div> --}}

@endsection
<!-- Modal -->
{{-- <div class="row">
    @foreach ($fields as $field)
        <div class="col-md-4">
            <label for="{{ $field->name }}" class="form-label">{{ lang($field->label) }}
                <span class="text-danger">{{ $field->is_required ? '*' : '' }}</span>
            </label>
            @if ($field->type == 1)
                <!-- Input Type Text -->
                <input type="text" class="form-control" id="{{ $field->name }}" name="{{ $field->name }}" placeholder="{{ lang('Enter ' . $field->label) }}" {{ $field->is_required ? 'required' : '' }}>
            @elseif ($field->type == 2)
                <!-- Input Type Number -->
                <input type="number" class="form-control" id="{{ $field->name }}" name="{{ $field->name }}" placeholder="{{ lang('Enter ' . $field->label) }}" {{ $field->is_required ? 'required' : '' }}>
            <!-- Add other input types as needed -->
            @endif
            @error($field->name)
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <!-- Close the row and start a new one after every three columns -->
        @if ($loop->iteration % 3 == 0 && !$loop->last)
            </div><div class="row">
        @endif
    @endforeach
</div> --}}
