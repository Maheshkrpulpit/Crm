@extends('layouts.master')

@section('title')
    {{ lang('Show Sale') }}
@endsection

@section('content')
    {{-- <div class="container"> --}}
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex mb-3">
                        <div class="flex-grow-1">
                            <div class="d-flex">
                                {{-- <div class="flex-shrink-0 avatar-md bg-light rounded p-1">
                                    <img src="{{ $sale->screen_shot }}" alt="" class="img-fluid d-block">
                                </div> --}}
                                <div class="flex-grow-1 ms-3">
                                    <h5 class="fs-14">
                                        <a href="#"
                                            class="text-body">{{ $sale->first_name . ' ' . $sale->last_name }}</a>
                                    </h5>
                                    <p class="text-muted mb-0">{{ lang('Email :') }}
                                        <span class="fw-medium">{{ $sale->email }}</span>
                                    </p>
                                    <p class="text-muted mb-0">{{ lang('Mob Number:') }}
                                        <span class="fw-medium">{{ $sale->mobile_number }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-card">
                        <table class="table mb-0">
                            <tbody>
                                <tr>
                                    <td class="fw-medium">{{ lang('User Name') }}</td>
                                    <td>{{ ucfirst($sale->user->name) }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">{{ lang('Brand Name') }}</td>
                                    <td>{{ ucfirst($sale->brand->name) }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">{{ lang('Package Name') }}</td>
                                    <td>{{ ucfirst($sale->packages->name) }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">{{ lang('Date Of Birth') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($sale->date_of_birth)->format('d M Y') }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">{{ lang('Prospect') }}</td>
                                    <td>{{$sale->prospect }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">{{ lang('Source') }}</td>
                                    <td>{{$sale->source }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">{{ lang('State') }}</td>
                                    <td>{{ ucfirst($sale->state->name) }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">{{ lang('City') }}</td>
                                    <td>{{ ucfirst($sale->city) }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">{{ lang('Social Scurity Number') }}</td>
                                    <td>{{ $sale->social_scurity_number }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">{{ lang('Zip Code') }}</td>
                                    <td>{{ $sale->zip_code }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">{{ lang('Full Address') }}</td>
                                    <td>{{ ucfirst($sale->full_address) }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">{{ lang('Street Address') }}</td>
                                    <td>{{ ucfirst($sale->street_address) }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">{{ lang('Previous Address') }}</td>
                                    <td>{{ ucfirst($sale->previous_address) }}</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium">{{ lang('Full Address') }}</td>
                                    <td>{{ ucfirst($sale->full_address) }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="row">
                            <div class="col-sm-6">
                                <audio controls>
                                    <source src="{{ $sale->audio }}" type="audio/mp3"> <!-- Update the type attribute based on your audio file format -->
                                    Your browser does not support the audio element.
                                </audio>
                            </div>
                            <div class="col-sm-6">
                                <a href="{{ $sale->screen_shot }}" target="_blank">
                                    <img src="{{ $sale->screen_shot }}" height="100px" width="100px" alt="Sales Screenshot">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column">
                    @foreach ($remarks as $remark)
                        <div class="mb-3">
                            <div class="d-flex">
                                <div class="flex-grow-1 ms-3">
                                    <p class="text-muted mb-0">{{ lang('Order Status :') }}
                                        <span class="fw-medium">{{ ucfirst($remark->order_status) }}</span>
                                    </p>
                                    <p class="text-muted mb-0">{{ lang('Comment :') }}
                                        <span class="fw-medium">{{ ucfirst($remark->comment) }}</span>
                                    </p>
                                    <p class="text-muted mb-0">{{ lang('Created At :') }}
                                        <span class="fw-medium">{{ $remark->created_at }}</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <!-- end card -->
        </div>
    </div>
    </div>
@endsection
