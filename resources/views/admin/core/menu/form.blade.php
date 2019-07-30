@extends('admin.layouts.app')
@section('content')
    @include('admin.layouts.partials.header', [
      'title' => (@$data ? 'Edit' : 'Add New') . ' Menu',
      'breadcrumbs' => ['Core', ['Menu', route('admin.core.menu.index')], (@$data ? 'Edit' : 'Add New') . ' Menu']
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
                        {{ Form::open(['route' => ['admin.core.menu.update', $data->id], 'method' => 'PUT', 'class' => 'panel-body form-horizontal pb-20']) }}
                    @else
                        {{ Form::open(['route' => 'admin.core.menu.store', 'class' => 'panel-body form-horizontal pb-20']) }}
                    @endif

                    <div class="form-group has-feedback {{ $errors->has('name') ? 'has-error' : '' }}">
                        <label class="control-label col-lg-4">Name <span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="name" placeholder="Room Name .." value="{{ @$data ? $data->name : old('name') }}" required>
                            <div class="form-control-feedback">
                                <i class="icon-make-group text-muted"></i>
                            </div>
                            @if ($errors->has('name'))
                                <span class="help-block no-margin mt-5">{!! implode('<br>', $errors->get('name')) !!}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback {{ $errors->has('parent_id') ? 'has-error' : '' }}">
                        <label class="control-label col-lg-4">Parent <small class="text-muted">(sub menu)</small></label>
                        <div class="col-lg-8">
                            <select class="form-control select2" name="parent_id">
                                <option></option>
                                @foreach ($menus as $menu)
                                    <option value="{{ $menu->id }}" {{ (@$data && $data->parent_id == $menu->id) || old('parent_id') == $menu->id ? 'selected' : '' }}>{{ $menu->name  }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('parent_id'))
                                <span class="help-block no-margin mt-5">{!! implode('<br>', $errors->get('parent_id')) !!}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback {{ $errors->has('route') ? 'has-error' : '' }}">
                        <label class="control-label col-lg-4">Route</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="route" placeholder="Route Name .." value="{{ @$data ? $data->route : old('route') }}">
                            <div class="form-control-feedback">
                                <i class="icon-make-group text-muted"></i>
                            </div>
                            @if ($errors->has('route'))
                                <span class="help-block no-margin mt-5">{!! implode('<br>', $errors->get('route')) !!}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback {{ $errors->has('action') ? 'has-error' : '' }}">
                        <label class="control-label col-lg-4">Action</label>
                        <div class="col-lg-8">
                            <input type="text" class="form-control" name="action" placeholder="Action Name .." value="{{ @$data ? $data->action : old('action') }}">
                            <div class="form-control-feedback">
                                <i class="icon-make-group text-muted"></i>
                            </div>
                            @if ($errors->has('action'))
                                <span class="help-block no-margin mt-5">{!! implode('<br>', $errors->get('action')) !!}</span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group has-feedback {{ $errors->has('show_in_menu') ? 'has-error' : '' }}">
                        <label class="control-label col-lg-4">Is Menu <span class="text-danger">*</span></label>
                        <div class="col-lg-8">
                            <label class="radio-inline">
                                <input type="radio" name="show_in_menu" class="styled" value="1" {{ (@$data && $data->show_in_menu == "1") || old('show_in_menu') == "1" ? 'checked' : '' }} required> Yes
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="show_in_menu" class="styled" value="0" {{ (@$data && $data->show_in_menu == "0") || old('show_in_menu') == "0" ? 'checked' : '' }} required> No
                            </label>
                            @if ($errors->has('show_in_menu'))
                                <span class="help-block no-margin mt-5">{!! implode('<br>', $errors->get('show_in_menu')) !!}</span>
                            @endif
                        </div>
                    </div>

                    <div class="row pt-20">
                        <div class="col-xs-6">
                            <a href="{{ route('admin.core.menu.index') }}" class="btn btn-xs bg-slate-300 btn-labeled btn-ladda btn-ladda-spinner" data-style="slide-right">
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
