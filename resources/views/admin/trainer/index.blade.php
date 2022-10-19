@extends('admin.layouts.app')

@section('content')
    @include('admin.layouts.partials.header', [
      'title' => 'Training',
      'breadcrumbs' => ['Training']
    ])
    <div class="content">

        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            <i class="icon-googleplus5"></i> &nbsp; Training Data
                        </h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                            </ul>
                        </div>
                    </div>

                    <form class="panel-body form-horizontal pb-20">

                        <div class="form-group has-feedback">
                            <label class="control-label col-lg-4">Student</label>
                            <div class="col-lg-8">
                                <select class="form-control select2" name="student_id">
                                    <option></option>
                                    @foreach ($students as $student)
                                        <option value="{{ $student->nrp }}" {{ (@$data && $data->student_id == $student->id) || old('student_id') == $student->id ? 'selected' : '' }}>{{ $student->user->first_name . ' ' .$student->user->last_name . ' || ' . $student->nrp }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row pt-20">
                            <div class="col-xs-6">
                                <a href="{{ route('admin.scheduling.student.index') }}" class="btn btn-xs bg-danger-300 btn-labeled btn-ladda btn-ladda-spinner" data-style="slide-right">
                                    <b><i class="icon-arrow-left16"></i></b> <span class="ladda-label">Strop Training</span>
                                </a>
                            </div>
                            <div class="col-xs-6 text-right">
                                <button type="submit" id="record" class="btn btn-xs bg-teal-400 btn-labeled btn-ladda btn-ladda-spinner" data-style="slide-right">
                                    <b><i class="icon-checkmark4"></i></b> <span class="ladda-label">Start Training</span>
                                </button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h5 class="panel-title">
                            <i class="icon-googleplus5"></i> &nbsp; Video Viewer
                        </h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                            </ul>
                        </div>
                    </div>

                    <img class="img img-responsive" style="padding: 10px;"  id="video" src="http://0.0.0.0:5000/video_viewer">

                </div>
            </div>
        </div>
        @include('admin.layouts.partials.footer')
    </div>
@endsection

@section('script')

    <script type="text/javascript">
        $(function(){
            /* Select2 */
            $('.select2').select2();
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

        $(document).on("click","#record",function(e) {
            e.preventDefault();
            var nrp = $('.select2').val();
            // alert("click bound to document listening for #test-element" );

            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    alert(xhr.responseText);
                }
            }
            xhr.open("POST", "http://0.0.0.0:5000/record_status");
            xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xhr.send(JSON.stringify({status: "true", nrp: nrp}));
        });

        var buttonRecord = document.getElementById("records");
        var buttonStop = document.getElementById("stop");
        var nrp = document.getElementById("nrp");

        buttonStop.disabled = true;

        // buttonRecord.onclick = function() {
        buttonRecord.addEventListener('click', function(e) {
            // $("#record").on('click', function() {
            //
            // });
            // var url = window.location.href + "record_status";
            buttonRecord.disabled = true;
            buttonStop.disabled = false;

            // disable download link
            var downloadLink = document.getElementById("download");
            downloadLink.text = "";
            downloadLink.href = "";

            // XMLHttpRequest
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // alert(xhr.responseText);
                }
            }
            xhr.open("POST", "http://0.0.0.0:5000/record_status");
            xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xhr.send(JSON.stringify({status: "true", nrp: nrp.value}));
            // };
            e.preventDefault();
        });

        buttonStop.onclick = function() {
            buttonRecord.disabled = false;
            buttonStop.disabled = true;

            // XMLHttpRequest
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // alert(xhr.responseText);

                    // enable download link
                    var downloadLink = document.getElementById("download");
                    downloadLink.text = "Download Video";
                    downloadLink.href = "/static/video.avi";
                }
            }
            xhr.open("POST", "http://0.0.0.0:5000/record_status");
            xhr.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
            xhr.send(JSON.stringify({ status: "false" }));
        };


    </script>
@endsection
