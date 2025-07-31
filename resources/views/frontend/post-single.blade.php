<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

@extends('frontend.layouts.master')

@section('content')
    <!-- Header Start -->
    <div class="container-fluid bg-breadcrumb-post" style="background-image: url({{ asset('storage/' . $post->image) }});">
        <div class="container text-center py-5" style="max-width: 900px;">

            <h4 class="text-white display-4 mb-4 wow fadeInDown" data-wow-delay="0.1s">{{ $post->title }}</h4>

        </div>
    </div>
    <!-- Header End -->


    <!-- Blog Start -->
    <div class="container-fluid blog">
        <div class="container py-5">
            <div class="d-flex flex-column mx-auto text-center mb-5 wow fadeInUp" data-wow-delay="0.2s"
                style="max-width: 800px;">
                <h4 class="text-primary">Our Blog</h4>
                <h1 class="display-4 mb-4">{{ $post->title }}</h1>
                <p class="mb-0">{{ $post->body }}</p>
            </div>
        </div>
    </div>
    <!-- Blog End -->

    <!-- Comment List -->
    <div class="container"> <!-- Add a Bootstrap container -->
        <div class="row justify-content-center"> <!-- Use a row and justify-content-center -->
            <div class="col-lg-8 col-md-10"> <!-- Define column width for responsiveness -->
                <div class="p-5 rounded">
                    <h2 class="mb-4">{{ $post->comments->count() }} Comments</h2>
                    @foreach ($post->comments as $comment)
                        @php
                            $commentTime = $comment->created_at->timezone('Asia/Colombo');
                        @endphp
                        <div class="media mb-4">
                            <img src="https://www.gravatar.com/avatar/?d=mp" alt="User"
                                class="img-fluid rounded-circle mr-3 mt-1" style="width: 45px;">

                            <div class="media-body">
                                <h6>
                                    {{ $comment->user->name ?? 'Guest' }}
                                    <small>
                                        <i>{{ $commentTime->format('d M Y') }} at {{ $commentTime->format('h:i A') }}</i>
                                    </small>
                                </h6>
                                <p>{{ $comment->comment }}</p>
                                <button class="btn btn-sm btn-light">Reply</button>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>

    {{-- 
    <div class="mb-4 border p-3 rounded">
        <h2>{{ $post->title }}</h2>

        <h4>Comments:</h4>
        @forelse ($post->comments as $comment)
            <div class="bg-gray-100 p-2 rounded my-1">
                <strong>{{ $comment->user?->name ?? 'Guest' }}</strong>:
                {{ $comment->comment }}
            </div>
        @empty
            <p>No comments yet.</p>
        @endforelse
    </div> --}}


    <!-- Comment Start -->

    <div class="bg-light p-5 rounded">
        <h2 class="mb-4">Leave a comment</h2>
        <form method="POST" action="{{ route('comments.index', $post->id) }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="blog_id" value="{{ $post->id }}">

            <div class="form-group mb-3">
                <label for="message">Comment *</label>
                <textarea id="message" name="comment" cols="20" rows="5" class="form-control"
                    placeholder="Enter your comment here..." required></textarea>
            </div>

            <div class="form-group mb-0">
                <input type="submit" value="Leave Comment" class="btn btn-primary px-3" />
            </div>
        </form>
    </div>


    <!-- Comment End -->
@endsection
