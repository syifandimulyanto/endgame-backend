@extends('admin.layouts.app')
@section('content')
    @include('admin.layouts.partials.header', [
      'title' => (@$data ? 'Edit' : 'Add New') . ' Schedule',
      'breadcrumbs' => [ ['Schedule', route('admin.scheduling.schedule.index')], (@$data ? 'Edit' : 'Add New') . ' Schedule']
    ])
    <div class="content">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                @include('admin.layouts.partials.alert')
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            <i class="icon-{{ (@$data ? 'pencil' : 'googleplus5') }}"></i> &nbsp; {{ (@$data ? 'Edit' : 'Add New') }} Schedule
                        </h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                            </ul>
                        </div>
                    </div>

                    @if(@$data)
                        {{ Form::open(['route' => ['admin.scheduling.schedule.update', $data->id], 'method' => 'PUT', 'class' => 'panel-body form-horizontal pb-20']) }}
                    @else
                        {{ Form::open(['route' => 'admin.scheduling.schedule.store', 'class' => 'panel-body form-horizontal pb-20']) }}
                    @endif

                    <div class="form-group has-feedback {{ $errors->has('course_id') ? 'has-error' : '' }}">
                        <label class="control-label col-lg-4">Course</label>
                        <div class="col-lg-8">
                            <select class="form-control select2" name="course_id">
                                <option></option>
                                @foreach ($courses as $course)
                                    <option value="{{ $course->id }}" {{ (@$data && $data->course_id == $course->id) || old('course_id') == $course->id ? 'selected' : '' }}>{{ $course->name  }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('course_id'))
                                <span class="help-block no-margin mt-5">{!! implode('<br>', $errors->get('course_id')) !!}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback {{ $errors->has('lecture_id') ? 'has-error' : '' }}">
                        <label class="control-label col-lg-4">Lecture</label>
                        <div class="col-lg-8">
                            <select class="form-control select2" name="lecture_id">
                                <option></option>
                                @foreach ($lectures as $lecture)
                                    <option value="{{ $lecture->id }}" {{ (@$data && $data->lecture_id == $lecture->id) || old('lecture_id') == $lecture->id ? 'selected' : '' }}>{{ $lecture->user->first_name . ' ' .$lecture->user->last_name  }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('lecture_id'))
                                <span class="help-block no-margin mt-5">{!! implode('<br>', $errors->get('lecture_id')) !!}</span>
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

                    <div class="form-group has-feedback {{ $errors->has('class_id') ? 'has-error' : '' }}">
                        <label class="control-label col-lg-4">Class</label>
                        <div class="col-lg-8">
                            <select class="form-control select2" name="class_id">
                                <option></option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}" {{ (@$data && $data->class_id == $class->id) || old('class_id') == $class->id ? 'selected' : '' }}>{{ $class->name  }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('class_id'))
                                <span class="help-block no-margin mt-5">{!! implode('<br>', $errors->get('class_id')) !!}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback {{ $errors->has('period') ? 'has-error' : '' }}">
                        <label class="control-label col-lg-4">Period <span class="text-danger">*</span></label> </label>
                        <div class="col-lg-8">
                            <select class="form-control select2" name="period" required>
                                <option></option>
                                <option value="1" {{ (@$data && $data->period == 'ganjil') || old('period') == 1 ? 'selected' : '' }}>GANJIL</option>
                                <option value="2" {{ (@$data && $data->period == 'genap') || old('period') == 2 ? 'selected' : '' }}>GENAP</option>
                            </select>
                            @if ($errors->has('period'))
                                <span class="help-block no-margin mt-5">{!! implode('<br>', $errors->get('period')) !!}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback {{ $errors->has('period_year') ? 'has-error' : '' }}">
                        <label class="control-label col-lg-4">Period Year <span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="period_year" placeholder="Schedule period year .." value="{{ @$data ? $data->period_year : old('period_year') }}" required>
                            <div class="form-control-feedback">
                                <i class="icon-make-group text-muted"></i>
                            </div>
                            @if ($errors->has('period_year'))
                                <span class="help-block no-margin mt-5">{!! implode('<br>', $errors->get('period_year')) !!}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback {{ $errors->has('start_date') ? 'has-error' : '' }}">
                        <label class="control-label col-lg-4">Start Date <span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input type="string" class="form-control" name="start_date" placeholder="Schedule start date .." value="{{ @$data ? $data->start_date : old('start_date') }}" required>
                            <div class="form-control-feedback">
                                <i class="icon-make-group text-muted"></i>
                            </div>
                            @if ($errors->has('start_date'))
                                <span class="help-block no-margin mt-5">{!! implode('<br>', $errors->get('start_date')) !!}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback {{ $errors->has('end_date') ? 'has-error' : '' }}">
                        <label class="control-label col-lg-4">End Date <span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input type="string" class="form-control" name="end_date" placeholder="Schedule end date .." value="{{ @$data ? $data->end_date : old('end_date') }}" required>
                            <div class="form-control-feedback">
                                <i class="icon-make-group text-muted"></i>
                            </div>
                            @if ($errors->has('end_date'))
                                <span class="help-block no-margin mt-5">{!! implode('<br>', $errors->get('end_date')) !!}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback {{ $errors->has('day') ? 'has-error' : '' }}">
                        <label class="control-label col-lg-4">Day</label>
                        <div class="col-lg-8">
                            <select class="form-control select2" name="day">
                                <option></option>
                                @foreach ($days as $key => $day)
                                    <option value="{{ $key }}" {{ (@$data && $data->day == $key) || old('day') == $key ? 'selected' : '' }}>{{ strtoupper($day)  }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('day'))
                                <span class="help-block no-margin mt-5">{!! implode('<br>', $errors->get('day')) !!}</span>
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
                            <a href="{{ route('admin.scheduling.schedule.index') }}" class="btn btn-xs bg-slate-300 btn-labeled btn-ladda btn-ladda-spinner" data-style="slide-right">
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
