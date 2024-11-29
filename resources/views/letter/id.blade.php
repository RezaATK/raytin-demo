@include('letter.header')
<div class="content-wrapper">
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">
            </span>مشاهده معرفی نامه ها
        </h4>
        <div class="row">
          <div class="col-10">
            <div class="card">
              <div class="card-body mt-5">
                @if(session('success'))
                  skdjnfdjskfjsnfnfnssnd
                @endif
                  <form action="{{ route('letter.store') }}" method="POST">
                    @csrf
                      <div class="mb-3 mx-5">
                          <label for="trackingCode" class="form-label">کد درخواست </label>
                          <input type="text" class="form-control" value="{{ old('trackingCode') }}"
                              name="trackingCode">
                      </div>
                      <div class="mb-3 mx-5">
                          {{-- <label for="captcha" class="form-label">کد امنیتی</label> --}}
                          {{-- <input type="text" class="form-control" name="captcha" autocomplete="off" autocorrect="off"> --}}
                          <div class="container" style="flex-wrap :nowrap">
                              <button type="submit" class="btn btn-primary" name="submit">مشاهده معرفی نامه</button>
                              <a href="{{ route('login') }}" type="button" class="btn btn-primary">بازگشت</a>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
          </div>
          <div class="col-2"></div>
        </div>
    </div>
    <script>
        // $(document).ready(function(){
        // $("#reload").click(function(){
        // $("#captcha").attr('src', '/letter/captcha/$_SESSION['url_captcha_key']');
        // e.preventDefault();
        // });
        // });
    </script>
    @include('letter.footer')
