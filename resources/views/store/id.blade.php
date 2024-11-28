<x-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">خدمات رفاهی / </span>درخواست خدمات رفاهی</h4>
        <br>
        <div class="row">
            <div class="col-md">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title mb-3"><span style="color:#c5c5c5">فروشگاه </span>{{ $store->storeName }}</h5>
                                <p class="card-text"><span>نوع فروشگاه: </span><span class="badge rounded-pill bg-label-secondary fs-6">{{ $store->categoryName }}</span>
                                <p class="card-text"><i class="menu-icon tf-icons bx bx-map"></i> آدرس: {{ $store->storeAddress }}</p>
                                <p class="card-text"><i class="menu-icon tf-icons bx bx-map"></i> شرایط فروش: {{ $store->storeTerms }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <a target="_blank" href="{{ $store->storeImage ? asset($store->storeImage) : asset('/uploads/no-image.jpg') }}">
                                <img class="card-img card-img-right rounded" src="{{ $store->storeImage ? asset($store->storeImage) : asset('/uploads/no-image.jpg') }}" alt="{{ $store->storeID }}" width="270" height="245"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h5>درخواست معرفی نامه جهت استفاده از تسهیلات فروشگاه <span class="badge bg-info fs-5">{{ $store->storeName }}</span> </h5>
                        <form action="{{ route('store.discount.store', ['store' => $store->storeID]) }}" name="CurrentMonthReserve" method="POST">
                            @csrf
                            <p class="card-text">پس از ثبت درخواست، درخواست شما توسط واحد مربوطه بررسی و نتیجه از طریق پیامک به شما اطلاع رسانی خواهد شد.</p>
                            <p class="card-text">در صورت تایید درخواست شما، مابه التفاوت از حقوق شما کسر خواهد شد.</p>
                            @if(! $isUserAllowedForMonthAndStore)
                            <strong><h5><p class="card-text">امکان درخواست دوباره برای این فروشگاه در ماه جاری وجود ندارد.</p></h5></strong>
                            @endif
                            <button class="btn btn-primary mt-4" type="submit" name="discount" @disabled(! $isUserAllowedForMonthAndStore)>ثبت درخواست</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</x-layout>
