@extends("layouts.app")

@section("title", "Create Task")
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
        <h1 class="text-primary">Create New Task</h1>
        <p class="text-muted">Fill in the details below to create a new task.</p><hr>
    </div>

    <form action="{{ route('create.submit') }}" method="post" enctype="multipart/form-data">
        @csrf

        <div class="row">
            <div class="col-md-3 mt-3 mb-3 text-center">
                <div class="card text-center border-0">
                    <div class="card-body">
                        <img src="https://cdn-icons-png.freepik.com/256/5968/5968253.png?ga=GA1.1.1815414687.1712627600&semt=ais_hybrid" 
                            alt="Preview" class="image img-fluid w-100 object-fit-contain" id="preview-image">
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
                        <input type="file" class="form-control" id="image" name="image" required>
                        <label class="input-group-text" for="image">Upload</label>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="title" class="form-label">Task Title:</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Enter Your Title" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Task Description:</label>
                    <textarea class="form-control" id="description" name="description" placeholder="Enter Your Description" rows="3"></textarea>
                </div>

                <div class="mb-3">
                    <label for="due_date" class="form-label">Task Due Date:</label>
                    <input type="date" class="form-control" id="due_date" name="due_date" min="{{ date('Y-m-d') }}" placeholder="Enter Your Due Date" required>
                </div>
    
                <button type="submit" class="btn btn-primary w-100 mt-3 mb-3">Submit</button>
            </div>
        </div>
    </form>
</div>

@endsection

@section('scripts')
    <script src="{{ asset('assets/js/create.js') }}"></script>
@endsection