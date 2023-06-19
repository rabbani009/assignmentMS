@extends('backend')

@section('page_level_css_plugins')

@endsection

@section('page_level_css_files')

@endsection

@section('content')

<section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">

         <!-- ./col -->
         <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3></h3>
  
                <p>Pending Assignment</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
          </div>

      
      <!-- /.row -->
      <!-- Main row -->
     
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
 
  </section>


@endsection

<!-- BEGIN PAGE LEVEL PLUGINS -->
@section('page_level_js_plugins')

{{-- <script src="{{ asset('AdminLTE-3.2.0/plugins/chart.js/Chart.min.js') }}"></script> --}}

@endsection
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
@section('page_level_js_scripts')
<script>
 
</script>

@endsection
