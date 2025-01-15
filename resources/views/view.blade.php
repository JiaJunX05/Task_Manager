@extends("layouts.app")

@section("title", "Create Task")
@section("content")

<!-- JQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<div class="container mt-4">
    <div class="mb-4">
        <h1 class="text-primary">View My Task</h1>
        <p class="text-muted">Here you can view the details of your task, track its progress, and manage its status.</p><hr>
    </div>

    <div class="row">
        <div class="col-md-3 mt-3 mb-3 text-center">
            <div class="card text-center border-0">
                <div class="card-body">
                    <img src="{{ asset('assets/' . $task->image) }}" alt="{{ $task->title }}" 
                        class="image img-fluid w-100 object-fit-contain" id="preview-image">
                </div>
                <div class="card-footer bg-transparent border-0">
                    <p class="text-center fst-italic mt-3 mb-3">
                        With Knowledge Comes Power, <br>
                        With Attitude Comes Character.
                    </p>
                </div>
            </div>
        </div>            
                 
        <div class="col-md-9">
            <div class="mb-3">
                <label for="image" class="form-label">Task Image:</label>
                <div class="input-group">
                    <input type="file" class="form-control" id="image" name="image" disabled>
                    <label class="input-group-text" for="image">Upload</label>
                </div>
            </div>

            <div class="mb-3">
                <label for="title" class="form-label">Task Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $task->title}}" readonly>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Task Description:</label>
                <textarea class="form-control" id="description" name="description" rows="3" readonly>{{ $task->description}}</textarea>
            </div>

            <div class="mb-3">
                <label for="due_date" class="form-label">Task Due Date:</label>
                <input type="date" class="form-control" id="due_date" name="due_date" min="{{ date('Y-m-d') }}" value="{{ $task->due_date }}" readonly>
            </div>
    
            <div class="d-flex justify-content-between">
                <!-- Edit Button -->
                <a href="{{ route('editTask', $task->id)}}" class="btn btn-warning w-50 me-2">Edit</a> 
            
                <!-- Delete Button -->
                <form action="{{ route('deleteTask', $task->id)}}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');" class="w-50">
    
                    @csrf
                    @method('DELETE')
    
                    <button type="submit" class="btn btn-danger w-100">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection