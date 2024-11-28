<x-layout>

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper mb-4">
            <span class="text-muted fw-light">خدمات ورزشی / </span>رزرو باشگاه</h4>
        <br>
        <div class="row">
            <div class="col-md">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-9">
                            <div class="card-body">
                                <h5 class="card-title mb-3"><span
                                            style="color:#c5c5c5">باشگاه </span>{{ $club->clubName }}</h5>
                                <p class="card-text"><span>نوع باشگاه: </span><span
                                            class="badge rounded-pill bg-label-secondary fs-6">{{ $club->category->categoryName }}</span>
                                    <span style="margin-right:30px">ویژه: </span><span
                                            class="badge rounded-pill bg-success fs-6">{{ $club->genderSpecific }}</span>
                                </p>
                                <p class="card-text"><i class="menu-icon tf-icons bx bx-map"></i>
                                    آدرس: {{ $club->clubAddress }}</p>
                                <p class="card-text">{{ $club->clubDetails }}</p>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <img class="card-img card-img-right"
                                 src="/uploads/clubs/{{ $club->category->clubCategoryID }}.jpg" alt="Card image">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-2">
                <div class="card">
                    <div class="card-body">
                        <h5>رزرو جهت ماه جاری <span class="badge bg-info fs-5">{{ verta()->now()->format('F') }}</span>
                            برای </h5>
                        <form action="{{ route('club.reserve.store', ['club' => $club]) }}" name="CurrentMonthReserv"
                              method="POST">
                            @csrf
                            @if($isUserAllowedToReservCurrentMonth)
                                @for($i=0; $i<count($familyCleanList); $i++)
                                    @php $buttonDisabled = $familyCleanList[$i]['hasCurrentActiveReserv'] === true ? 'disabled' : ''; @endphp
                                    <div class="form-check">
                                        <input name="currentMonthReserve" class="form-check-input" type="radio"
                                               value="{{  $familyCleanList[$i]['familyMemberNationalCode'] }}"
                                               id="idf1-{{$i}}"
                                                @disabled($familyCleanList[$i]['hasCurrentActiveReserv'])>
                                        <label class="form-check-label" for="idf1-{{$i}}">
                                            {{ $familyCleanList[$i]['familyMemberName'].' '. $familyCleanList[$i]['familyMemberLastName'] }}
                                        </label>
                                    </div>
                                @endfor
                                <button class="btn btn-primary mt-4" type="submit"
                                        name="currentMonthSubmit" {{$buttonDisabled ?? ''}}>
                                    ثبت رزرو
                                </button>
                                <br>
                            @else
                                مجاز به رزرو باشگاه در این ماه نیستید<br>(علت: حد مجاز رزرو در هر ماه)
                                <br>
                                <button class="btn btn-primary mt-4" type="submit" name="currentMonthSubmit" disabled>
                                    ثبت رزرو
                                </button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5>رزرو جهت ماه آینده <span
                                    class="badge bg-warning fs-5">{{ verta()->now()->addMonth()->format('F') }}</span>
                            برای </h5>
                        <form action="{{ route('club.reserve.store', ['club' => $club]) }}" name="NextMonthReserv"
                              method="POST">
                            @csrf
                            @if($isUserAllowedToReservNextMonth)
                                @php $buttonDisabled = '1' @endphp
                                @for($i=0; $i<count($familyCleanList); $i++)
                                    @php $buttonDisabled = $familyCleanList[$i]['hasNextActiveReserv'] === true ? 'disabled' : '2'; @endphp
                                    <div class="form-check">
                                        <input name="nextMonthReserve" class="form-check-input" type="radio"
                                               value="{{  $familyCleanList[$i]['familyMemberNationalCode'] }}"
                                               id="idf2-{{$i}}"
                                                @disabled($familyCleanList[$i]['hasNextActiveReserv'])>
                                        <label class="form-check-label" for="idf2-{{$i}}">
                                            {{ $familyCleanList[$i]['familyMemberName'].' '. $familyCleanList[$i]['familyMemberLastName'] }}
                                        </label>
                                    </div>
                                @endfor
                                <button class="btn btn-primary mt-4" type="submit"
                                        name="nextMonthSubmit" {{$buttonDisabled}}>
                                    ثبت رزرو
                                </button>
                                <br>
                            @else
                                مجاز به رزرو باشگاه در این ماه نیستید<br>(علت: حد مجاز رزرو در هر ماه)
                                <br>
                                <button class="btn btn-primary mt-4" type="submit" name="nextMonthSubmit" disabled>
                                    ثبت رزرو
                                </button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
