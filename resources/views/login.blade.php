
    @include('app.header')

        {{-- show login page  --}}


    @if (session()->has('loginMsg'))
    <div class="mt-5 mx-auto bg-danger text-light fw-bold px-4 py-2 text-center col-12 col-md-8 col-lg-6 col-xl-4">
        {{ session()->get('loginMsg') }}
    </div>
    @endif


    <div class="" >
        <div class="p-5 d-flex justify-content-center align-items-center ">
            <div class="col-10 col-sm-7 col-md-5 col-lg-4 col-xl-3 text-light py-3 px-3 ">

            <form action="{{ route('gallery.extractUser') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <h3 class="text-center mb-5">تسجيل الدخول</h3>
                    <img class="rounded-circle mb-4 m-auto d-block " width="60" src="{{ asset('assets/images/website/userLogo.png') }}" alt="">
                </div>
                <div>
                    <label class="form-label" for="email">البريد الالكتروني : </label>
                    <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email">
                    @if ($errors->has('email'))
                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                    @endif
                </div>
                <div>
                    <label class="form-label mt-3" for="password">كلمة المرور : </label>
                    <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password">
                    @if ($errors->has('password'))
                    <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                    @endif
                </div>
                    <button class="btn mt-5 btn-primary w-100 submit " type="submit">دخــول</button>
            </form>
            <div class="mt-5 d-flex">
                <p class="mx-auto">ليس لديك حساب ؟ <a href="{{ route('gallery.signup') }}" class="text-light bg-danger mx-2 rounded-pill m-auto py-1 px-2 loginToSignup" >تسجيل </a></p>
            </div>

        </div>
        </div>
    </div>

    </div>

    {{-- @include('app.footer') --}}
