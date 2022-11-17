
    @include('app.header')

        {{-- show signup page  --}}

    @if (session()->has('signupMsg'))
    <div class="m-5 mx-auto bg-success text-light fw-bold px-4 py-2 text-center col-12 col-md-8 col-lg-6 col-xl-4">
        {{ session()->get('signupMsg') }}
    </div>
    @endif

    <div class="mt-5 mt-sm-3 " >
        <div class="d-flex justify-content-center align-items-center ">
            <div class="col-9 col-sm-6 col-md-5 col-lg-4 col-xl-3  text-light px-3  ">

            <form class="" action="{{ route('gallery.insertUser') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div>
                    <h3 class="text-center mb-4 ">التسجيل</h3>
                    <img class="rounded-circle mb-3 m-auto d-block " width="70" src="{{ asset('assets/images/website/userLogo.png') }}" alt="">
                </div>
                <div>
                    <label class="form-label" for="name">اسم المستخدم :</label>
                    <input class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" name="name">
                    @if ($errors->has('name'))
                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    @endif
                </div>
                <div>
                    <label class="form-label mt-2" for="email">البريد الالكتروني : </label>
                    <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email">
                    @if ($errors->has('email'))
                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                    @endif
                </div>
                <div>
                    <label class="form-label mt-2" for="password">كلمة المرور : </label>
                    <input class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" type="password" name="password" title="يجب ان تكون اطول من 8 وان تحتوي على احرف كبيرة وصغيرة وارقام ">
                    @if ($errors->has('password'))
                    <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                    @endif
                </div>
                <div>
                    <label class="form-label mt-2" for="password_repeat">تأكيد كلمة المرور :  </label>
                    <input class="form-control {{ $errors->has('password_repeat') ? ' is-invalid' : '' }}" type="password" name="password_repeat">
                    @if ($errors->has('password_repeat'))
                    <div class="invalid-feedback">{{ $errors->first('password_repeat') }}</div>
                    @endif
                </div>
                    <button class="btn mt-4 btn-danger w-100 submit" type="submit" >تسجيل</button>
            </form>
            <div class="mt-4 d-flex">
                <p class="mx-auto d-flex justify-content-center align-items-center">لديك حساب بالفعل ؟ <a href="{{ route('gallery.login') }}" class="text-light bg-success p-2 rounded-pill m-auto mx-2 text-center signupToLogin">تسجيل الدخول</a></p>
            </div>
        </div>
        </div>
    </div>

    </div>

    {{-- @include('app.footer') --}}
