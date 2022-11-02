@include('app.header')

    {{-- show home page  --}}


{{-- header slider contain top three posts of the higher rates --}}
@if ($topPosts->count() != 0)

<header class="bg-dark">
    <div id="carouselExampleCaptions" class="carousel slide bg-dark rounded-bottom " data-bs-ride="carousel" >
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>

        <div class="carousel-inner pt-3 pb-5">

            @foreach ($topPosts as $topPost )
            @if ($topPosts[0] == $topPost)
                <div class="carousel-item active">
            @else
                <div class="carousel-item ">

             @endif

                    <a  class="d-flex justify-content-center" href="{{ route('gallery.post', $topPost->post->id) }}"><img src="{{ $topPost->post->image_path }}" height="370" class="d-block w-auto m-auto" alt="..."></a>
                    <div class="carousel-caption d-none d-md-block ">
                        <h5 class="bg-dark p-2">{{ $topPost->post->title }}</h5>
                        <p class="bg-dark p-2"> من قبل : <a class="text-decoration-none text-primary" href="{{ route('gallery.user',$topPost->post->user_id) }}">{{ $topPost->post->user->name }}</a></p>
                    </div>
                </div>

             @endforeach

        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
    </div>
</header>
@endif



    <section class="py-3 px-5 bg-info w-100 m-auto row">
        {{-- create new post --}}
        <div class="text-center my-4">
            <a class="btn btn-success border border-dark border-3 rounded-pill " href="{{ route('gallery.newPost') }}"><i class="bi bi-plus-circle "> منشور جديد</i></a>
        </div>

        @if ($posts->count() != 0)
        {{-- search --}}
       <div class="d-flex justify-content-center " >
              <form class=" " action="{{ route('gallery.search') }}" method="GET" enctype="multipart/form-data">
                <div class="d-flex mb-3 ">
                <p class="mx-1 mb-2 fw-bold py-2">البحث باستخدام :</p>
                <select name="filter" class="form-select bg-dark text-light border border-3 border-warning rounded-pill text-center w-50" aria-label="Default select example">
                <option value="title" selected>العنوان</option>
                <option value="description">الوصف</option>
                <option value="position">المكان</option>
                <option value="name">المستخدم</option>
                <option value="rate">التقييم</option>
                <option value="created_at">التاريخ</option>
                </select>
                </div>
                <div class="d-flex">
                <input type="search" name="search" placeholder="بـحـث" class="mx-2 px-3 rounded-pill border border-3 border-warning bg-dark text-light" >
                <button class="bg-dark text-light rounded-circle border border-3 border-warning py-2 px-3" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>
        @endif

    </section>

            {{-- show when user delete a post --}}
    @if (session()->has('delete'))
    <div class="mx-auto bg-danger text-light fw-bold px-4 py-2 text-center ">
        {{ session()->get('delete') }}
    </div>
    @endif


    {{-- showing posts --}}
    <section class="py-3 bg-info">
        <div class="container px-5 px-sm-4 px-lg-2 mt-5">
            <div class="row gx-3 gx-lg-5 row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 justify-content-center">

        @if ($posts->count() != 0)
    @foreach ( $posts as $post )
   <div class="col mb-5">
                <div class="card border border-0">
                    <img class="card-img-top" src="{{ asset($post->image_path) }}" height="200" alt="..." />
                    <div class="card-body p-4">

                        <div class="text-center">
                            <h5 class="card-title fw-bold">{{ $post->title }}</h5>
                            <div class="card-text mt-3 ">
                                <div class="text-center mt-4">
                                    <a class="btn btn-primary mt-auto rounded-pill" href="{{ route('gallery.post',$post->id) }}">مزيد ...</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer border-top-0 bg-transparent pb-0 text-secondary">
                        <div class="d-flex justify-content-evenly text-center">
                            <p class="">{{ explode(' ', $post->created_at)[0] }}</p>
                            <a class="text-decoration-none text-primary" href="{{ route('gallery.user',$post->user_id) }}">{{ $post->user->name }}</a>
                        </div>
                    </div>

                </div>
            </div>

    @endforeach
        @else
            <div class="fw-bold text-center text-dark fs-5 p-5 ">لا يــوجــد نـتـائـج </div>

        @endif

</div>
</div>
</section>

    {{-- number of pages of posts --}}
<div class="d-flex justify-content-center align-items-center my-auto p-3 bg-info ">
    {{ $posts->links() }}
</div>


@include('app.footer')
