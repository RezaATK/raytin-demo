<x-layout>
    <link rel="stylesheet" href="{{ asset('assets/css/print.css') }}" type="text/css" media="print" />
        <div class="container-xxl flex-grow-1 container-p-y">
            <div class="top_content">
                <h4 class="py-3 breadcrumb-wrapper mb-4">
                    <span class="text-muted fw-light">خدمات رفاهی / درخواست های من / </span>معرفی نامه فروشگاه</h4>

                <div class="alert alert-primary alert-dismissible" role="alert">
                    <h6 class="alert-heading mb-1"><i class="bx bx-xs bx-comment-error me-2"></i>
                        درخواست شما با موفقیت ثبت شد و در لیست انتظار برای تایید قرار گرفت.
                        نتیجه از طریق پیامک به شما اطلاع داده خواهد شد
                    </h6>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <a href="{{ route('store.mydiscounts') }}" class="btn btn-primary" >
                    <span class="tf-icons me-1"></span>درخواست های شما</a>

            </div>
        </div>
</x-layout>
