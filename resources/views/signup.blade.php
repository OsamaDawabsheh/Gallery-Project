
    @include('app.header')


    @if($errors->any())
    <div class="p-5 pb-0 m-auto text-center col-12 col-md-8 col-lg-6 col-xl-4">
            <div class="bg-danger text-light fw-bold rounded-t px-4 py-2">يرجى تصحيح الاخطاء الاتية ... </div>
            <ul class="rounded-b bg-red-100 px-4 py-2" style="background: rgba(200,200,200);">
                @foreach ($errors->all() as $error )
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
            @endif

    @if (session()->has('signupMsg'))
    <div class="m-5 mx-auto bg-success text-light fw-bold px-4 py-2 text-center col-12 col-md-8 col-lg-6 col-xl-4">
        {{ session()->get('signupMsg') }}
    </div>
    @endif

    <div class="container p-4 pt-0 my-4 create" >
        <div class="row d-flex justify-content-center align-items-center ">
            <div class="col-12 col-md-8 col-lg-6 col-xl-4 bg-dark text-light py-5 px-3 border border-warning border-5 ">

            <form action="{{ route('gallery.insertUser') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div>
                    <h1 class="text-center mb-4 ">التسجيل</h1>
                    <img class="rounded-circle mb-3 m-auto d-block " width="100" src="{{ asset('assets/images/login.png') }}" alt="">
                </div>
                <div>
                    <label class="form-label" for="name">اسم المستخدم :</label>
                    <input class="form-control" type="text" name="name">
                </div>
                <div>
                    <label class="form-label mt-3" for="email">البريد الالكتروني : </label>
                    <input class="form-control" type="email" name="email">
                </div>
                <div>
                    <label class="form-label mt-3" for="password">كلمة المرور : </label>
                    <input class="form-control" type="password" name="password">
                </div>
                <div>
                    <label class="form-label mt-3" for="password_repeat">تأكيد كلمة المرور :  </label>
                    <input class="form-control" type="password" name="password_repeat">
                </div>
                    <button class="btn mt-5 btn-danger w-100 " type="submit" >تسجيل</button>
            </form>
            <div class="mt-5 d-flex">
                <p class="mx-auto d-flex justify-content-center align-items-center">هل لديك حساب بالفعل ؟ <a href="{{ route('gallery.login') }}" class="text-light bg-success p-2 rounded-pill m-auto mx-2" style="text-decoration: none">تسجيل الدخول</a></p>
            </div>
        </div>
        </div>
    </div>

    </div>

    @include('app.footer')
