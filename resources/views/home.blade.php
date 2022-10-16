@include('app.header')


<header class="bg-dark pt-4 ">
    <div id="carouselExampleCaptions" class="carousel slide bg-dark rounded-bottom " data-bs-ride="carousel" style="height: 60vh;">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <a href=""><img src="{{ asset('assets/images/ros.jpg') }}" height="370" class="d-block w-auto m-auto" alt="..."></a>
            <div class="carousel-caption d-none d-md-block ">
              <h5 class="bg-dark p-2">First slide label</h5>
              <p class="bg-dark p-2">Some representative placeholder content for the first slide.</p>
            </div>
          </div>
          <div class="carousel-item">
            <a href=""><img src="{{ asset('assets/images/luffy.jpg') }}" height="370" class="d-block w-auto m-auto" alt="..."></a>
            <div class="carousel-caption d-none d-md-block ">
              <h5 class="bg-dark p-2">Second slide label</h5>
              <p class="bg-dark p-2">Some representative placeholder content for the second slide.</p>
            </div>
          </div>
          <div class="carousel-item">
            <a href=""><img src="{{ asset('assets/images/jk.jpg') }}" height="370" class="d-block w-auto m-auto" alt="..."></a>
            <div class="carousel-caption d-none d-md-block ">
              <h5 class="bg-dark p-2">Third slide label</h5>
              <p class="bg-dark p-2">Some representative placeholder content for the third slide.</p>
            </div>
          </div>
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

    <section class="py-3 px-5 bg-info w-100 m-auto row  ">
        <div class="col text-center mb-3">
            <a class="btn btn-success border border-dark border-3 rounded-pill " href="{{ route('gallery.newPost') }}"><i class="bi bi-plus-circle "> منشور جديد</i></a>

        </div>
        <div class="col text-center">

            <input type="search" name="search" placeholder="بـحـث" class="py-1 px-3 rounded-pill border border-3 border-warning bg-dark text-light" >

        </div>
    </section>

    @if (session()->has('delete'))
    <div class="mx-auto bg-danger text-light fw-bold px-4 py-2 text-center ">
        {{ session()->get('delete') }}
    </div>
    @endif


    <section class="py-3 bg-info">
        <div class="container px-5 px-sm-4 px-lg-2 mt-5">
            <div class="row gx-3 gx-lg-5 row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 justify-content-center">

    @foreach ( $posts as $post )
   <div class="col mb-5">
                <div class="card border border-0">
                    <!-- Product image-->
                    <img class="card-img-top" src="{{ asset($post->image_path) }}"  alt="..." />
                    <!-- Product details-->
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
                            <p class="">{{ $post->user->name }}</p>
                        </div>
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
