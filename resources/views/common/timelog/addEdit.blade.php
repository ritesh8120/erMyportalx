@extends('layout.main')
@section('containt')
<script src="https://cdn.ckeditor.com/4.24.0-lts/standard/ckeditor.js"></script>

    <div class="content-wrapper">
        <div class="row">
            <div class="col-sm-12">
                <div class="card card-rounded">
                    <div class="card-header">
                        {{ __('labels.log_time') }}
                    </div>
                    <div class="card-body">
                        <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                        <form action="{{ route('timelog.store') }}" method="POST" id="addEditTimelog">
                            @csrf
                            <div class="row">
                                @if ($user->role == App\Models\User::ADMIN)
                                <div class="col-md-6 col-lg-6 form-group">
                                    <label for="email">{{ __('labels.employee') }}</label>
                                    <select name="user_id" id="user_id" class="form-control">
                                        @forelse ($employees as $employee)
                                            <option value="{{ $employee->id }}"
                                                {{ $employee->id == $user->id ? 'selected' : '' }}>{{ $employee->name }}
                                            </option>
                                        @empty
                                            <option value=""> -- </option>
                                        @endforelse
                                    </select>
                                </div>
                                @else
                                <input type="hidden" name="user_id" value="{{ $user->id }}">
                                <div class="col-md-6 col-lg-6 form-group">
                                    <label class="f-14 text-dark-grey mb-2" data-label="" for="user_id2">&nbsp;
                                   </label>
                                    <div class="media align-items-center mw-250">
                                        <div class="media-body active">
                                            <h5 class="mb-0 f-12">{{ ucFirst($user->name) }}
                                                <span class="ml-2 badge badge-secondary pr-1">It's you</span>
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                <div class="col-md-6 col-lg-6 form-group">
                                    <label for="date">{{__('labels.date')}}</label>
                                    <input id="date" class="form-control" type="date" name="date" value="{{ date('Y-m-d') }}" readonly>
                                </div>
                                <div class="text-end">
                                    <a class="text-danger btn-css" href="#" id="removeBtn">{{__('labels.remove')}}</a>&nbsp;&nbsp;
                                    <a class="text-success btn-css" href="#" id="addMoreBtn">{{ __('labels.add_more') }}</a>
                                </div>
                                <div class="col-md-6 col-lg-6 form-group">
                                    <label>{{ __('labels.description') }}</label>
                                    <textarea name="description[0]" class="form-control" aria-describedby="description[0]-error"></textarea>
                                    <span id="description[0]-error" class="help-block error-help-block"></span>
                                </div>
                                <div class="col-md-6 col-lg-6 form-group">
                                    <label>{{__('labels.working_hours')}}</label>
                                    <select name="working_hours[0]" class="form-control working_hours">
                                        @foreach ($hoursArray as $working_hours)
                                            <option value="{{ $working_hours }}">{{ $working_hours }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div id="appendData">
                                
                            </div>
                                <div class="text-end"><b>{{__('labels.total_')}}</b> <span id="total_hours"></span> {{__('labels.working_hours')}}</div><br>
                                <div class="text-end">
                                    <button type="submit" class="btn btn-success"
                                        id="addEditTimelogBtn">{{ __('labels.save') }}</button>
                                </div>
                        </form>
                        {!! JsValidator::formRequest('App\Http\Requests\TimeLogRequest', '#addEditTimelog') !!}

                        <input type="hidden" id="addMoreUrl" value="{{ route('timelog.addMore') }}">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('script')
    <script src="{{ asset('public/assets/js/timelog/create.js') }}"></script>
@endpush
