


<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container ">
        <a class="navbar-brand" href="{{ route('gallery.home') }}"><img src="{{ asset('assets/images/logo.png') }}" alt="" width="160" height="40"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav w-100 mb-2 mb-lg-0 ms-lg-4">
                <li class="nav-item mx-3 my-2"><a class="nav-link fw-bold active" aria-current="page" href="{{ route('gallery.home') }}">الصفحة الرئيسية</a></li>
                <li class="nav-item mx-3 my-2"><a class="nav-link" href="#!">حول</a></li>
                </ul>
                <ul class="navbar-nav w-100 mb-2 mb-lg-0 ms-lg-4 justify-content-end">
                @if (session()->has('user'))
                <li class="nav-item dropdown bg-primary rounded-pill  px-1 mx-3 my-2 text-center 100 ">
                    <a class="nav-link dropdown-toggle text-light" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ session('user')['name'] }} </a>
                    <ul class="dropdown-menu dropdown-menu-dark rounded-pill text-center w-75 mt-2 mb-4 m-auto" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item rounded-pill w-75 m-auto" href="{{ route('gallery.user', session('user')['id'])  }}">Profile</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item rounded-pill w-75 m-auto" href="{{ route('gallery.signout') }}">Sign out</a></li>
                    </ul>
                </li>
                @else
                <li class="nav-item text-center my-2 mx-2"><a class="nav-link text-warning fw-bold" href="{{ route('gallery.login') }}">تسجيل الدخول</a></li>
                @endif

            </ul>
        </div>
    </div>
</nav>
