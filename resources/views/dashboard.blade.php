    @include('app.dashboardHeader')


    {{-- admin dashboard page --}}



    {{-- show top three posts that have higher rates  --}}
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
                    <div class="text-center text-light mt-3">
                        <h5 class="p-2">{{ $topPost->post->title }}</h5>
                        <p class="p-2"> من قبل : <a class="text-decoration-none text-primary" href="{{ route('gallery.user',$topPost->post->user_id) }}">{{ $topPost->post->user->name }}</a></p>
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


    {{-- show a chart for a number of posts in last five years --}}

<section class="py-5 bg-dark" >
<div class="m-auto w-75" id="chartContainer" ></div>
</section>



<hr class="m-0">



    {{-- show a table of columns that contain a basic information of posts with ability to serach  --}}
  <section class="p-3 bg-dark ">


      @if ($posts->count() != 0)

       <div class="d-flex justify-content-center my-3" >
              <form class=" " action="{{ route('gallery.search') }}" method="GET" enctype="multipart/form-data">
                <div class="d-flex mb-3 ">
                <p class="mx-1 mt-2 fw-bold w-75 text-center align-middle text-light">البحث باستخدام :</p>
                <select name="filter" class="form-select w-50 bg-dark text-light border border-3 border-warning rounded-pill text-center" aria-label="Default select example">
                <option value="title" selected>العنوان</option>
                <option value="name">المستخدم</option>
                <option value="rate">التقييم</option>
                </select>
                </div>
                <div class="d-flex">
                <input type="search" name="search" placeholder="بـحـث" class="mx-2 px-3 rounded-pill border border-3 border-warning bg-dark text-light" >
                <button class="bg-dark text-light rounded-circle border border-3 border-warning py-2 px-3" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>


                        <div class="table-responsive px-5 mb-3">
                                <table class="table table-dark table-bordered text-center align-middle">
                                    <thead class="text-warning" >
                                        <tr>
                                            <th>تنزيل</th>
                                            <th>اسم المستخدم</th>
                                            <th>الصورة</th>
                                            <th>العنوان</th>
                                            <th>التقييم</th>
                                        </tr>
                                    </thead>
                                    <tfoot class="text-warning">
                                        <tr>
                                            <th>تنزيل</th>
                                            <th>اسم المستخدم</th>
                                            <th>الصورة</th>
                                            <th>العنوان</th>
                                            <th>التقييم</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                        @foreach ( $posts as $post )
                                        <tr>
                                            <td class="col-1"><a class="btn btn-primary rounded-pill " href="{{ route('gallery.download',$post->id) }}" ><i class="bi bi-download "></i></a></td>
                                            <td class="col-2">{{ $post->user->name }}</td>
                                            <td class="col-2"><img class="" src="{{ asset($post->image_path) }}" width="60" height="40" alt="..." /></td>
                                            <td class="col-4">{{ $post->title }}</td>
                                            <td class="col-1">{{ $post->avg->avg }}</td>
                                        </tr>
                        @endforeach
                                    </tbody>
                                </table>
                        </div>

      </div>
        @else
            <div class="fw-bold text-center text-dark fs-5 p-5 ">لا يــوجــد نـتـائـج </div>

        @endif
       </div>


</section>

<div class="d-flex justify-content-center align-items-center my-auto p-3 bg-dark">
    {{ $posts->links() }}
</div>




                @include('app.dashboardFooter')
                @include('app.chart')
