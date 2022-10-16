@include('app.header')


<section class="p-3  " >

    <div class="m-auto col-12 col-md-10 col-lg-8 col-xl-8">

<div class="">
    <img class="w-100" src="{{ asset($post->image_path)}}" alt="">
</div>


<div class="py-4 px-5 text-center " style="background: rgba(200,200,200);" >
    <h3 class="mb-4">{{ $post->title}}</h3>
    <h6 class="mb-4">{{ $post->description}}</h6>
    <p class="mb-4"><i class="bi bi-geo-alt-fill text-danger"></i> {{ $post->position}}</p>

    <p>تم الرفع من قبل : {{ $post->user->name }}</p>


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

    @if (session()->has('user'))
    <div class="d-flex justify-content-center mb-5">
        <form  class="w-100" oninput="ratevalue.value = rate.valueAsNumber" action="{{ route('gallery.evaluate',$post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <button class="btn btn-danger py-3 px-3 border border-2 border-success rounded-circle" type="submit">قيّم</button>
            <label class="ms-2 me-3 bg-dark px-2 rounded-pill text-light" for="">1</label>
            <input type="range" class="form-range mx-1 mt-3 bg-dark px-2 rounded-pill w-50" name="rate" value="{{ isset($rate->rate)?$rate->rate:1 }}" step="1" min="1" max="5">
            <label class="mx-2 bg-dark px-2 rounded-pill text-light" for="">5</label>
        </form>
    </div >
    @endif


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




@include('app.footer')
