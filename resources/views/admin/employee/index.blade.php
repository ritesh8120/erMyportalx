@extends('layout.main')
@section('containt')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-rounded">
                    <div class="card-header">
                        {{ __('labels.manage_employee') }}
                        <div class="float-end">
                            <a href={{ route('employee.create') }}
                                class="btn btn-success">{{ __('labels.create_employee') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- <div class="table-responsive"> --}}
                            <table id="employeeList" class="table table-bordered dt-responsive nowrap text-center"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;" data-url="{{route('employee.index')}}">
                                <thead>
                                    <tr>
                                        <th class="id">{{__('labels.sr_no')}}</th>
                                        <th class="name">{{__('labels.name')}}</th>
                                        <th class="email">{{__('labels.email')}}</th>
                                        <th class="text-center actions">{{__('labels.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        {{-- </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
<script src="{{ asset('public/assets/js/employee/index.js') }}"></script>
@endpush