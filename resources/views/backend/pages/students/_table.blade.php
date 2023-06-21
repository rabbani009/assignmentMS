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
                        <th>Assignment Code</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Subject</th>
                        <th>Assignment type</th>
                        <th>Assignment Date</th>
                        <th>Sublission Date</th>
                        <th>Assigned By</th>
                        <th>Attached File</th>  
                        <th>Assignment Status</th>

                        <th class="custom_actions">Submit Assignment</th>
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
                            @php
                                $submittedAssignment = \App\Models\SubmittedAssignment::where('assignment_id', $row->assignment_id)
                                    ->where('student_id', Auth::id())
                                    ->first();
                                $currentDate = \Carbon\Carbon::now()->format('Y-m-d');
                            @endphp
                            @if($submittedAssignment)
                                <span class="badge badge-pill badge-success">Completed</span>
                            @elseif($row->submission_date < $currentDate)
                                <span class="badge badge-pill badge-warning">Overdue</span>
                            @else
                                <span class="badge badge-pill badge-danger">pending</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('submit.assignment') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="assignment_id" value="{{ $row->assignment_id }}">
                                <input type="hidden" name="student_id" value="{{ Auth::id() }}">
                                <input type="file" name="attached_file">
                                <button type="submit" class="btn btn-flat btn-outline-success btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Submit Assignment">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
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
