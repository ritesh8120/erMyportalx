@extends('layout.main')
@section('containt')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-rounded">
                    <div class="card-header">
                        {{ __('labels.create_employee') }}
                    </div>
                    <div class="card-body">
                        <form action="{{ route('employee.store') }}" method="POST" id="addEmployee">
                            @csrf
                            <div class="row">
                                <div class="col-4 form-group">
                                    <label for="name">{{ __('labels.name') }}</label>
                                    <input type="text" name="name" id="name" class="form-control" placeholder="{{ __('labels.enter_name') }}">
                                </div>
                                <div class="col-4 form-group">
                                    <label for="email">{{ __('labels.email') }}</label>
                                    <input type="email" name="email" id="email" class="form-control" placeholder="{{ __('labels.enter_email') }}">
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-success" id="addEmployeeBtn">{{ __('labels.create') }}</button>
                                </div>
                            </div>
                        </form>
                        {!! JsValidator::formRequest('App\Http\Requests\admin\employeeRequest', '#addEmployee') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
<script src="{{ asset('public/assets/js/employee/create.js') }}"></script>
@endpush