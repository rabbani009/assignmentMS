<section class="content">
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">{{ $commons['content_title'] }}</h1>

            <div class="card-tools">
                Note:: [ You have to scroll Left => Right to see the full content ]
            </div>
        </div>
        <!-- /.card-header -->

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
                <tbody>
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
                                <a href="#" class="btn btn-flat btn-outline-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                    <i class="far fa-eye"></i>
                                </a>
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
    </div>
</section>
