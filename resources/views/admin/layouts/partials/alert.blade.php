@if ($errors->any())


  <div class="alert alert-danger alert-styled-left alert-bordered page-alert animated shake">
    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
    <span class="text-semibold">OoupsS!</span>
    {{ session('errors')->first() }}
  </div>
@elseif (Session::has('success'))
  <div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered page-alert">
    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
    <span class="text-semibold">Perfect!</span>
    {{ Session::get('success') }}
  </div>
@elseif (Session::has('error'))
  <div class="alert alert-danger alert-styled-left alert-bordered page-alert animated shake">
    <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
    <span class="text-semibold">OoupsS!</span>
    {{ Session::get('error') }}
  </div>
@endif
