@extends('layouts.master')
@section('title')
    @lang('Edit Translation')
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1') @lang( 'Language' ) @endslot
        @slot('title')@lang( 'Edit Translation' ) @endslot
    @endcomponent


    <!-- row -->
    <div class="col-xl-12">
        <div class="card buttons-translate">
            <div class="card-header p-3 px-5">
                <div class="card-options">
                    <form action="{{ request()->url() }}" method="GET">
                        <div class="input-group translate-input">
                            <input type="text" class="form-control search bg-light border-light" name="search"
                                   placeholder="{{ lang('Search') }}"
                                   value="{{ request()->input('search') ?? '' }}">
                            <button type="submit" class="btn border"><i class="ri-search-line search-icon"></i></button>
                            <button type="button" class="btn border dropdown-toggle dropdown-toggle-split"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                <span>{{ lang('Filters') }} <i class="fa fa-angle-down ms-1"></i></span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item"
                                       href="{{ request()->url() . '?filter=missing' }}">{{ lang('Missing Translates') }}</a>
                                </li>
                                <li><a class="dropdown-item"
                                       href="{{ route('settings.language.translate', $language->code) }}">{{ lang('All Translates') }}</a>
                                </li>
                            </ul>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body">
                <div>
                    @if ($translates_count > 0)
                        <div class="px-5 mb-4">
                            <div class="alert alert-light-warning d-flex px-5 py-2" role="alert">
                                <div class="me-3">
                                    <i class="fe fe-alert-circle fs-30"></i>
                                </div>
                                <div>
                                    <h4 class="alert-heading fs-15 font-weight-semibold mb-0">
                                        {{ lang('This language is incomplete') }}</h4>
                                    <p class="fs-13 mb-0">{{ $translates_count }}
                                        {{ lang('translations are missing. You can') }}
                                        <a
                                                href="{{ request()->url() . '?filter=missing' }}">{{ lang('filter this page') }}</a>
                                        {{ lang(' to show missing translations.') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="px-5 py-0 tabs-div">
                        @foreach ($groups as $group)
                            <a class="btn btn-primary me-1 mt-1 @if ($active == $group->group_langname) active @endif"
                               href="{{ $url ?? route('settings.translate.group', [$language->code, str_replace(' ', '-', $group->group_langname)]) }}">{{ ucfirst($group->group_langname) }}</a>
                        @endforeach

                    </div>
                    <form action="{{ route('settings.translates.update', $language->id) }}" method="POST">
                        @csrf
                        <div class="p-5 border-xl-top">
                            @forelse($translates as $translate)
                                <div class="d-flex translation-area mb-2">
                                    <div class="flex-grow-1">
                                    <textarea class="form-control" aria-label="With textarea" rows="1"
                                              readonly>{{ $translate->key }}</textarea>
                                    </div>
                                    <div class="p-2">
                                        <i class="bx bx-right-arrow-alt"></i>
                                    </div>
                                    <div class="flex-grow-1">
                                    <textarea class="form-control" aria-label="With textarea" rows="1"
                                              name="values[{{ $translate->id }}]">{{ $translate->value }}</textarea>
                                    </div>
                                </div>
                            @empty

                                <div class="alert text-center mb-0">
                                    {{ lang('No data found') }}
                                </div>
                            @endforelse

                        </div>
                        <div class="card-footer">
                            <div class="form-group float-end">
                                <button class="btn btn-secondary" type="submit">{{ lang('Save Changes') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('script')
    <script src="{{ URL::asset('assets/js/pages/profile-setting.init.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/form-validation.init.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection
