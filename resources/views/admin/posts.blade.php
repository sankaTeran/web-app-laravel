@extends('admin.layouts.master')

@section('content')
    <div class="container-fluid px-4">
        <h1 class="mt-4">Blog</h1>
    </div>
    <div>
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Add New Post
        </button>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" action="/postsStore" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <!-- Title -->
                        <div class="mb-3">
                            <label for="post_title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="post_title" name="post_title"
                                placeholder="Post Title" style="padding-left: 15px;">
                        </div>

                        <!-- Slug -->
                        <div class="mb-3">
                            <label for="post_slug" class="form-label">Slug</label>
                            <input type="text" class="form-control" id="post_slug" name="post_slug" placeholder="Slug">
                        </div>
                        <!-- Body -->
                        <div class="mb-3">
                            <label for="post_body" class="form-label">Body</label>
                            <textarea class="form-control" id="post_body" name="post_body" rows="15"></textarea>
                        </div>
                        <!-- Image Upload -->
                        <div class="mb-3">
                            <label for="post_image" class="form-label">Image Upload</label>
                            <input type="file" class="form-control" id="post_image" name="post_image">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!--END Modal -->

    <div class="row">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                All Posts
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Title</th>
                            <th>Slug</th>
                            <th>Body</th>
                            <th>Created At</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ $post->slug }}</td>
                                <td>{{ $post->body }}</td>
                                <td>{{ $post->created_at }}</td>
                                <td><img width="100" src="{{ asset('storage/' . $post->image) }}" alt="" />"</td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#slideModal{{ $post->id }}">Edit</button>
                                    <a href="/postsDelete/{{ $post->id }}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>

                            <div class="modal fade" id="slideModal{{ $post->id }}" tabindex="-1"
                                aria-labelledby="slideModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="slideModalLabel">Edit Post {{ $post->id }}
                                            </h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form method="POST" action="/postsUpdate" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <input type="hidden" name="post_id" value="{{ $post->id }}">

                                                <!-- Title -->
                                                <div class="mb-3">
                                                    <label for="post_title" class="form-label">Title</label>
                                                    <input type="text" class="form-control" id="post_title"
                                                        name="post_title" value="{{ $post->title }}">
                                                </div>

                                                <!-- Slug -->
                                                <div class="mb-3">
                                                    <label for="post_slug" class="form-label">Slug</label>
                                                    <input type="text" class="form-control" id="post_slug"
                                                        name="post_slug" placeholder="Slug" value="{{ $post->slug }}">
                                                </div>
                                                <!-- Body -->
                                                <div class="mb-3">
                                                    <label for="post_body" class="form-label">Body</label>
                                                    <textarea class="form-control" id="post_body" name="post_body" rows="15">{{ $post->body }}</textarea>
                                                </div>

                                                <!-- Image Upload-->
                                                <div class="mb-3">
                                                    <label for="post_image" class="form-label">Image Upload</label>
                                                    <input type="file" class="form-control" id="post_image"
                                                        name="post_image">

                                                    <!--show current image -->
                                                    @if ($post->image)
                                                        <img src="{{ asset('storage/' . $post->image) }}"
                                                            alt="Current Image" class="mt-2"
                                                            style="max-height: 150px;">
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
            </div>
            @endforeach


            </tbody>
            </table>
        </div>
    </div>


@endsection
