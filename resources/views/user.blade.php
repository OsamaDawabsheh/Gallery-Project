@include('app.header')

    {{-- show user page with his posts  --}}

<section class="py-5 bg-info">
    <div class="container px-5 px-sm-4 px-lg-2 mt-5">
        <div class="row gx-3 gx-lg-5 row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 justify-content-center">

@foreach ( $posts as $post )
<div class="col mb-5">
            <div class="card h-100 border border-0">
                <img class="card-img-top" src="{{ asset($post->image_path) }}" height="200"   alt="..." />
                @if (session()->has('user') && session('user')['id'] == $post->user_id)
                <p class="position-absolute bg-danger text-light py-2 px-3 rounded-pill m-2">{{ $post->state }}</p>
                @endif
                <div class="card-body p-4">
                    <div class="text-center">
                        <h5 class="card-title fw-bold">{{ $post->title }}</h5>
                        <div class="card-text mt-3 ">
                        </div>
                        <div class="text-center mt-4">
                        <a class="btn btn-primary mt-auto rounded-pill" href="{{ route('gallery.post',$post->id) }}">مزيد ...</a>
                        </div>
                    </div>
                </div>
                <div class="card-footer border-top-0 bg-transparent pb-0 text-secondary">
                    <div class="text-center"><p>{{ explode(' ', $post->created_at)[0] }}</p></div>
                </div>

            </div>
        </div>

@endforeach
</div>
</div>
</section>

<div class="d-flex justify-content-center align-items-center my-auto p-3 bg-info ">
        {{ $posts->links() }}
  </div>


@include('app.footer')

