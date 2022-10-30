
    @include('app.header')

        {{-- show login page  --}}

    @if($errors->any())
    <div class="p-5 pb-0 m-auto text-center col-12 col-md-8 col-lg-6 col-xl-4">
            <div class="bg-danger text-light fw-bold rounded-t px-4 py-2">يرجى تصحيح الاخطاء الاتية ... </div>
            <ul class="rounded-b bg-red-100 px-4 py-2" >
                @foreach ($errors->all() as $error )
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
            @endif

    @if (session()->has('loginMsg'))
    <div class="mt-5 mx-auto bg-danger text-light fw-bold px-4 py-2 text-center col-12 col-md-8 col-lg-6 col-xl-4">
        {{ session()->get('loginMsg') }}
    </div>
    @endif


    <div class="container p-4 my-4 " >
        <div class="row d-flex justify-content-center align-items-center ">
            <div class="col-12 col-md-8 col-lg-6 col-xl-4 bg-dark text-light py-5 px-3 border border-warning border-5">

            <form action="{{ route('gallery.extractUser') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <h1 class="text-center mb-5 ">تسجيل الدخول</h1>
                    <img class="rounded-circle mb-4 m-auto d-block " width="100" src="{{ asset('assets/images/website/userLogo.png') }}" alt="">
                </div>
                <div>
                    <label class="form-label" for="email">البريد الالكتروني : </label>
                    <input class="form-control" type="email" name="email">
                </div>
                <div>
                    <label class="form-label mt-3" for="password">كلمة المرور : </label>
                    <input class="form-control" type="password" name="password">
                </div>
                    <button class="btn mt-5 btn-primary w-100 " type="submit">دخــول</button>
            </form>
            <div class="mt-5 d-flex">
                <p class="mx-auto">ليس لديك حساب ؟ <a href="{{ route('gallery.signup') }}" class="text-light bg-danger mx-2 rounded-pill m-auto py-1 px-2 loginToSignup" >تسجيل </a></p>
            </div>

        </div>
        </div>
    </div>

    </div>

    @include('app.footer')
