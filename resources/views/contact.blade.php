
    @include('app.header')

        {{-- show contact page  --}}

    @if (session()->has('sendEmail'))
    <div class="my-3 mx-auto bg-success text-light fw-bold px-4 py-2 text-center col-12 col-md-8 col-lg-6 col-xl-4">
        {{ session()->get('sendEmail') }}
    </div>
    @endif


    <div class=" mt-5 mt-sm-3" >
        <div class="d-flex justify-content-center align-items-center py-lg-1 pb-4 ">
            <div class="col-11 col-sm-8 col-md-6 col-lg-5 col-xl-4 text-light px-3">

            <form action="{{ route('gallery.send') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div>
                    <h3 class="text-center mb-4 ">اتصل بنا</h3>
                    <img class="rounded-circle mb-3 m-auto d-block  " width="70" src="{{ asset('assets/images/website/messageLogo.png') }}" alt="">
                </div>
                <div class="mb-3">
                    <label class="form-label" for="name">الاسم </label>
                    <input class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" type="text" name="name">
                    @if ($errors->has('name'))
                    <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                    @endif
                </div>
                <div>
                    <label class="form-label" for="email">البريد الالكتروني : </label>
                    <input class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" type="email" name="email">
                    @if ($errors->has('email'))
                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                    @endif
                </div>
                <div>
                    <label class="form-label mt-3" for="message">الرسالة </label>
                    <textarea class="form-control rounded-2  {{ $errors->has('message') ? ' is-invalid' : '' }}" name="message" id="message" rows="4"  ></textarea>
                    @if ($errors->has('message'))
                    <div class="invalid-feedback">{{ $errors->first('message') }}</div>
                    @endif
                </div>
                    <button class="btn mt-5 btn-primary w-100 " type="submit">ارســال</button>
            </form>

        </div>
        </div>
    </div>

    </div>

    {{-- @include('app.footer') --}}
