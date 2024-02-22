@extends('layout.main')
@section('containt')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-rounded">
                    <div class="card-body">
                        <h3>{{__('labels.today_timelog')}}</h3>
                        <table id="timelogList" class="table table-bordered dt-responsive nowrap text-center"
                            style="border-collapse: collapse; border-spacing: 0; width: 100%;"
                            data-url="{{ route('dashboard.timelog.index') }}">
                            <thead>
                                <tr>
                                    <th class="id">{{ __('labels.sr_no') }}</th>
                                    @if(Auth::check() && Auth::user()->role == App\Models\User::ADMIN)
                                    <th class="employee">{{ __('labels.employee') }}</th>
                                    @endif
                                    <th class="task">{{ __('labels.task') }}</th>
                                    <th class="description">{{ __('labels.description') }}</th>
                                    <th class="working_hours">{{ __('labels.working_hours') }}</th>
                                    <th class="date">{{ __('labels.date') }}</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('public/assets/js/timelog/index.js') }}"></script>
@endpush