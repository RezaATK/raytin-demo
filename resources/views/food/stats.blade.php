<x-layout>

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
        <span class="text-muted fw-light">رستوران /</span> آمار رزروها</h4>
        <h5 class="p- mb-3">اطلاعات کلی رزروها</h5>
        <div class="card">
            <table class="table table-striped">
            <thead>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">تعداد کل رزروهای امروز</th>
                    <td>
                        @foreach ($todaysDataforCurrentMonthReservData as $food)
                            <span class="badge bg-primary">{{ $food->foodName }} : {{ $food->foodIDCount }} </span>
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th scope="row">تعداد رزروهای امروز به تفکیک غذا</th>
                    <td>
                        @php
                            $countToday = 0;
                            foreach ($todaysDataforCurrentMonthReservData as $food){
                                $countToday += $food->foodIDCount;
                            }
                            @endphp
                            <span class="badge bg-primary">{{ $countToday }} </span>
                    </td>                 </tr>
                <tr>
                    <th scope="row">تعداد کل رزروهای ماه جاری</th>
                    <td>
                        @php
                            $countMonth = 0;
                            foreach ($currentMonthReservData as $food){
                                $countMonth += $food->foodIDCount;
                            }
                            @endphp
                            <span class="badge bg-primary">{{ $countMonth }} </span>
                    </td>                
                </tr>
                <tr>
                    <th scope="row">تعداد رزروهای ماه جاری به تفکیک غذا</th>
                    <td>
                        @foreach ($currentMonthReservData as $food)
                            <span class="badge bg-primary">{{ $food->foodName }} : {{ $food->foodIDCount }} </span>
                        @endforeach
                    </td>
                </tr>
                <tr>
                    <th scope="row">تعداد کل رزروهای سال جاری</th>
                    <td>
                        @php
                            $countYear = 0;
                            foreach ($currentYearReservData as $food){
                                $countYear += $food->foodIDCount;
                            }
                            @endphp
                            <span class="badge bg-primary">{{ $countYear }} </span>
                    </td>
                </tr>
                <tr>
                    <th scope="row">تعداد رزروهای سال جاری به تفکیک غذا</th>
                    <td>       
                        @foreach ($currentYearReservData as $food)
                            <span class="badge bg-primary">{{ $food->foodName }} : {{ $food->foodIDCount }} </span>
                        @endforeach
                    </td>
                </tr>
            </tbody>
            </table>
        </div>

        <h5 class="p- mb-3 mt-4">آمار به تفکیک ماه</h5>
        <div class="card">
            <table class="table table-striped" dir="rtl">
                <thead>
                    <tr>
                        <th style="text-align:right">نام ماه</th>
                        <th style="text-align:right">تعداد رزروهای ماه</th>
                        <th style="text-align:right">تعداد رزروهای ماه به تفکیک غذا</th>
                    </tr>
                </thead>
                <tbody>
                    @if($AllMonthsReservations)
                        @foreach($AllMonthsReservations as $monthFoodData)
                            <tr>
                                <td>{{ verta()->month($loop->iteration)->format('F') }}</td>
                                <td>
                                    @php
                                        $countThisMonth = 0;
                                        foreach ($monthFoodData as $food){
                                            $countThisMonth += $food->foodIDCount;
                                        }
                                    @endphp
                                    <span class="badge bg-primary">{{ $countThisMonth }} </span>
                                </td>
                                <td>
                                    @foreach ($monthFoodData as $food)
                                        <span class="badge bg-primary">{{ $food->foodName }} : {{ $food->foodIDCount }} </span>
                                    @endforeach
                                </td>
                            </tr>
                            
                        @endforeach
                    @else
                        <tr>
                            <td>داده ای برای نمایش وجود ندارد</td>
                            <td>داده ای برای نمایش وجود ندارد</td>
                            <td>داده ای برای نمایش وجود ندارد</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>

    </div>
</x-layout>