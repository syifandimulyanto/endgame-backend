@extends('admin.layouts.app')

@section('content')
    @include('admin.layouts.partials.header', [
      'title' => 'Schedule',
      'breadcrumbs' => ['Schedule']
    ])
    <div class="content">
        <div class="row">
            <div class="col-xs-12">
                @include('admin.layouts.partials.alert')
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title">
                            Attend
                        </h6>
                    </div>
                    <div class="panel-body no-padding pb-20">
                        <div class="table-responsive">
                            <table class="table table-hover datatable">
                                <thead>
                                <tr>
                                    <th width="5px">#</th>
                                    <th>Course</th>
                                    <th>Lecture</th>
                                    <th>Student</th>
                                    <th>Attend At</th>
                                    <th>Schedule Time</th>
                                    <th class="text-center"><i class="icon-arrow-down12"></i></th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('admin.layouts.partials.footer')
    </div>
@endsection

@section('script')

    <script type="text/javascript" src="{{ asset('assets/admin/js/plugins/tables/datatables/datatables.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/plugins/tables/datatables/datatables-default-setting.js') }}"></script>

    <script type="text/javascript">
        $(function(){
            /* Alert Handler */
            setTimeout(function(){
                $('.alert').slideUp('fast');
            }, 10000);

            /* DataTable */
            $('.datatable').DataTable({
                ajax: '{{ route('admin.attend.datatable') }}',
                serverSide: true,
                columns: [
                    { data: 'DT_RowIndex' },
                    { data: 'student_schedule.schedule.course.name' },
                    { data: 'lecture_name' },
                    { data: 'student_name' },
                    { data: 'attend_at'},
                    { data: 'schedule_time_start_end'},
                    { data: 'image'},
                ]
            });
            // Enable Select2 select for the length option
            $('.dataTables_length select').select2({
                minimumResultsForSearch: Infinity,
                width: 'auto'
            });

            /* Lightbox */
            $('[data-popup="lightbox"]').fancybox({
                padding: 3
            });

            /* Button With Spinner */
            Ladda.bind('.btn-ladda-spinner', {
                dataSpinnerSize: 16,
                timeout: true
            });
        });
    </script>
@endsection
