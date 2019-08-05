@extends('admin.layouts.app')
@section('content')
    @include('admin.layouts.partials.header', [
      'title' => (@$data ? 'Edit' : 'Add New') . ' Schedule Student',
      'breadcrumbs' => [ ['Schedule', route('admin.scheduling.student.index')], (@$data ? 'Edit' : 'Add New') . ' Schedule Student']
    ])
    <div class="content">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                @include('admin.layouts.partials.alert')
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            <i class="icon-{{ (@$data ? 'pencil' : 'googleplus5') }}"></i> &nbsp; {{ (@$data ? 'Edit' : 'Add New') }} Schedule Student
                        </h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                            </ul>
                        </div>
                    </div>

                    @if(@$data)
                        {{ Form::open(['route' => ['admin.scheduling.student.update', $data->id], 'method' => 'PUT', 'class' => 'panel-body form-horizontal pb-20']) }}
                    @else
                        {{ Form::open(['route' => 'admin.scheduling.student.store', 'class' => 'panel-body form-horizontal pb-20']) }}
                    @endif

                    <div class="form-group has-feedback {{ $errors->has('schedule_id') ? 'has-error' : '' }}">
                        <label class="control-label col-lg-4">Schedule</label>
                        <div class="col-lg-8">
                            <select class="form-control select2" name="schedule_id">
                                <option></option>
                                @foreach ($schedules as $schedule)
                                    <option value="{{ $schedule->id }}" {{ (@$data && $data->schedule_id == $schedule->id) || old('schedule_id') == $schedule->id ? 'selected' : '' }}>{{ $schedule->course->name . ' || ' . $schedule->lecture->user->first_name . ' ' . $schedule->lecture->user->last_name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('schedule_id'))
                                <span class="help-block no-margin mt-5">{!! implode('<br>', $errors->get('schedule_id')) !!}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback {{ $errors->has('student_id') ? 'has-error' : '' }}">
                        <label class="control-label col-lg-4">Student</label>
                        <div class="col-lg-8">
                            <select class="form-control select2" name="student_id">
                                <option></option>
                                @foreach ($students as $student)
                                    <option value="{{ $student->id }}" {{ (@$data && $data->student_id == $student->id) || old('student_id') == $student->id ? 'selected' : '' }}>{{ $student->user->first_name . ' ' .$student->user->last_name . ' || ' . $student->nrp }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('student_id'))
                                <span class="help-block no-margin mt-5">{!! implode('<br>', $errors->get('student_id')) !!}</span>
                            @endif
                        </div>
                    </div>

                    <div class="row pt-20">
                        <div class="col-xs-6">
                            <a href="{{ route('admin.scheduling.student.index') }}" class="btn btn-xs bg-slate-300 btn-labeled btn-ladda btn-ladda-spinner" data-style="slide-right">
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
