@extends("layouts.app")

@section("title", "Edit Task")
@section("content")

<!-- JQuery CDN -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<div class="container mt-4">
    <div class="text-center">
        <!-- Success Alert -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Error Alert -->
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <div class="mb-4">
        <h1 class="text-primary">Edit Task</h1>
        <p class="text-muted">Update the details of your task below to keep everything organized.</p><hr>
    </div>

    <form action="{{ route('edit.submit', $task->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

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
                        <input type="file" class="form-control" id="image" name="image">
                        <label class="input-group-text" for="image">Upload</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Task Title:</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ $task->title }}" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Task Description:</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ $task->description }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="due_date" class="form-label">Task Due Date:</label>
                    <input type="date" class="form-control" id="due_date" name="due_date" min="{{ date('Y-m-d') }}" value={{ $task->due_date}} required>
                </div>
    
                <button type="submit" class="btn btn-primary w-100 mt-3 mb-3">Submit</button>
            </div>
        </div>
    </form>
</div>

@endsection

@section('scripts')
    <script src="{{ asset('assets/js/edit.js') }}"></script>
@endsection