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
                        <th>Student Name</th>
                        <th>Answered File</th>  
                        <th>Submitted Time</th>

                        <th class="custom_actions">Give Mark</th>
                    </tr>
                </thead>
                <tbody>
               @foreach($submittedAssignments as $row)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $row->assignment_id}}</td>
                        <td>{{ $row->assignment->class }}</td>
                        <td>{{ $row->assignment->section}}</td>
                        <td>{{ $row->assignment->subject}}</td>

                        <td>{{ $row->assignment->assignment}}</td>
                        <td>{{ $row->assignment->assign_date}}</td>
                        <td>{{ $row->assignment->submission_date}}</td>
                        <td>{{ $row->student->name}}</td>
                      
                        <td>
                        @if(!empty($row->attached_file))
                            <a href="{{ asset($row->attached_file) }}" download="{{ $row->attached_file }}">
                                <i class="far fa-file"></i> 
                            </a>
                        @else
                            &nbsp;
                        @endif
                        </td>
                        <td> {{ $row->submitted_time}} </td>
                        <td>
                            <!-- <form action="{{ route('submit.assignment') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="assignment_id" value="{{ $row->assignment_id }}">
                                <input type="hidden" name="student_id" value="{{ Auth::id() }}">
                                <input type="file" name="attached_file">
                                <button type="submit" class="btn btn-flat btn-outline-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Submit Assignment">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form> -->
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
        {{ $submittedAssignments->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    </div>
</section>
