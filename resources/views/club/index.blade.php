<x-layout>
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 breadcrumb-wrapper">
            <span class="text-muted fw-light">خدمات ورزشی / </span>رزرو باشگاه
        </h4>

        <fieldset>
            <div class="d-flex">
                <legend class="me-auto">فیلتر بر اساس:</legend>
                <div class="m-2">جستجو:</div>
                <div class="clear-input-container">
                    <input type="text" class="clear-input" id="quicksearch" placeholder="محله، نوع، نام و...">
                    <button class="clear-input-button" aria-label="Clear input" title="پاک کردن">×</button>
                </div>
            </div>
            <ul class="filters-button-group nav nav-pills mb-3" role="tablist">
                <li class="nav-item" role="presentation">
                    <button type="button" data-filter="*" class="nav-link active all" role="tab"
                        data-bs-toggle="tab" aria-controls="navs-pills-top-home" aria-selected="true">
                        <input type="radio" name="type" value="all" checked="checked" class="d-none">همه</label>
                </li>
                @if($allCategories->isEmpty())
                    هیچ دسته بندی در سامانه وجود ندارد
                @else
                    @foreach($allCategories as $cat)
                    <li class="nav-item" role="presentation">
                        <button type="button" data-filter=".{{ str_replace(" ", "_" , $cat->categoryName) }}" class="nav-link" role="tab" data-bs-toggle="tab" aria-controls="navs-pills-top-home" aria-selected="false">
                        <input type="radio" name="type" value="{{ $cat->categoryName }}" checked="checked" class="d-none">{{ $cat->categoryName }}</label>
                    </li>
                    @endforeach
                @endif 
            </ul>
        </fieldset>
        <fieldset class="d-none">
            <legend>چینش بر اساس</legend>
            <label><input type="radio" name="sort" value="size" checked="checked">Size</label>
            <label><input type="radio" name="sort" value="name">Name</label>
        </fieldset>


        <ul id="filterItems" class="grid row mb-5 p-0" style="direction: ltr;">
            @if($allActiveClubs->isEmpty())
                هیچ باشگاهی در سامانه وجود ندارد  
            @else
                @foreach($allActiveClubs as $club)
                <li class="col-6 col-md-6 col-lg-3 mb-3 grid-item {{ str_replace(" ", "_" ,$club->category->categoryName) }}" data-id="id-{{ $club->clubID }}" data-type="{{ str_replace(" ", "_" ,$club->category->categoryName) }}">
                    <a href="{{ "/clubs/id/" . $club->clubID }}">
                    <div class="card h-100">
                        <img class="card-img-top" 
                        src="{{ $club->clubImage 
                        ? asset($club->clubImage) 
                        : asset('/uploads/no-image.jpg') }}" 
                         alt="{{ $club->clubName }}">
                            <div class="card-body">
                            <h5 class="card-title mb-1">{{ $club->clubName }}</h5>
                            <p><span class="badge rounded-pill bg-success fs-6">{{ $club->genderSpecific }}</span><br>
                            <span class="badge rounded-pill bg-secondary fs-6">{{ $club->clubNeighborhood }}</span></p>
                            <a href="/clubs/id/{{ $club->clubID }}" class="btn btn-outline-primary">رزرو</a>
                        </div>
                    </div>
                    </a>
                </li>
                @endforeach
            @endif 
        </ul>

    </div>

    <script src="{{ asset('assets/js/isotope/isotope.pkgd.min.js') }}"></script>


    <script>
        $(document).ready(function() {

            // quick search regex
            var $grid;
            var qsRegex;
            var buttonFilter;

            // init Isotope
            $grid = $('.grid').isotope({
                itemSelector: '.grid-item',
                // layoutMode: 'fitRows',
                originLeft: false,
                filter: function() {
                    var $this = $(this);
                    var searchResult = qsRegex ? $this.text().match(qsRegex) : true;
                    var buttonResult = buttonFilter ? $this.is(buttonFilter) : true;
                    return searchResult && buttonResult;
                }
            });

            $('.filters-button-group').on('click', 'button', function() {
                buttonFilter = $(this).attr('data-filter');
                $grid.isotope();
            });

            // use value of search field to filter
            var $quicksearch = $('#quicksearch').keyup(debounce(function() {
                $('.all').click();

                qsRegex = new RegExp($quicksearch.val(), 'gi');
                $grid.isotope();
            }));


            // change is-checked class on buttons
            $('.button-group').each(function(i, buttonGroup) {
                var $buttonGroup = $(buttonGroup);
                $buttonGroup.on('click', 'button', function() {
                    $buttonGroup.find('.is-checked').removeClass('is-checked');
                    $(this).addClass('is-checked');
                });
            });


            // debounce so filtering doesn't happen every millisecond
            function debounce(fn, threshold) {
                var timeout;
                threshold = threshold || 100;
                return function debounced() {
                    clearTimeout(timeout);
                    var args = arguments;
                    var _this = this;

                    function delayed() {
                        fn.apply(_this, args);
                    }
                    timeout = setTimeout(delayed, threshold);
                };
            }

            /* clear-input */
            const input = document.querySelector(".clear-input");
            const clearButton = document.querySelector(".clear-input-button");

            const handleInputChange = e => {
                if (e.target.value && !input.classList.contains("clear-input--touched")) {
                    input.classList.add("clear-input--touched");
                } else if (!e.target.value && input.classList.contains("clear-input--touched")) {
                    input.classList.remove("clear-input--touched");
                }
            };

            const handleButtonClick = e => {
                input.value = '';
                input.focus();
                input.classList.remove("clear-input--touched");
                $('.all').click();
                qsRegex = new RegExp($quicksearch.val(), 'gi');
                $grid.isotope();
            };

            clearButton.addEventListener("click", handleButtonClick);
            input.addEventListener("input", handleInputChange);
        });
        /* clear-input END*/
    </script>
</x-layout>
