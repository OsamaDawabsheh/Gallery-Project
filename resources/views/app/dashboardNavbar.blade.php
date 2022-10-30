
    {{-- dashboard navbar  --}}

<nav class=" navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">

            <a class="navbar-brand ps-3" href="{{ route('gallery.admin') }}"><img src="{{ asset('assets/images/website/logo.png') }}" alt="" width="160" height="40"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse " id="navbarSupportedContent">

                <ul class="navbar-nav w-100 mb-2 mb-lg-0 ms-lg-4 justify-content-start ">
                    <li class="nav-item mx-2"> <a class="nav-link fw-bold active" href="{{ route('gallery.admin') }}">اللوحة الرئيسية</a></li>

                    <li class="nav-item dropdown mx-2">
                    <a class="nav-link dropdown-toggle text-light" id="layoutDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"> الجداول </a>
                        <ul class="dropdown-menu dropdown-menu-dark text-center w-100 mt-2 mb-4 m-auto " aria-labelledby="layoutDropdown">
                            <li><a class="dropdown-item rounded-pill m-auto" href="{{ route('gallery.Tables','users') }}">جدول المستخدمين</a></li>
                            <li><a class="dropdown-item rounded-pill m-auto" href="{{ route('gallery.Tables','posts') }}">جدول المنشورات</a></li>
                            <li><a class="dropdown-item rounded-pill m-auto" href="{{ route('gallery.Tables','rates') }}">جدول التقييمات</a></li>
                            <li><a class="dropdown-item rounded-pill m-auto" href="{{ route('gallery.Tables','comments') }}">جدول التعليقات</a></li>
                        </ul>
                    </li>

                </ul>


                    <ul class="navbar-nav w-75 mb-2 mb-lg-0 ms-lg-4 justify-content-end m-auto">
                        <li class="nav-item dropdown bg-primary rounded-pill  px-1 mx-3 my-2 text-center 100">
                            <a class="nav-link dropdown-toggle text-dark" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                            <ul class="dropdown-menu dropdown-menu-dark rounded-pill text-center w-75 mt-2 mb-4 m-auto" aria-labelledby="navbarDropdown">
                                <li><a class="dropdown-item rounded-pill w-75 m-auto" href="{{ route('gallery.signout') }}">تسجيل الخروج</a></li>
                            </ul>
                        </li>
                    </ul>
            </div>
            </div>
        </nav>
