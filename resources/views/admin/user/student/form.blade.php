@extends('admin.layouts.app')
@section('content')
    @include('admin.layouts.partials.header', [
      'title' => (@$data ? 'Edit' : 'Add New') . ' Student',
      'breadcrumbs' => [ ['Student', route('admin.user.student.index')], (@$data ? 'Edit' : 'Add New') . ' Student']
    ])
    <div class="content">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                @include('admin.layouts.partials.alert')
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            <i class="icon-{{ (@$data ? 'pencil' : 'googleplus5') }}"></i> &nbsp; {{ (@$data ? 'Edit' : 'Add New') }} Student
                        </h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                            </ul>
                        </div>
                    </div>

                    @if(@$data)
                        {{ Form::open(['route' => ['admin.user.student.update', $data->id], 'method' => 'PUT', 'class' => 'panel-body form-horizontal pb-20']) }}
                    @else
                        {{ Form::open(['route' => 'admin.user.student.store', 'class' => 'panel-body form-horizontal pb-20']) }}
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

                    <div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
                        <label class="control-label col-lg-4">Email <span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="email" placeholder="Student email .." value="{{ @$data ? $data->user->email : old('email') }}" required>
                            <div class="form-control-feedback">
                                <i class="icon-make-group text-muted"></i>
                            </div>
                            @if ($errors->has('email'))
                                <span class="help-block no-margin mt-5">{!! implode('<br>', $errors->get('email')) !!}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback {{ $errors->has('first_name') ? 'has-error' : '' }}">
                        <label class="control-label col-lg-4">First Name <span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="first_name" placeholder="Student first name .." value="{{ @$data ? $data->user->first_name : old('first_name') }}" required>
                            <div class="form-control-feedback">
                                <i class="icon-make-group text-muted"></i>
                            </div>
                            @if ($errors->has('first_name'))
                                <span class="help-block no-margin mt-5">{!! implode('<br>', $errors->get('first_name')) !!}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback {{ $errors->has('last_name') ? 'has-error' : '' }}">
                        <label class="control-label col-lg-4">Last Name</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="last_name" placeholder="Student last name .." value="{{ @$data ? $data->user->last_name : old('last_name') }}">
                            <div class="form-control-feedback">
                                <i class="icon-make-group text-muted"></i>
                            </div>
                            @if ($errors->has('last_name'))
                                <span class="help-block no-margin mt-5">{!! implode('<br>', $errors->get('last_name')) !!}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback {{ $errors->has('nrp') ? 'has-error' : '' }}">
                        <label class="control-label col-lg-4">NRP <span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="nrp" placeholder="Student nrp .." value="{{ @$data ? $data->nrp : old('nrp') }}" required>
                            <div class="form-control-feedback">
                                <i class="icon-make-group text-muted"></i>
                            </div>
                            @if ($errors->has('nrp'))
                                <span class="help-block no-margin mt-5">{!! implode('<br>', $errors->get('nrp')) !!}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback {{ $errors->has('religion') ? 'has-error' : '' }}">
                        <label class="control-label col-lg-4">Religion</label>
                        <div class="col-lg-8">
                            <select class="form-control select2" name="religion">
                                <option></option>
                                @foreach ($religions as $religion)
                                    <option value="{{ $religion }}" {{ (@$data && $data->religion == $religion) || old('religion') == $religion ? 'selected' : '' }}>{{ strtoupper($religion)  }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('religion'))
                                <span class="help-block no-margin mt-5">{!! implode('<br>', $errors->get('religion')) !!}</span>
                            @endif
                        </div>
                    </div>

                    <div class="row pt-20">
                        <div class="col-xs-6">
                            <a href="{{ route('admin.user.student.index') }}" class="btn btn-xs bg-slate-300 btn-labeled btn-ladda btn-ladda-spinner" data-style="slide-right">
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
