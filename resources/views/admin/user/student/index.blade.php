@extends('admin.layouts.app')

@section('content')
    @include('admin.layouts.partials.header', [
      'title' => 'Student',
      'breadcrumbs' => ['Student']
    ])
    <div class="content">
        <div class="row">
            <div class="col-xs-12">
                @include('admin.layouts.partials.alert')
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title">
                            Student
                        </h6>
                        <div class="heading-elements">
                            <a href="{{ route('admin.user.student.create') }}" class="btn btn-xs bg-teal-400 btn-labeled btn-ladda btn-ladda-spinner" data-style="slide-right">
                                <b><i class="icon-googleplus5"></i></b> <span class="ladda-label">Add New</span>
                            </a>
                        </div>
                    </div>
                    <div class="panel-body no-padding pb-20">
                        <div class="table-responsive">
                            <table class="table table-hover datatable">
                                <thead>
                                <tr>
                                    <th width="5px">#</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email</th>
                                    <th>NRP</th>
                                    <th>Religion</th>
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
                ajax: '{{ route('admin.user.student.datatable') }}',
                serverSide: true,
                columns: [
                    { data: 'DT_RowIndex' },
                    { data: 'user.first_name' },
                    { data: 'user.last_name' },
                    { data: 'user.email' },
                    { data: 'nrp' },
                    { data: 'religion' },
                    { data: 'action', className: 'text-nowrap', orderable: false }
                ]
            });
            // Enable Select2 select for the length option
            $('.dataTables_length select').select2({
                minimumResultsForSearch: Infinity,
                width: 'auto'
            });

            /** Delete Handler **/
            $('.datatable').on('click', '.delete', function(e){
                e.preventDefault();
                var form = $(this).parents('form');
                swal({
                    title: 'Anda Yakin?',
                    text: "Data akan dihapus permanen!",
                    type: 'warning',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.value) {
                        swal({
                            title: 'Memproses...',
                            onOpen: function () {
                                swal.showLoading();
                            }
                        });
                        form.submit();
                    }
                });
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
