<x-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="top_content">
            <h4 class="py-3 breadcrumb-wrapper mb-4">
                <span class="text-muted fw-light">خدمات ورزشی / رزروهای من / </span>معرفی نامه باشگاه
            </h4>

            <div class="alert alert-primary alert-dismissible" role="alert">
                <h6 class="alert-heading mb-1"><i class="bx bx-xs bx-comment-error me-2"></i>
                    رزرو شما با موفقیت ثبت شد و در لیست انتظار برای تایید توسط واحد خدمات رفاهی قرار گرفت.
                    نتیجه از طریق پیامک به شما اطلاع داده خواهد شد
                </h6>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <a href="{{ route('club.myreservations') }}" class="btn btn-primary">
                <span class="tf-icons me-1"></span>رزروهای شما</a>

        </div>
    </div>
</x-layout>
