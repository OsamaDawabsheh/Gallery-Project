@include('app.header')

        {{-- show comment edit page  --}}

            @if ($errors->any())
            <div class="p-2 mt-5 m-auto text-center col-12 col-md-8 col-lg-6 col-xl-4 bg-danger text-light rounded-pill">
                 @foreach ($errors->all() as $error )
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </div>
            @endif

    <div class="container p-4 mb-5 create" >
        <div class="row d-flex justify-content-center align-items-center  ">
            <div class="my-5 comment " >
                <h1 class="text-center mb-5">تعديل التعليق</h1>
                <div class="bg-dark m-auto w-100 p-5 rounded-pill" >
                    <form class="d-flex w-100" action="{{ route('gallery.updateComment',$commentText->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <textarea class="w-100 py-1 ms-2 px-3 border border-2 border-primary rounded-pill commentArea" rows="1" name="comment" > {{ $commentText->comment }}</textarea>
                        <button class="rounded-circle px-2" type="submit"><i class="bi bi-send"></i></button>
                    </form>
                </div>
            </div>
        </div>
    </div>


@include('app.footer')
