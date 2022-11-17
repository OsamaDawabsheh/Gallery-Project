
    {{-- home navbar --}}


<nav class="navbar navbar-expand-lg m-0 p-0 @if (explode('.',Route::currentRouteName())[1]!='login'
                && explode('.',Route::currentRouteName())[1]!='signup'&& explode('.',Route::currentRouteName())[1]!='contact')
                 bg-dark @endif navbar-dark sticky-top" id="navbar">
    <div class="container ">
        <a class="navbar-brand" href="{{ route('gallery.home') }}"><img src="{{ asset('assets/images/website/logo.png') }}" alt="" width="160" height="40"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav mb-2 mb-lg-0 ms-lg-4 links">
                <li class="nav-item mx-3 my-2"><a class="nav-link fw-bold active" aria-current="page" href="{{ route('gallery.home') }}">الصفحة الرئيسية</a></li>
                <li class="nav-item mx-3 my-2"><a class="nav-link fw-bold active" aria-current="page" href="{{ route('gallery.contact') }}">اتصل بنا</a></li>
            </ul>
            @if (explode('.',Route::currentRouteName())[1] == "home" || explode('.',Route::currentRouteName())[1] == "search")
            <ul class="navbar-nav mb-2 mb-lg-0  justify-content-end">
                <li class="nav-item mx-3 my-2"><button class="bg-dark text-light rounded-circle border border-3 border-primary px-3 py-2" onclick="search()"><i class="bi bi-search"></i></button></li>
            </ul>
            @endif
                <ul class="navbar-nav w-sm-100 mb-2 ">
                @if (session()->has('user'))
                <li class="nav-item dropdown bg-primary rounded-pill  px-1 mx-3 my-2 text-center  ">
                    <a class="nav-link dropdown-toggle text-light" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ session('user')['name'] }} </a>
                    <ul class="dropdown-menu dropdown-menu-dark rounded-pill text-center w-100 mt-2 mb-4 m-auto fixed-top" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item rounded-pill w-75 m-auto" href="{{ route('gallery.user',[session('user')['id'],"الكل"] ) }}">الملف الشخصي</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item rounded-pill w-75 m-auto" href="{{ route('gallery.signout') }}">تسجيل الخروج</a></li>
                    </ul>
                </li>
                @else
                <li class="nav-item text-center my-2 mx-2"><a class="nav-link text-warning fw-bold" href="{{ route('gallery.login') }}">تسجيل الدخول</a></li>
                @endif

            </ul>
        </div>
   </div>



</nav>

