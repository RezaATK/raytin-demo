<x-layout>

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">خدمات ورزشی / </span>آمار رزروها</h4>
        <div class="row">
            <div class="col-md-6">

                <h5 class="p- mb-3">اطلاعات کلی رزروها</h5>
                <div class="card">
                    <table class="table table-striped">
                        <thead>
                        <!-- <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        </tr> -->
                        </thead>
                        <tbody>
                        <tr>
                            <td>تعداد رزروهای ماه آینده</td>
                            <td>
                                {{  $nextMonthReserveData }}
                            </td>
                        </tr>
                        <tr>
                            <td>تعداد رزروهای ماه جاری</td>
                            <td>
                                {{ $currentMonthReserveData }}
                            </td>
                        </tr>
                        <tr>
                            <td>تعداد رزروهای ماه گذشته</td>
                            <td>
                                {{ $lastMonthReserveData }}
                            </td>
                        </tr>
                        <tr>
                            <td>تعداد رزروهای سال جاری</td>
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
                            <th style="text-align:right">تعداد کل رزروها</th>
                        </tr>
                        </thead>
                        <tbody>
                            @if($popularClubs)
                                @foreach($popularClubs as $club)
                                    <tr>
                                        <td>{{ $club->clubName }}</td>
                                        <td>{{ $club->MostReserved }}</td>
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