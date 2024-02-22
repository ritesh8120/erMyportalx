@extends('layout.main')
@section('containt')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-rounded">
                    <div class="card-header">
                        @if (!empty($task))
                            {{ __('labels.edit_task') }}
                        @else
                            {{ __('labels.create_task') }}
                        @endif
                    </div>
                    <div class="card-body">
                        <form action="{{ !empty($task) ? route('task.update', $task->id) : route('task.store') }}" method="POST" id="addEditTask">
                            @csrf
                            @if (!empty($task))
                                @method('put')
                            @endif
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="title">{{ __('labels.title') }}</label>
                                    <input type="text" name="title" id="title" class="form-control" placeholder="{{ __('labels.enter_title') }}" value="{{ !empty($task) ? $task->title : "" }}">
                                </div>
                                <div class="form-group col-6">
                                    <label for="assigned_to">{{ __('labels.assigned_to') }}</label>
                                    <select name="assigned_to[]" id="assigned_to" class="form-control js-Select2" multiple="multiple">
                                        @forelse ($employees as $employee)
                                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                                        @empty
                                            <option value="">{{ __('labels.enter_assigned_to') }}</option>
                                        @endforelse
                                    </select>
                                </div>
                                <div class="form-group col-6">
                                    <label for="start_date">{{ __('labels.start_date') }}</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control" placeholder="{{ __('labels.enter_start_date') }}" value="{{ !empty($task) ? $task->start_date : "" }}">
                                </div>
                                <div class="form-group col-6">
                                    <label for="end_date">{{ __('labels.end_date') }}</label>
                                    <input type="date" name="end_date" id="end_date" class="form-control" placeholder="{{ __('labels.enter_end_date') }}" value="{{ !empty($task) ? $task->end_date : "" }}">
                                </div>
                                <div class="form-group col-12">
                                    <label for="description">{{ __('labels.description') }}</label>
                                    <textarea name="description" id="description" class="form-control" placeholder="{{ __('labels.enter_description') }}">{{ !empty($task) ? $task->description : "" }}</textarea>
                                </div>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-success" id="addEditTaskBtn">{{ __('labels.create') }}</button>
                                </div>
                            </div>
                        </form>
                        {!! JsValidator::formRequest('App\Http\Requests\admin\TaskRequest', '#addEditTask') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
<script src="{{ asset('assets/js/admin/task/addEdit.js') }}"></script>
@endpush