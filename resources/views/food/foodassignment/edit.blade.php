<x-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper">
            <span class="text-muted fw-light">رستوران /</span> منوی ماهانه رستوران
        </h4>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('foodassignment.update', $month->monthID) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="monthName" class="form-label">ماه انتخابی : </label>
                                <input type="text" name="monthName" value="{{ $month->monthName }}" class="form-control" disabled>
                                <x-show-error field="monthName" />
                            </div>

                            <ul class="list-group">
                                @foreach($foods as $food)
                                    <li class="list-group-item">
                                        <input class="form-check-input me-1" type="checkbox"  name="foods[]" value="{{ $food->foodID }}" id="foodID-{{ $food->foodID }}"
                                                @checked(in_array($food->foodID, $month->foods->pluck('foodID')->toArray()))>
                                        <label class="form-check-label" for="foodID-{{ $food->foodID }}">{{ $food->foodName }}</label>
                                    </li>
                                @endforeach
                            </ul>
                            <x-show-error field="foods" />
                            <br>
                            <button type="submit" class="btn btn-primary">تغییر</button>
                            <a href="{{ route('foodassignment.manage') }}" type="button" class="btn btn-primary">بازگشت</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>