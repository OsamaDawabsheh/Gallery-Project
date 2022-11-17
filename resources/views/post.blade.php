@include('app.header')

        {{-- show post page  --}}

<section class="p-3 " >

<div class="m-auto col-12 col-md-10 col-lg-8 col-xl-8">

        {{-- post's image --}}
    <div class="">
        <img class="w-100" src="{{ asset($post->image_path)}}" alt="">
    </div>


    {{-- post's information --}}
    <div class="py-4 px-5 text-center text-light bg-dark" >
    <h3 class="mb-4">{{ $post->title}}</h3>
    <h6 class="mb-4">{{ $post->description}}</h6>
    <p class="mb-4"><i class="bi bi-geo-alt-fill text-danger"></i> {{ $post->position}}</p>

    <p> تم الرفع من قبل : <a class="text-decoration-none text-primary" href="{{ route('gallery.user' , [$post->user_id,'الكل']) }}"> {{ $post->user->name }}</a></p>


    {{-- post's rate --}}
    <div class="ratings my-5">
            @if ( $avg )


            <div class="mb-3">
            <span class="product-rating bg-success text-light p-2 mx-1">{{ $avg }}</span><span>/</span><span class="bg-dark text-light p-2 mx-1">5</span>
            </div>



        <div class="stars d-flex justify-content-center text-primary m-auto mb-2 ">
            @for ($i = 0 ; $i < (int)$avg ; $i++ )
            <div class="bi-star-fill fs-5"></div>
            @endfor
        </div>

        @endif

        <div class="rating-text">

            <span>  عدد التقييمات ( {{ $count }} )</span>

        </div>

    </div>

        {{-- evaluate the post --}}
    @if (session()->has('user'))
    <div class="d-flex justify-content-center mb-5">
        <form  class="w-100" oninput="ratevalue.value = rate.valueAsNumber" action="{{ route('gallery.evaluate',$post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
            <label class="mx-2 bg-light px-2 rounded-pill text-dark" for="">1</label>
            <input type="range" class="mx-1 mt-3 my-3 w-50" name="rate" value="{{ isset($rate->rate)?$rate->rate:1 }}" step="1" min="1" max="5">
            <label class="mx-2 bg-light px-2 rounded-pill text-dark" for="">5</label>
            </div>
            <button class="btn btn-danger py-3 px-3 mb-3 border border-2 border-success rounded-circle" type="submit">قيّم</button>
        </form>
    </div >
    @endif

        {{-- download the post's image and ability to edit od delete the post --}}
        @if (session()->has('user'))
                <div class="d-flex justify-content-center mb-2">
                <a class="btn btn-primary border border-dark border-3 py-2 px-3 rounded-pill mx-3 " href="{{ route('gallery.download',$post->id) }}" ><i class="bi bi-download fs-5"></i></a>
            @if (session('user')['id'] == $post->user_id)
                <a class="btn btn-warning border border-dark border-3 py-2 px-3 rounded-pill mx-3 " href="{{ route('gallery.edit',$post->id) }}"><i class="bi bi-pencil fs-5"></i></a>
                <form action="{{ route('gallery.remove',$post->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class=" btn btn-danger border border-dark border-3 py-2 px-3 rounded-pill mx-3"><i class="bi bi-trash fs-5"></i></button>
                </form>
            @endif
            </div>
        @endif
    </div>

</div>
</section>

<hr class="border border-dark border-2 bg-dark">

<section class="p-3">
        <h1 class="mb-4 d-flex justify-content-center">التعليقات</h1>
        <div class="m-auto col-12 col-md-10 col-lg-8 col-xl-8 bg-dark p-3">

            {{-- create a new comment  --}}
            @if (session()->has('user'))
            <form class="d-flex justify-content-center mt-3 mb-4" action="{{ route('gallery.comment',$post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <textarea class="w-100 py-1 ms-2 px-3 border border-2 border-primary rounded-pill commentArea" name="comment" placeholder="اترك تعليقاً ..." rows="1"> </textarea>
            <button class="rounded-circle px-2" type="submit"><i class="bi bi-send"></i></button>
            </form>

            @if ($errors->any())
            <div class="p-2 mt-2 m-auto text-center col-12 col-md-8 col-lg-6 col-xl-4 bg-danger text-light rounded-pill">
                 @foreach ($errors->all() as $error )
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </div>
            @endif

            {{-- ability to edit a comment  --}}
             @if (session()->has('commentEdit'))
    <div class="mt-t mx-auto bg-success text-light text-light rounded-pill fw-bold px-4 py-2 text-center col-12 col-md-8 col-lg-6 col-xl-4">
        {{ session()->get('commentEdit') }}
    </div>
    @endif

                {{-- ability to delete a comment  --}}
               @if (session()->has('commentDelete'))
    <div class="mt-t mx-auto bg-danger text-light text-light rounded-pill fw-bold px-4 py-2 text-center col-12 col-md-8 col-lg-6 col-xl-4">
        {{ session()->get('commentDelete') }}
    </div>
    @endif

            <hr class="border border-light border-2 bg-light">
            @endif


            @if ($comments->count() == 0)
            <div class="fw-bold text-center text-light fs-5 p-5 ">لا يــوجــد تعليقات </div>
            @endif

                {{-- show the comments of the post  --}}



        <div>

            @foreach ( $comments as $comment )
            @if($comment->post_id == $post->id)
            <div class="d-flex justify-content-between">
            <a class="text-decoration-none text-warning" href=""><img class="rounded-circle ms-2" src="{{ asset('assets/images/website/user.png') }}" width="26" alt=""> {{ $comment->user->name }} </a>
            @if (session()->has('user'))

            @if ($comment->user_id == session('user')['id'])
                <ul class="p-0 m-0">
                <li class="dropdown text-center ">
                    <a class="dropdown-toggle-no-caret text-light" id="commentDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-three-dots-vertical fs-5 "></i></a>
                    <ul class="dropdown-menu dropdown-menu-dark rounded-pill text-center w-75 mt-2 mb-4 m-auto" aria-labelledby="commentDropdown">
                        <li>
                                <a href="{{ route('gallery.editComment', $comment->id) }}" class="dropdown-item rounded-pill w-75 m-auto">تعديل</a>
                        </li>
                        <li><hr class="dropdown-divider" /></li>
                        <li>
                            <form class="d-flex justify-content-center" action="{{ route('gallery.deleteComment', $comment->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item rounded-pill w-75 m-auto">حذف</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
            @endif
             @endif

            </div>
            <p class="mb-3 mx-5 text-light">{{ $comment->comment }}</p>

            <hr class="bg-light">
            @endif
            @endforeach


        </div>

</div>

</section>



@include('app.footer')
