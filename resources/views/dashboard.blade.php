<x-layout>
    <?php

    $data = null;
// $FiveDaysPastAndAheadReservationsList = $data['FiveDaysPastAndAheadReservationsList'];
//    $LastFiveWordpressPosts = $data['LastFiveWordpressPosts'];
    $LastFiveWordpressPosts = [];


//    $currentMonthFoods = $data['currentMonthFoods'];
    $currentMonthFoods = [];
    function loadcurrentMonthFoods($currentMonthFoods)
    {
        if (!empty($currentMonthFoods)) {
            for ($i = 0; $i < count($currentMonthFoods); $i++) {
                echo '<span class="badge bg-success">' . $currentMonthFoods[$i]->foodName . '</span> ';
            }
        }
        if (empty($currentMonthFoods)) {
            echo 'غذایی برای این ماه انتخاب نشده است';
        }
    }

// $FiveDaysPastAndAheadReservationsList = $data['FiveDaysPastAndAheadReservationsList'];

// function loadFiveDaysPastAndAheadReservationsList($FiveDaysPastAndAheadReservationsList){
//     for($i = 0; $i < count($FiveDaysPastAndAheadReservationsList); $i++) {
//         if(!empty($FiveDaysPastAndAheadReservationsList[$i]))
//         {
//             $reservDate = $FiveDaysPastAndAheadReservationsList[$i][0]['reservDate'];
//             echo ' <span class="badge bg-info"> ' . verta($reservDate)->format('l j F Y') . '  </span> ';
//             foreach($FiveDaysPastAndAheadReservationsList[$i] as $day) {
//                 echo ' <span class="badge bg-success"> غذا : ' . $day['foodName'] . '  </span> ';
//                 echo ' <span class="badge bg-primary"> تعداد  :  ' . $day['foodCount'] . ' </span> ';
//             }
//             echo '<br>';
//         }else if(empty($FiveDaysPastAndAheadReservationsList[$i]))
//                 echo ' <span class="badge bg-warning"> داده ای برای نمایش وجود ندارد </span> <br>';
//     }
// }

//    $fiveMostReservedClubs = $data['fiveMostReservedClubs'];
    $fiveMostReservedClubs = [];

    function loadMostReservedClubs($MOSTReserveClubs)
    {
        if (!empty($MOSTReserveClubs)) {
            foreach ($MOSTReserveClubs as $club) {
                $clubID = $club->clubID;
                $clubName = $club->clubName;
                $count = $club->MostReserved;
                echo
                    '
          <tr>
              <td>' . $clubName . '</td>
              <td>' . $count . '</td>
          </tr>
          ';
            }
        } else {
            echo
            '
          <tr>
              <td>داده ای برای نمایش وجود ندارد</td>
              <td>داده ای برای نمایش وجود ندارد</td>
          </tr>
          ';
        }
    }

    function loadWordpressNews($LastFiveWordpressPosts)
    {
        if ($LastFiveWordpressPosts) {
            foreach ($LastFiveWordpressPosts as $post) {
                $post_title = $post->post_title;
                $newUrl = 'https://oxinsteel.ir/news/' . $post->post_name;
                //$imageURL = 'https://oxinsteel.ir/wp-content/uploads/' . $post->imageURL;
                $imageURL = str_replace('.jpg', '-311x207.jpg', $post->imageURL);
                $imageURL = str_replace('.jpeg', '-311x207.jpeg', $imageURL);
                // $imageURL = 'https://oxinsteel.ir/wp-content/uploads/' . $imageURL;
                echo
                    '
          <tr>
              <td>
                <img src="' . $imageURL . '" alt="None width="50" height="60" loading="lazy">
              </td>
              <td>
                <a href="' . $newUrl . '" target="_blank">' . $post_title . '</a>
              </td>
          </tr>
          ';
            }
        }
    }

//    ?>

            <!-- Content wrapper -->
    <div class="content-wrapper">
        <!-- Content -->
        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 breadcrumb-wrapper mb-4">داشبورد</h4>

            <?php //if ($_SESSION['is_user_password_null']) { ?>
            <?php if (0 == 1) {
                echo '
    <div class="row">
      <div class="alert alert-primary alert-dismissible" role="alert">
        <h6 class="alert-heading fw-bold mb-1"><i class="bx bx-xs bx-info-circle me-2"></i>اطلاعیه</h6>
        <span class="fw-900">کلمه عبوری برای شما تنظیم نشده است. لطفا از صفحه <a class="btn btn-sm btn-primary" href="/profile"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">پروفایل من</font></font></a> اقدام به تعیین کلمه عبور کنید.</span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="بستن"></button>
      </div>
    </div>';
            } ?>


            <div class="row">

                <!-- Website Analytics-->
                <div class="right_side col-md-6">

                    <div class="col-12 mb-4">
                        <div class="card h-100">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">آمار تعداد رزرو ورزشی</h5>
                                <div class="dropdown primary-font">
                                    <button class="btn p-0" type="button" id="analyticsOptions" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="analyticsOptions">
                                        <a class="dropdown-item" href="javascript:void(0);">انتخاب همه</a>
                                        <a class="dropdown-item" href="javascript:void(0);">تازه سازی</a>
                                        <a class="dropdown-item" href="javascript:void(0);">اشتراک گذاری</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body pb-2" style="position: relative;">

                                <div id="clubsReserveChart"></div>
                                <script>
                                    $(document).ready(function() {
                                        var options = {
                                            chart: {
                                                type: 'bar'
                                            },
                                            series: [{
                                                name: 'رزرو',
                                                data: [<?php //echo $series; ?>]
                                            }],
                                            xaxis: {
                                                categories: [<?php // echo $xaxis; ?>]
                                            }
                                        }

                                        var chart = new ApexCharts(document.querySelector("#clubsReserveChart"), options);

                                        chart.render();
                                    });
                                </script>
                            </div>
                        </div>
                    </div>

                    <!-- Growth Chart-->
                    <div class="col-12 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar">
                                            <span class="avatar-initial bg-label-primary rounded-circle"><i class="bx bx-user fs-4"></i></span>
                                        </div>
                                        <div class="card-info">
                                            <h5 class="card-title mb-0 me-2 primary-font">{{  $usersCount->UsersCount }}</h5>
                                            <small class="text-muted">تعداد کاربران سیستم</small>
                                        </div>
                                    </div>
                                    <div id="conversationChart"></div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-12 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="avatar">
                                            <span class="avatar-initial bg-label-primary rounded-circle"><i class="bx bx-bowl-hot fs-4"></i></span>
                                        </div>
                                        <div class="card-info">
                                            <h5 class="card-title mb-0 me-2 primary-font">غذای امروز شما </h5>
                                        </div>
                                        <h5 class="my-auto"><span class="badge bg-success">{{ $todaysFood->foodName ?? 'بدون داده' }}</span></h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>





                </div>

                <div class="left_side col-md-6">

                    <div class="col-12">
                        <h5 class="p- mb-3">پرطرفدارترین باشگاه ها</h5>
                        <div class="card">
                            <table class="table table-striped" dir="rtl">
                                <thead>
                                <tr>
                                    <th style="text-align:right">نام باشگاه</th>
                                    <th style="text-align:right">تعداد رزروها</th>
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

                    <div class="col-12 mt-4">
                        <h5 class="p- mb-3">آخرین اخبار فولاد سازمان</h5>
                        <div class="card">
                            <table class="table table-striped" dir="rtl">
                                <thead>
                                <tr>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>


            </div>
        </div>
        <!-- / Content -->

</x-layout>
