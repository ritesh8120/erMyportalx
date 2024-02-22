@extends('layout.main')
@section('containt')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-rounded">
                    <div class="card-header">
                        {{ __('labels.manage_task') }}
                        <div class="float-end">
                            <a href={{ route('task.create') }}
                                class="btn btn-success">{{ __('labels.create_task') }}</a>
                        </div>
                    </div>
                    <div class="card-body">
                        {{-- <div class="table-responsive"> --}}
                            <table id="taskList" class="table table-bordered dt-responsive nowrap text-center"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;" data-url="{{route('task.index')}}">
                                <thead>
                                    <tr>
                                        <th class="id">{{__('labels.sr_no')}}</th>
                                        <th class="title">{{__('labels.title')}}</th>
                                        <th class="start_date">{{__('labels.start_date')}}</th>
                                        <th class="end_date">{{__('labels.end_date')}}</th>
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
<script src="{{ asset('assets/js/admin/task/index.js') }}"></script>
@endpush