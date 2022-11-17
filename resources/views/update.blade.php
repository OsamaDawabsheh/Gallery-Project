@include('app.header')

    {{-- show update post page  --}}



    <div class="container p-4 my-4 " >
        <div class="row d-flex justify-content-center align-items-center ">
            <div class="col-11 col-sm-10 col-md-8 col-lg-6 col-xl-5 bg-dark text-light py-5 px-3 border border-warning border-5 ">

        <form action="{{ route('gallery.update',$post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="text-center mb-5 ">
                <h1 class="fw-bold m-auto ">تعديل المنشور</h1>
            </div>

                        <div class="mb-3">
                <label for="formFile" class="form-label">اخـتـر صـورة :</label>
                <input class="form-control {{ $errors->has('image') ? ' is-invalid' : '' }}" type="file" name="image" id="formFile" accept="image/*">
                @if ($errors->has('image'))
                    <div class="invalid-feedback">{{ $errors->first('image') }}</div>
                @endif
              </div>

            <div class="mb-3">
                <label class="form-label " for="title"> عنوان الصورة : </label>
                <input class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}" type="text" name="title" value="{{ $post->title }}">
                @if ($errors->has('title'))
                    <div class="invalid-feedback ">{{ $errors->first('title') }}</div>
                @endif
            </div>

            <div class="mb-3">
                <label class="form-label d-block" for="description">وصف الصورة : </label>
                <textarea class="form-control rounded-2 {{ $errors->has('description') ? ' is-invalid' : '' }} " name="description" id="description" rows="4"  >{{ $post->description }}</textarea>
                @if ($errors->has('description'))
                    <div class="invalid-feedback">{{ $errors->first('description') }}</div>
                @endif
            </div>

            <div class="mb-4">
                <label class="form-label " for="position"> مكان الصورة : </label>
                <input class="form-control {{ $errors->has('position') ? ' is-invalid' : '' }}" type="text" name="position" value="{{ $post->position }}">
                @if ($errors->has('position'))
                    <div class="invalid-feedback">{{ $errors->first('*position') }}</div>
                @endif
            </div>

            <div class="d-flex justify-content-evenly">
                <div class="form-check form-check-inline">
                    <input class="form-check-input {{ $errors->has('state') ? ' is-invalid' : '' }}" type="radio" name="state" id="inlineRadio1" value="عام" {{ $post->state === 'عام' ? 'checked' : ''}}>
                    <label class="form-check-label" for="inlineRadio1">عــام</label>
                  </div>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input {{ $errors->has('state') ? ' is-invalid' : '' }}" type="radio" name="state" id="inlineRadio2" value="خاص" {{ $post->state === 'خاص' ? 'checked' : ''}}>
                    <label class="form-check-label" for="inlineRadio2">خــاص</label>
                  </div>
                  @if ($errors->has('state'))
                      <div class="invalid-feedback">{{ $errors->first('state') }}</div>
                  @endif
            </div>

                <button class="btn mt-5 btn-primary w-100 " type="submit">تـعـديـل</button>
        </form>
            </div>
        </div>
    </div>


</div>


@include('app.footer')

