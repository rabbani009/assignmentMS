@extends('backend')

@section('page_level_css_plugins')
<meta name="csrf_token" content="{{ csrf_token() }}" />
<link href="{{ asset('AdminLTE-3.2.0/plugins/select2/css/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet" />
@endsection

@section('page_level_css_files')

@endsection

@section('content')
<section class="content">
@if($errors->any())
    <div class="card pl-3 bg-danger">
        {!! implode('', $errors->all('<div>:message</div>')) !!}
    </div>
@endif
<div class="card">
    <div class="card-header">
        <h1 class="card-title">{{ $commons['content_title'] }}</h1>

        <div class="card-tools">
            Note:: * marked fields are required
        </div>
    </div>
    <form action="{{ route('assignment.store') }}" method="post" data-bitwarden-watching="1" enctype="multipart/form-data" accept-charset="UTF-8">
        @csrf
        <div class="card-body">
            <!-- Prerequisites section -->
            <div class="container-fluid card ">
                <div class="row">
                    <!-- Class -->
                    <div class="col-md-4">
                        <div class="form-group  @if ($errors->has('source_of_fund')) has-error @endif">
                            <label class="control-label">Select Class *</label>
                            <select name="class" class="form-control">
                                <option value="">Select Class</option>
                                <option value="nine">9th</option>
                                <option value="ten">10th</option>	
                                <option value="eleven">11th</option>
                                <option value="twelve">12th</option>
                                <option value="Others">Others</option>			
                            
                            </select>
                            @if($errors->has('class'))
                                <span class="error invalid-feedback"> {{ $errors->first('class') }} </span>
                            @endif
                        </div>
                    </div>
                    <!-- Section -->
                    <div class="col-md-4">
                        <div class="form-group  @if ($errors->has('source_of_fund')) has-error @endif">
                            <label class="control-label">Select Section *</label>
                            <select name="section" class="form-control">
                                <option value="">Select Section</option>
                                <option value="a">A</option>
                                <option value="b">B</option>	
                                <option value="c">C</option>
                                <option value="d">D</option>
                                <option value="Others">Others</option>			
                            
                            </select>
                            @if($errors->has('section'))
                                <span class="error invalid-feedback"> {{ $errors->first('section') }} </span>
                            @endif
                        </div>
                    </div>
                    <!-- Assignment Type -->
                    <div class="col-md-4">
                        <div class="form-group  @if ($errors->has('source_of_fund')) has-error @endif">
                            <label class="control-label">Assignment Type *</label>
                            <select name="assignment" class="form-control">
                                <option value="">Select Type</option>
                                <option value="daily">Daily</option>
                                <option value="monthly">Monthly</option>	
                                <option value="preexam">PreExam</option>
                                <option value="Others">Others</option>			
                            
                            </select>
                            @if($errors->has('assignment'))
                                <span class="error invalid-feedback"> {{ $errors->first('assignment') }} </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Time and location section -->
            <div class="container-fluid card ">
            <div class="row">
                    <div class="col-md-6">
                        <div class="form-group @if ($errors->has('start_date')) has-error @endif">
                            <label for="">Assign date *</label>
                            <div class="input-group date" id="start_date" data-target-input="nearest">
                                <input value="{{ old('assign_date') }}" type="text" name="assign_date" class="form-control datetimepicker-input" data-target="#start_date" autocomplete="off" placeholder="YYYY-MM-DD">
                                <div class="input-group-append" data-target="#start_date" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            @if($errors->has('assign_date'))
                                <span class="error invalid-feedback">{{ $errors->first('assign_date') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <!-- Dates -->
                        <div class="form-group @if ($errors->has('end_date')) has-error @endif">
                            <label for="">Submission date *</label>
                            <div class="input-group date" id="end_date" data-target-input="nearest">
                                <input type="text" name="submission_date" value="{{ old('end_date') }}" class="form-control datetimepicker-input" data-target="#end_date" autocomplete="off" placeholder="YYYY-MM-DD">
                                <div class="input-group-append" data-target="#end_date" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div>
                            @if($errors->has('submission_date'))
                                <span class="error invalid-feedback">{{ $errors->first('submission_date') }}</span>
                            @endif
                        </div>
                    </div>
                    
                </div>
                
                <div class="row">
                      <!-- Assignment ID -->
                      <div class="col-md-4">
                        <div class="form-group @if ($errors->has('assign_id')) has-error @endif">
                            <label for="">Assignment ID *</label>
                            <input type="text" name="assign_id" class="form-control @if($errors->has('subject')) is-invalid @endif" value="{{ old('subject') }}" placeholder="Enter subject Name">
                            @if($errors->has('assign_id'))
                                <span class="error invalid-feedback">{{ $errors->first('assign_id') }}</span>
                            @else
                            
                            @endif
                        </div>
                    </div>
                    <!-- Subject -->
                    <div class="col-md-4">
                        <div class="form-group @if ($errors->has('activity_title')) has-error @endif">
                            <label for="">Subject *</label>
                            <input type="text" name="subject" class="form-control @if($errors->has('subject')) is-invalid @endif" value="{{ old('subject') }}" placeholder="Enter subject Name">
                            @if($errors->has('subject'))
                                <span class="error invalid-feedback">{{ $errors->first('subject') }}</span>
                            @else
                            
                            @endif
                        </div>
                    </div> 
                    <div class="col-md-4">
                        <div class="form-group @if ($errors->has('attached_file')) has-error @endif">
                            <label for="">Attached Documents*</label>
                            <input type="file" name="attached_file" class="form-control @if($errors->has('attached_file')) is-invalid @endif" value="{{ old('attached_file') }}" placeholder="Enter Documents" id="image">
                            @if($errors->has('attached_file'))
                                <span class="error invalid-feedback">{{ $errors->first('attached_file') }}</span>
                            @else

                            @endif
                        </div>
                    </div>     
                </div>

            <!-- Description -->
            
                
            <div class="col-md-12">
                        <div class="form-group @if ($errors->has('assignment_description')) has-error @endif">
                        <label for="">Assignment Description *</label>
                            <div class="card-body">
                                <textarea class="form-control" name= "assignment_description" rows="7" placeholder="Enter ..."  class="form-control @if($errors->has('assignment_description')) is-invalid @endif" value="{{ old('assignment_description') }}"></textarea>
                            </div>
                        </div>
                        </div>
                </div> 
                
            </div>
       

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        
    </form>
</div>

</section>

@endsection


<!-- BEGIN PAGE LEVEL PLUGINS -->
@section('page_level_js_plugins')
<script src="{{ asset('AdminLTE-3.2.0/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
@endsection
<!-- END PAGE LEVEL PLUGINS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
@section('page_level_js_scripts')
<script>
/// Event loading...
$( document ).ready(function() {
   
    $(function () {
        $('#start_date').datetimepicker({
            default: true,
            format: 'L',
            locale: 'BST',
            format: 'YYYY-MM-DD'
        });
        $('#end_date').datetimepicker({
            default: true,
            format: 'L',
            locale: 'BST',
            format: 'YYYY-MM-DD',
            placeholder: 'Select End Date'
        });
    });

});

</script>
@endsection

