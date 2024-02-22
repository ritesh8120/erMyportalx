<div class="row appended">
    <div class="col-md-6 col-lg-6 form-group">
        <label>{{ __('labels.description') }}</label>
        <textarea name="description[{{ $count }}]" class="form-control" aria-describedby="description[{{ $count }}]-error"></textarea>
        <span id="description[{{ $count }}]-error" class="help-block error-help-block"></span>
    </div>
    <div class="col-md-6 col-lg-6 form-group">
        <label>{{ __('labels.working_hours') }}</label>
        <select name="working_hours[{{ $count }}]" class="form-control working_hours">
            @foreach ($hoursArray as $working_hours)
                <option value="{{ $working_hours }}">{{ $working_hours }}</option>
            @endforeach
        </select>
    </div>
</div>
