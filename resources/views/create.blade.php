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

    <div class="container p-4 my-4 create" >
        <div class="row d-flex justify-content-center align-items-center ">
            <div class="col-12 col-md-8 col-lg-6 col-xl-4 bg-dark text-light py-5 px-3 border border-warning border-5 ">

        <form action="{{ route('gallery.insertPost') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="text-center mb-5 ">
                <h1 class="fw-bold m-auto ">منشور جديد</h1>
            </div>

            <div class="mb-3">
                <label for="formFile" class="form-label">اخـتـر صـورة :</label>
                <input class="form-control" type="file" name="image" id="formFile" accept="image/*">
              </div>

            <div class="mb-3">
                <label class="form-label " for="title"> عنوان الصورة : </label>
                <input class="form-control" type="text" name="title">
            </div>
            <div class="mb-3">
                <label class="form-label d-block" for="description">وصف الصورة : </label>
                <textarea class="rounded-2" name="description" id="description" rows="4" cols="49" style="resize: none" ></textarea>
            </div>
            <div class="mb-4">
                <label class="form-label " for="position"> مكان الصورة : </label>
                <input class="form-control" type="text" name="position">
            </div>
            <div class="d-flex justify-content-evenly">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="state" id="inlineRadio1" value="عام">
                    <label class="form-check-label" for="inlineRadio1">عــام</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="state" id="inlineRadio2" value="خاص">
                    <label class="form-check-label" for="inlineRadio2">خــاص</label>
                  </div>
            </div>
                <button class="btn mt-5 btn-primary w-100 " type="submit">نــشــر</button>
        </form>
            </div>
        </div>
    </div>


</div>


@include('app.footer')