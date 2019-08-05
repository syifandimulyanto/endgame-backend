@extends('admin.layouts.app')
@section('content')
    @include('admin.layouts.partials.header', [
      'title' => (@$data ? 'Edit' : 'Add New') . ' Room',
      'breadcrumbs' => [ ['Course', route('admin.master.course.index')], (@$data ? 'Edit' : 'Add New') . ' Course']
    ])
    <div class="content">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                @include('admin.layouts.partials.alert')
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            <i class="icon-{{ (@$data ? 'pencil' : 'googleplus5') }}"></i> &nbsp; {{ (@$data ? 'Edit' : 'Add New') }} Room
                        </h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                            </ul>
                        </div>
                    </div>

                    @if(@$data)
                        {{ Form::open(['route' => ['admin.master.course.update', $data->id], 'method' => 'PUT', 'class' => 'panel-body form-horizontal pb-20']) }}
                    @else
                        {{ Form::open(['route' => 'admin.master.course.store', 'class' => 'panel-body form-horizontal pb-20']) }}
                    @endif

                    <div class="form-group has-feedback {{ $errors->has('program_study_id') ? 'has-error' : '' }}">
                        <label class="control-label col-lg-4">Program Study</label>
                        <div class="col-lg-8">
                            <select class="form-control select2" name="program_study_id">
                                <option></option>
                                @foreach ($programStudies as $ps)
                                    <option value="{{ $ps->id }}" {{ (@$data && $data->program_study_id == $ps->id) || old('program_study_id') == $ps->id ? 'selected' : '' }}>{{ $ps->name  }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('program_study_id'))
                                <span class="help-block no-margin mt-5">{!! implode('<br>', $errors->get('program_study_id')) !!}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback {{ $errors->has('code') ? 'has-error' : '' }}">
                        <label class="control-label col-lg-4">Code <span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="code" placeholder="Course Code .." value="{{ @$data ? $data->code : old('code') }}" required>
                            <div class="form-control-feedback">
                                <i class="icon-make-group text-muted"></i>
                            </div>
                            @if ($errors->has('code'))
                                <span class="help-block no-margin mt-5">{!! implode('<br>', $errors->get('code')) !!}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label class="control-label col-lg-4">Name <span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="name" placeholder="Course Name .." value="{{ @$data ? $data->name : old('name') }}" required>
                            <div class="form-control-feedback">
                                <i class="icon-make-group text-muted"></i>
                            </div>
                            @if ($errors->has('name'))
                                <span class="help-block no-margin mt-5">{!! implode('<br>', $errors->get('name')) !!}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback {{ $errors->has('sks') ? 'has-error' : '' }}">
                        <label class="control-label col-lg-4">SKS <span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input type="number" class="form-control" name="sks" placeholder="Course SKS .." value="{{ @$data ? $data->sks : old('sks') }}" required>
                            <div class="form-control-feedback">
                                <i class="icon-make-group text-muted"></i>
                            </div>
                            @if ($errors->has('sks'))
                                <span class="help-block no-margin mt-5">{!! implode('<br>', $errors->get('sks')) !!}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback {{ $errors->has('semester') ? 'has-error' : '' }}">
                        <label class="control-label col-lg-4">Semester <span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="semester" placeholder="Course Semester .." value="{{ @$data ? $data->semester : old('semester') }}" required>
                            <div class="form-control-feedback">
                                <i class="icon-make-group text-muted"></i>
                            </div>
                            @if ($errors->has('semester'))
                                <span class="help-block no-margin mt-5">{!! implode('<br>', $errors->get('semester')) !!}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback {{ $errors->has('curriculum') ? 'has-error' : '' }}">
                        <label class="control-label col-lg-4">Curriculum <span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="curriculum" placeholder="Course Curriculum .." value="{{ @$data ? $data->curriculum : old('curriculum') }}" required>
                            <div class="form-control-feedback">
                                <i class="icon-make-group text-muted"></i>
                            </div>
                            @if ($errors->has('curriculum'))
                                <span class="help-block no-margin mt-5">{!! implode('<br>', $errors->get('curriculum')) !!}</span>
                            @endif
                        </div>
                    </div>

                    <div class="row pt-20">
                        <div class="col-xs-6">
                            <a href="{{ route('admin.master.course.index') }}" class="btn btn-xs bg-slate-300 btn-labeled btn-ladda btn-ladda-spinner" data-style="slide-right">
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
