@include('app.dashboardHeader')

        {{-- show database table for admin --}}

        {{-- users table with ability to search using filtering--}}
@if (isset($users))

    <div class="mt-3 mb-5 text-center"><h1 class="fw-bold">جدول المستخدمين</h1></div>


       <div class="d-flex justify-content-center mb-5 mt-5" >
              <form class=" " action="{{ route('gallery.tableSearch','users') }}" method="GET" enctype="multipart/form-data">
                <div class="d-flex mb-3 ">
                <p class="mx-1 mt-2 fw-bold w-75 text-center align-middle">البحث باستخدام :</p>
                <select name="filter" class="form-select w-50 bg-dark text-light border border-3 border-warning rounded-pill text-center" aria-label="Default select example">
                <option value="name" selected>الاسم</option>
                <option value="email">البريد الالكتروني</option>
                <option value="created_at">تاريخ الانشاء</option>
                </select>
                </div>
                <div class="d-flex">
                <input type="search" name="search" placeholder="بـحـث" class="mx-2 px-3 rounded-pill border border-3 border-warning bg-dark text-light" >
                <button class="bg-dark text-light rounded-circle border border-3 border-warning py-2 px-3" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>

                        <div class="table-responsive px-5 mb-3">
                                <table class="table table-dark table-bordered text-center align-middle">
                                    <thead class="text-warning" >
                                        <tr>
                                            <th>حذف</th>
                                            <th>الاسم</th>
                                            <th>البريد الالكتروني</th>
                                            <th>كلمة المرور (sha1)</th>
                                            <th>تاريخ الانشاء</th>
                                        </tr>
                                    </thead>
                                    <tfoot class="text-warning">
                                        <tr>
                                            <th>حذف</th>
                                            <th>الاسم</th>
                                            <th>البريد الالكتروني</th>
                                            <th>كلمة المرور (sha1)</th>
                                            <th>تاريخ الانشاء</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                        @foreach ( $users as $user )
                                        <tr>
                                            <td class="col-1">
                                                <form action="{{ route('gallery.deleteUser',$user->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class=" btn btn-danger rounded-circle"><i class="bi bi-trash"></i></button>
                                                </form>
                                            </td>
                                            <td class="col-2">{{ $user->name }}</td>
                                            <td class="col-3">{{$user->email }}</td>
                                            <td class="col-3">{{ $user->password }}</td>
                                            <td class="col-2">{{ $user->created_at }}</td>
                                        </tr>
                        @endforeach
                                    </tbody>
                                </table>
                        </div>

      </div>
        @if (is_null($users))

        <div class="fw-bold text-center text-dark fs-5 p-5 ">لا يــوجــد نـتـائـج </div>

        @endif

        </div>


    </section>

    <div class="d-flex justify-content-center align-items-center my-5 p-3">
        {{ $users->links() }}
    </div>




        {{-- posts table with ability to search using filtering--}}

@elseif (isset($posts))

    <div class="mt-3 mb-5 text-center"><h1 class="fw-bold">جدول المنشورات</h1></div>


       <div class="d-flex justify-content-center mb-5 mt-5" >
              <form class=" " action="{{ route('gallery.tableSearch' , 'posts') }}" method="GET" enctype="multipart/form-data">
                <div class="d-flex mb-3 ">
                <p class="mx-1 mt-2 fw-bold w-75 text-center align-middle">البحث باستخدام :</p>
                <select name="filter" class="form-select w-50 bg-dark text-light border border-3 border-warning rounded-pill text-center" aria-label="Default select example">
                <option value="title" selected>العنوان</option>
                <option value="description">الوصف</option>
                <option value="position">المكان</option>
                <option value="state">الحالة</option>
                <option value="created_at">تاريخ الانشاء</option>
                <option value="created_at">تاريخ التحديث</option>
                </select>
                </div>
                <div class="d-flex">
                <input type="search" name="search" placeholder="بـحـث" class="mx-2 px-3 rounded-pill border border-3 border-warning bg-dark text-light" >
                <button class="bg-dark text-light rounded-circle border border-3 border-warning py-2 px-3" type="submit"><i class="bi bi-search"></i></button>
                </div>
            </form>
        </div>

                <div class="text-center mb-4">
            <a class="btn btn-success border border-dark border-3 rounded-pill " href="{{ route('gallery.newPost') }}"><i class="bi bi-plus-circle "> منشور جديد</i></a>
        </div>


                        <div class="table-responsive px-5 mb-3">
                                <table class="table table-dark table-bordered text-center align-middle">
                                    <thead class="text-warning" >
                                        <tr>
                                            <th>حذف & تعديل</th>
                                            <th>الصورة</th>
                                            <th>العنوان</th>
                                            <th>الوصف</th>
                                            <th>المكان</th>
                                            <th>الحالة</th>
                                            <th>تاريخ الانشاء</th>
                                            <th>تاريخ التحديث</th>
                                        </tr>
                                    </thead>
                                    <tfoot class="text-warning">
                                        <tr>
                                            <th>حذف & تعديل</th>
                                            <th>الصورة</th>
                                            <th>العنوان</th>
                                            <th>الوصف</th>
                                            <th>المكان</th>
                                            <th>الحالة</th>
                                            <th>تاريخ الانشاء</th>
                                            <th>تاريخ التحديث</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                        @foreach ( $posts as $post )
                                        <tr>
                                            <td class="col-1">
                                                <form class="d-inline" action="{{ route('gallery.remove',$post->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class=" btn btn-danger rounded-circle"><i class="bi bi-trash"></i></button>
                                                </form>
                                                <a class="btn btn-warning rounded-circle" href="{{ route('gallery.edit',$post->id) }}"><i class="bi bi-pencil"></i></a>
                                            </td>
                                            <td class="col-1"><img class="" src="{{ asset($post->image_path) }}" width="60" height="40" alt="..." /></td>
                                            <td class="col-2">{{ $post->title }}</td>
                                            <td class="col-3">{{ $post->description }}</td>
                                            <td class="col-2">{{ $post->position }}</td>
                                            <td class="col-1">{{ $post->state }}</td>
                                            <td class="col-1">{{ $post->created_at }}</td>
                                            <td class="col-1">{{ $post->updated_at }}</td>
                                        </tr>
                        @endforeach
                                    </tbody>
                                </table>
                        </div>

      </div>

         @if (is_null($posts))

        <div class="fw-bold text-center text-dark fs-5 p-5 ">لا يــوجــد نـتـائـج </div>

        @endif

        </div>


    </section>

    <div class="d-flex justify-content-center align-items-center my-auto p-3 ">
        {{ $posts->links() }}
    </div>



            {{-- rates table with ability to search using filtering--}}

@elseif (isset($rates))

    <div class="mt-3 mb-5 text-center"><h1 class="fw-bold">جدول التقييمات</h1></div>


                       <div class="d-flex justify-content-center mb-5 mt-5" >
                            <form class=" " action="{{ route('gallery.tableSearch','rates') }}" method="GET" enctype="multipart/form-data">
                                <div class="d-flex mb-3 ">
                                <p class="mx-1 mt-2 fw-bold w-75 text-center align-middle">البحث باستخدام :</p>
                                <select name="filter" class="form-select w-50 bg-dark text-light border border-3 border-warning rounded-pill text-center" aria-label="Default select example">
                                <option value="rate" selected>التقييم</option>
                                <option value="created_at">تاريخ الانشاء</option>
                                <option value="updated_at">تاريخ التحديث</option>
                                </select>
                                </div>
                                <div class="d-flex">
                                <input type="search" name="search" placeholder="بـحـث" class="mx-2 px-3 rounded-pill border border-3 border-warning bg-dark text-light" >
                                <button class="bg-dark text-light rounded-circle border border-3 border-warning py-2 px-3" type="submit"><i class="bi bi-search"></i></button>
                                </div>
                            </form>
                        </div>

                        <div class="table-responsive px-5 mb-3">
                                <table class="table table-dark table-bordered text-center align-middle">
                                    <thead class="text-warning" >
                                        <tr>
                                            <th>حذف</th>
                                            <th>الصورة</th>
                                            <th>اسم المستخدم</th>
                                            <th>التقييم</th>
                                            <th>تاريخ الانشاء</th>
                                            <th>تاريخ التحديث</th>
                                        </tr>
                                    </thead>
                                    <tfoot class="text-warning">
                                        <tr>
                                            <th>حذف</th>
                                            <th>الصورة</th>
                                            <th>اسم المستخدم</th>
                                            <th>التقييم</th>
                                            <th>تاريخ الانشاء</th>
                                            <th>تاريخ التحديث</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                        @foreach ( $rates as $rate )
                                        <tr>
                                            <td class="col-1">
                                                <form action="{{ route('gallery.deleteRate',$rate->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class=" btn btn-danger rounded-circle"><i class="bi bi-trash"></i></button>
                                                </form>                                            </td>
                                            <td class="col-1"><img class="" src="{{ asset($rate->post->image_path) }}" width="60" height="40" alt="..." /></td>
                                            <td class="col-2">{{ $rate->user->name }}</td>
                                            <td class="col-1">{{ $rate->rate }}</td>
                                            <td class="col-2">{{ $rate->created_at }}</td>
                                            <td class="col-2">{{ $rate->updated_at }}</td>
                                        </tr>
                        @endforeach
                                    </tbody>
                                </table>
                        </div>

      </div>

         @if (is_null($rates))

        <div class="fw-bold text-center text-dark fs-5 p-5 ">لا يــوجــد نـتـائـج </div>

        @endif

        </div>


    </section>

    <div class="d-flex justify-content-center align-items-center my-auto p-3 ">
        {{ $rates->links() }}
    </div>


        {{-- comments table with ability to search using filtering--}}

 @elseif (isset($comments))

    <div class="mt-3 mb-5 text-center"><h1 class="fw-bold">جدول التعليقات</h1></div>


            <div class="d-flex justify-content-center mb-5 mt-5" >
                    <form class=" " action="{{ route('gallery.tableSearch', 'comments') }}" method="GET" enctype="multipart/form-data">
                        <div class="d-flex mb-3 ">
                        <p class="mx-1 mt-2 fw-bold w-75 text-center align-middle">البحث باستخدام :</p>
                        <select name="filter" class="form-select w-50 bg-dark text-light border border-3 border-warning rounded-pill text-center" aria-label="Default select example">
                            <option value="rate" selected>التعليق</option>
                            <option value="created_at">تاريخ الانشاء</option>
                            <option value="updated_at">تاريخ التحديث</option>
                        </select>
                        </div>
                        <div class="d-flex">
                        <input type="search" name="search" placeholder="بـحـث" class="mx-2 px-3 rounded-pill border border-3 border-warning bg-dark text-light" >
                        <button class="bg-dark text-light rounded-circle border border-3 border-warning py-2 px-3" type="submit"><i class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>

                        <div class="table-responsive px-5 mb-3">
                                <table class="table table-dark table-bordered text-center align-middle">
                                    <thead class="text-warning" >
                                        <tr>
                                            <th>حذف & تعديل</th>
                                            <th>الصورة</th>
                                            <th>اسم المستخدم</th>
                                            <th>التعليق</th>
                                            <th>تاريخ الانشاء</th>
                                            <th>تاريخ التحديث</th>
                                        </tr>
                                    </thead>
                                    <tfoot class="text-warning">
                                        <tr>
                                            <th>حذف & تعديل</th>
                                            <th>الصورة</th>
                                            <th>اسم المستخدم</th>
                                            <th>التعليق</th>
                                            <th>تاريخ الانشاء</th>
                                            <th>تاريخ التحديث</th>
                                        </tr>
                                    </tfoot>

                                    <tbody>
                        @foreach ( $comments as $comment )
                                        <tr>
                                            <td class="col-1">
                                                <form class="d-inline" action="{{ route('gallery.deleteComment',$comment->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class=" btn btn-danger rounded-circle"><i class="bi bi-trash"></i></button>
                                                </form>
                                                <a class="btn btn-warning rounded-circle" href="{{ route('gallery.editComment',$comment->id) }}"><i class="bi bi-pencil"></i></a>
                                            </td>                                            <td class="col-1"><img class="" src="{{ asset($comment->post->image_path) }}" width="60" height="40" alt="..." /></td>
                                            <td class="col-2">{{ $comment->user->name }}</td>
                                            <td class="col-3">{{ $comment->comment }}</td>
                                            <td class="col-1">{{ $comment->created_at }}</td>
                                            <td class="col-1">{{ $comment->updated_at }}</td>
                                        </tr>
                        @endforeach
                                    </tbody>
                                </table>
                        </div>

      </div>

         @if (is_null($comments))

        <div class="fw-bold text-center text-dark fs-5 p-5 ">لا يــوجــد نـتـائـج </div>

        @endif

        </div>


    </section>

    <div class="d-flex justify-content-center align-items-center my-auto p-3 ">
        {{ $comments->links() }}
    </div>





    @endif








    @include('app.dashboardFooter')

