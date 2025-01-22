@extends("layouts.app")

@section("title", "User Panel")
@section("content")

<!-- JQuery CDN -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<div class="container text-center mt-5">
    <!-- Success Alert -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Welcome Section -->
    <div class="mb-5">
        <h1 class="display-4 text-primary font-weight-bold">Welcome to Task Tracker</h1>
        <p class="lead text-muted">Track your tasks and stay on top of your to-dos.</p>
    </div>    
    
    <!-- Task Table -->
    <div class="table-responsive shadow-sm rounded-3">
        <table class="table table-hover table-striped">
            <thead class="table-dark" style="position: sticky; top: 0; z-index: 1;">
                <tr>
                    <th scope="col" class="fw-bold">Image</th>
                    <th scope="col" class="fw-bold">Title</th>
                    <th scope="col" class="fw-bold">Description</th>
                    <th scope="col" class="fw-bold">Status</th>
                    <th scope="col" class="fw-bold">Due Date</th>
                    <th scope="col" class="fw-bold">Action</th>
                    <th scope="col" class="fw-bold">View Task</th>
                </tr>
            </thead>
            <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td><img src="{{ asset('assets/' . $task->image) }}" alt="{{ $task->title }}" class="img-fluid" style="width: 50px;"></td>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>
                            @if($task->isCompleted == 1)
                                <span class="badge bg-success d-flex align-items-center justify-content-center p-2">
                                    <i class="bi bi-check-circle me-2"></i> Completed
                                </span>
                            @else
                                <span class="badge bg-warning d-flex align-items-center justify-content-center p-2">
                                    <i class="bi bi-hourglass-split me-2"></i> Pending
                                </span>
                            @endif
                        </td>                        
                        <td>{{ $task->due_date }}</td>
                        <td>
                            @if($task->isCompleted == 0)
                                <a href="{{ route('doneTask', $task->id) }}" class="btn btn-success btn-sm">Mark as Completed</a>
                            @else
                                <a href="{{ route('resetTask', $task->id) }}" class="btn btn-danger btn-sm">Mark as Unfinished</a>
                            @endif
                        </td>                        
                        <td>
                            <a href="{{ route('viewTask', $task->id) }}" class="btn btn-primary w-100">View Task</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection