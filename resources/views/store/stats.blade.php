<x-layout>

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">خدمات رفاهی / </span>آمار درخواست ها</h4>
        <div class="row">
            <div class="col-md-6">

                <h5 class="p- mb-3">اطلاعات کلی درخواست ها</h5>
                <div class="card">
                    <table class="table table-striped">
                        <thead>
                        </thead>
                        <tbody>
                        <tr>
                            <td>تعداد درخواست های ماه جاری</td>
                            <td>
                                {{ $currentMonthReserveData }}
                            </td>
                        </tr>
                        <tr>
                            <td>تعداد درخواست های ماه گذشته</td>
                            <td>
                                {{ $lastMonthReserveData }}
                            </td>
                        </tr>
                        <tr>
                            <td>تعداد درخواست های سال جاری</td>
                            <td>
                                {{ $allCurrentYearReservations }}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-6">

                <h5 class="p- mb-3">پرطرفدارترین باشگاه ها</h5>
                <div class="card">
                    <table class="table table-striped" dir="rtl">
                        <thead>
                        <tr>
                            <th style="text-align:right">نام باشگاه</th>
                            <th style="text-align:right">تعداد کل درخواست ها</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if($popularStores)
                                @foreach($popularStores as $store)
                                    <tr>
                                        <td>{{ $store->storeName }}</td>
                                        <td>{{ $store->MostReserved }}</td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td>داده ای برای نمایش وجود ندارد</td>
                                    <td>داده ای برای نمایش وجود ندارد</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-layout>