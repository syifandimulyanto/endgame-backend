@extends('admin.layouts.app')
@section('content')
    @include('admin.layouts.partials.header', [
      'title' => (@$data ? 'Edit' : 'Add New') . ' Schedule Change',
      'breadcrumbs' => [ ['Schedule', route('admin.scheduling.change.index')], (@$data ? 'Edit' : 'Add New') . ' Schedule Change']
    ])
    <div class="content">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                @include('admin.layouts.partials.alert')
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            <i class="icon-{{ (@$data ? 'pencil' : 'googleplus5') }}"></i> &nbsp; {{ (@$data ? 'Edit' : 'Add New') }} Schedule Change
                        </h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                            </ul>
                        </div>
                    </div>

                    @if(@$data)
                        {{ Form::open(['route' => ['admin.scheduling.change.update', $data->id], 'method' => 'PUT', 'class' => 'panel-body form-horizontal pb-20']) }}
                    @else
                        {{ Form::open(['route' => 'admin.scheduling.change.store', 'class' => 'panel-body form-horizontal pb-20']) }}
                    @endif

                    <div class="form-group has-feedback {{ $errors->has('schedule_id') ? 'has-error' : '' }}">
                        <label class="control-label col-lg-4">Schedule</label>
                        <div class="col-lg-8">
                            <select class="form-control select2" name="schedule_id">
                                <option></option>
                                @foreach ($schedules as $schedule)
                                    <option value="{{ $schedule->id }}" {{ (@$data && $data->schedule_id == $schedule->id) || old('schedule_id') == $schedule->id ? 'selected' : '' }}>{{ $schedule->course->name . ' || ' . $schedule->lecture->user->first_name  }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('schedule_id'))
                                <span class="help-block no-margin mt-5">{!! implode('<br>', $errors->get('schedule_id')) !!}</span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group has-feedback {{ $errors->has('room_id') ? 'has-error' : '' }}">
                        <label class="control-label col-lg-4">Room</label>
                        <div class="col-lg-8">
                            <select class="form-control select2" name="room_id">
                                <option></option>
                                @foreach ($rooms as $room)
                                    <option value="{{ $room->id }}" {{ (@$data && $data->room_id == $room->id) || old('room_id') == $room->id ? 'selected' : '' }}>{{ $room->name  }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('room_id'))
                                <span class="help-block no-margin mt-5">{!! implode('<br>', $errors->get('room_id')) !!}</span>
                            @endif
                        </div>
                    </div>


                    <div class="form-group has-feedback {{ $errors->has('date') ? 'has-error' : '' }}">
                        <label class="control-label col-lg-4">Date <span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input type="string" class="form-control" name="date" placeholder="Schedule change date .." value="{{ @$data ? $data->date : old('date') }}" required>
                            <div class="form-control-feedback">
                                <i class="icon-make-group text-muted"></i>
                            </div>
                            @if ($errors->has('date'))
                                <span class="help-block no-margin mt-5">{!! implode('<br>', $errors->get('date')) !!}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback {{ $errors->has('start_time') ? 'has-error' : '' }}">
                        <label class="control-label col-lg-4">Start Time <span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input type="time" class="form-control" name="start_time" placeholder="Schedule start time .." value="{{ @$data ? $data->start_time : old('start_time') }}" required>
                            <div class="form-control-feedback">
                                <i class="icon-make-group text-muted"></i>
                            </div>
                            @if ($errors->has('start_time'))
                                <span class="help-block no-margin mt-5">{!! implode('<br>', $errors->get('start_time')) !!}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback {{ $errors->has('end_time') ? 'has-error' : '' }}">
                        <label class="control-label col-lg-4">End Time <span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input type="time" class="form-control" name="end_time" placeholder="Schedule end time .." value="{{ @$data ? $data->end_time : old('end_time') }}" required>
                            <div class="form-control-feedback">
                                <i class="icon-make-group text-muted"></i>
                            </div>
                            @if ($errors->has('end_time'))
                                <span class="help-block no-margin mt-5">{!! implode('<br>', $errors->get('end_time')) !!}</span>
                            @endif
                        </div>
                    </div>

                    <div class="row pt-20">
                        <div class="col-xs-6">
                            <a href="{{ route('admin.scheduling.change.index') }}" class="btn btn-xs bg-slate-300 btn-labeled btn-ladda btn-ladda-spinner" data-style="slide-right">
                                <b><i class="icon-arrow-left16"></i></b> <span class="ladda-label">Back</span>
                            </a>
                        </div>
                        <div class="col-xs-6 text-right">
                            <button type="submit" class="btn btn-xs bg-teal-400 btn-labeled btn-ladda btn-ladda-spinner" data-style="slide-right">
                                <b><i class="icon-checkmark4"></i></b> <span class="ladda-label">Save</span>
                            </button>
                        </div>
                    </div>

                    {{ Form::close() }}

                </div>
            </div>
        </div>
        @include('admin.layouts.partials.footer')
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('assets/admin/js/plugins/editors/summernote/summernote.min.js') }}"></script>
    <script type="text/javascript">
        $(function(){

            /* Summernote */
            $('.summernote').summernote({
                toolbar: [
                    // [groupName, [list of button]]
                    ['misc', ['fullscreen', 'codeview', 'undo', 'redo', 'help']],
                ]
            });

            /* Alert Handler */
            setTimeout(function(){
                $('.alert').slideUp('fast');
            }, 10000);

            /* Button With Spinner */
            Ladda.bind('.btn-ladda-spinner', {
                dataSpinnerSize: 16,
                timeout: true
            });

            /* Select2 */
            $('.select2').select2();
        });
    </script>
@endsection
