<section class="content">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">{{ $commons['content_title'] }}</h1>

            <div class="card-tools">
                Note:: [ You have to scroll Left => Right to see the full content ]
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card">
            <form action="" method="post" data-bitwarden-watching="1" enctype="multipart/form-data" accept-charset="UTF-8">
                @csrf
                <div class="card-body">
                    <!-- Prerequisites section -->
                    <div class="container card ">
                        <div class="row">
                          
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Select Class *</label>
                                    <select name="class" class="form-control" id="classSelect">
                                        <option value="" selected="" disabled="">class *</option>
                                        @foreach($classes as $id => $class)
                                            <option value="{{ $class }}">{{ $class }}</option>
                                        @endforeach
                                    </select>
                                  
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Select Subject *</label>
                                    <select name="department" class="form-control" id="subjectSelect">
                                        <option value="" selected="" disabled="">Subject *</option>
                                        @foreach($subjects as $id => $subject)
                                            <option value="{{ $subject }}">{{ $subject }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                          
                        </div>
                    </div>

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </form>
        </div>

        <div class="card-body p-0">
            <table class="table table-responsive text-center">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Assignment ID</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Subject</th>
                        <th>Assignment type</th>
                        <th>Assignment Date</th>
                        <th>Sublission Date</th>
                        <th>Assigned By</th>
                        <th>Attached File</th>

                       
                        <th>Assignment Status</th>

                        @include('backend.pages.commons.timestamps_th')

                        <th class="custom_actions">Actions</th>
                    </tr>
                </thead>
                <tbody id="tableBody">
               @foreach($assignments as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->assignment_id}}</td>
                        <td>{{ $row->class}}</td>
                        <td>{{ $row->section}}</td>
                        <td>{{ $row->subject}}</td>
                        <td>{{ $row->assignment}}</td>
                        <td>{{ $row->assign_date}}</td>
                        <td>{{ $row->submission_date}}</td>
                        <td>{{ $row->createdBy->name}}</td>
                        <td>
                        @if(!empty($row->attached_file))
                            <a href="{{ asset($row->attached_file) }}" download="{{ $row->attached_file }}">
                                <i class="far fa-file"></i> 
                            </a>
                        @else
                            &nbsp;
                        @endif
                        </td>
                        <td>
                            @if($row->assignment_status == 0)
                                 <span class="badge badge-pill badge-info"> Completed </span>
                            @else
                                 <span class="badge badge-pill badge-success"> Running </span>
                            @endif
                            
                        </td>
                       
                        @include('backend.pages.commons.timestamps_td')                     

                        <td class="custom_actions">
                            <div class="btn-group">
                                <a href="#" class="btn btn-flat btn-outline-info btn-sm" data-toggle="tooltip" title="Edit">
                                   <i class="far fa-edit"></i>
                                </a>
                                <form method="post" class="list_delete_form" action="" accept-charset="UTF-8" >
                                    {{ csrf_field() }}
                                    <input name="_method" type="hidden" value="DELETE">
                                    <button onclick="return confirm('Are you sure?')" type="submit" class="btn btn-flat btn-outline-danger btn-sm" data-toggle="tooltip" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
        {{ $assignments->withQueryString()->links('pagination::bootstrap-5') }}
        </div>


<script>
    document.getElementById('classSelect').addEventListener('change', () => {
        let selectedClass = document.getElementById('classSelect').value;
        $.ajax({
            type: 'get',
            url: 'filter-class-wise-data',
            data: {
                class: selectedClass
            },
            success: function(res) {
                $('#tableBody').html(res);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });

    document.getElementById('subjectSelect').addEventListener('change', function() {
        let selectedSubject = this.value;
        $.ajax({
            type: 'get',
            url: 'filter-subject-wise-data',
            data: {
                subject: selectedSubject
            },
            success: function(res) {
                // console.log(res);
                $('#tableBody').html(res);
            },
            error: function(error) {
                console.log(error);
            }
        });
    });


</script>




    </div>
</section>
