<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand my-app">
        <a href="/admin" class="app-brand-link">
            <span class="app-brand-logo my-app">
                <svg width="26px" height="26px" viewBox="0 0 26 26" xmlns="http://www.w3.org/2000/svg"
                    xmlns:xlink="http://www.w3.org/1999/xlink">
                    <title>icon</title>
                    <defs>
                        <linearGradient x1="50%" y1="0%" x2="50%" y2="100%"
                            id="linearGradient-1">
                            <stop stop-color="#5A8DEE" offset="0%"></stop>
                            <stop stop-color="#699AF9" offset="100%"></stop>
                        </linearGradient>
                        <linearGradient x1="0%" y1="0%" x2="100%" y2="100%"
                            id="linearGradient-2">
                            <stop stop-color="#FDAC41" offset="0%"></stop>
                            <stop stop-color="#E38100" offset="100%"></stop>
                        </linearGradient>
                    </defs>
                    <g id="Pages" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <g id="Login---V2" transform="translate(-667.000000, -290.000000)">
                            <g id="Login" transform="translate(519.000000, 244.000000)">
                                <g id="Logo" transform="translate(148.000000, 42.000000)">
                                    <g id="icon" transform="translate(0.000000, 4.000000)">
                                        <path
                                            d="M13.8863636,4.72727273 C18.9447899,4.72727273 23.0454545,8.82793741 23.0454545,13.8863636 C23.0454545,18.9447899 18.9447899,23.0454545 13.8863636,23.0454545 C8.82793741,23.0454545 4.72727273,18.9447899 4.72727273,13.8863636 C4.72727273,13.5423509 4.74623858,13.2027679 4.78318172,12.8686032 L8.54810407,12.8689442 C8.48567157,13.19852 8.45300462,13.5386269 8.45300462,13.8863636 C8.45300462,16.887125 10.8856023,19.3197227 13.8863636,19.3197227 C16.887125,19.3197227 19.3197227,16.887125 19.3197227,13.8863636 C19.3197227,10.8856023 16.887125,8.45300462 13.8863636,8.45300462 C13.5386269,8.45300462 13.19852,8.48567157 12.8689442,8.54810407 L12.8686032,4.78318172 C13.2027679,4.74623858 13.5423509,4.72727273 13.8863636,4.72727273 Z"
                                            id="Combined-Shape" fill="#4880EA"></path>
                                        <path
                                            d="M13.5909091,1.77272727 C20.4442608,1.77272727 26,7.19618701 26,13.8863636 C26,20.5765403 20.4442608,26 13.5909091,26 C6.73755742,26 1.18181818,20.5765403 1.18181818,13.8863636 C1.18181818,13.540626 1.19665566,13.1982714 1.22574292,12.8598734 L6.30410592,12.859962 C6.25499466,13.1951893 6.22958398,13.5378796 6.22958398,13.8863636 C6.22958398,17.8551125 9.52536149,21.0724191 13.5909091,21.0724191 C17.6564567,21.0724191 20.9522342,17.8551125 20.9522342,13.8863636 C20.9522342,9.91761479 17.6564567,6.70030817 13.5909091,6.70030817 C13.2336969,6.70030817 12.8824272,6.72514561 12.5388136,6.77314791 L12.5392575,1.81561642 C12.8859498,1.78721495 13.2366963,1.77272727 13.5909091,1.77272727 Z"
                                            id="Combined-Shape2" fill="url(#linearGradient-1)"></path>
                                        <rect id="Rectangle" fill="url(#linearGradient-2)" x="0" y="0"
                                            width="7.68181818" height="7.68181818"></rect>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </g>
                </svg>
            </span>
            <span class="app-brand-text demo menu-text fw-bold ms-2"></span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="bx menu-toggle-icon d-none d-xl-block fs-4 align-middle"></i>
            <i class="bx bx-x d-block d-xl-none bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-divider mt-0"></div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Page -->
        <li @class([
            'menu-item',
            'active' => isActiveRoute(['dashboard']),
        ])>
            <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Page 1">داشبورد</div>
            </a>
        </li>

        @canany(['clubcategory:manage', 'clubcategory:create', 'clubcategory:edit', 'clubcategory:delete', 'club:manage', 'club:create',
                'club:edit' ,'club:delete', 'clubreservation:manage', 'clubreservation:approve', 'clubreservation:reject', 'clubreservation:stats',
                 'clubreservation:allletters', 'clubreservation:delete', 'clubreserve:reserve', 'clubreserve:myreservations', 'clubreserve:ownletter'])
        <li @class([
                'menu-item',
                'open' => isActiveRoute([
                    'club.index',
                    'club.manage',
                    'club.create',
                    'club.edit',
                    'club.show',
                    'club.letter',
                    'club.stats',
                    'club.reserve.create',
                    'club.reserveinfo',
                    'club.myreservations',
                    'club.allreservations',
                    'clubcategory.index',
                    'clubcategory.manage',
                    'clubcategory.create',
                    'clubcategory.edit',
                ]),
            ])>
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dumbbell"></i>
                <div>خدمات ورزشی</div>
            </a>
            <ul class="menu-sub">
                    @can('club:manage')
                    <li @class([
                            'menu-item',
                            'active' => isActiveRoute(['club.manage', 'club.create', 'club.edit']),
                        ])>
                        <a href="{{ route('club.manage') }}" class="menu-link">
                            <div>مدیریت باشگاه ها</div>
                        </a>
                    </li>
                    @endcan
                    @can('clubcategory:manage')
                    <li @class([
                            'menu-item',
                            'active' => isActiveRoute(['clubcategory.manage', 'clubcategory.create', 'clubcategory.edit']),
                        ])>
                        <a href="{{ route('clubcategory.manage') }}" class="menu-link">
                            <div>مدیریت دسته بندی ها</div>
                        </a>
                    </li>
                    @endcan
                    @can('clubreservation:stats')
                    <li @class([
                            'menu-item',
                            'active' => isActiveRoute(['club.stats']),
                        ])>
                        <a href="{{ route('club.stats') }}" class="menu-link">
                            <div>آمار رزروها</div>
                        </a>
                    </li>
                    @endcan
                    @can('clubreservation:manage')
                    <li @class([
                            'menu-item',
                            'active' => isActiveRoute(['club.allreservations']),
                        ])>
                        <a href="{{ route('club.allreservations') }}" class="menu-link">
                            <div>مدیریت رزروها</div>
                        </a>
                    </li>
                    @endcan
                    @can('clubreserve:reserve')
                    <li @class([
                            'menu-item',
                            'active' => isActiveRoute(['club.index', 'club.show', 'club.reserveinfo', 'club.reserve.create']),
                        ])>
                        <a href="{{ route('club.index') }}" class="menu-link">
                            <div>رزرو باشگاه</div>
                        </a>
                    </li>
                    @endcan
                    @can('clubreserve:myreservations')
                    <li @class([
                            'menu-item',
                            'active' => isActiveRoute(['club.myreservations', 'club.letter']),
                        ])>
                        <a href="{{ route('club.myreservations') }}" class="menu-link">
                            <div>رزروهای من</div>
                        </a>
                    </li>
                    @endcan
            </ul>
        </li>
        @endcanany
        @canany(['storecategory:manage', 'storecategory:create', 'storecategory:edit', 'storecategory:delete', 'store:manage', 'store:create',
                'store:edit', 'store:delete', 'alldiscounts:manage','alldiscounts:approve', 'alldiscounts:reject', 'verifydiscounts:manage',
                'verifydiscounts:approve', 'verifydiscounts:reject', 'verifydiscounts:additionalnote', 'verifydiscounts:allletters',
                'storediscountsstats:stats', 'storediscounts:request', 'storediscounts:mydiscounts', 'storediscounts:ownletter'])
        <li @class([
                'menu-item',
                'open' => isActiveRoute([
                    'store.index',
                    'store.manage',
                    'store.create',
                    'store.edit',
                    'store.show',
                    'store.letter',
                    'store.stats',
                    'store.discount.create',
                    'store.discountinfo',
                    'store.mydiscounts',
                    'store.alldiscounts',
                    'store.verifydiscounts',
                    'storecategory.index',
                    'storecategory.manage',
                    'storecategory.create',
                    'storecategory.edit',
                ]),
            ])>
            <a href="#" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-dumbbell"></i>
                <div>خدمات رفاهی</div>
            </a>

            <ul class="menu-sub">
                    @can('store:manage')
                    <li @class([
                            'menu-item',
                            'active' => isActiveRoute(['store.manage', 'store.create', 'store.edit']),
                        ])>
                        <a href="{{ route('store.manage') }}" class="menu-link">
                            <div>مدیریت فروشگاه ها</div>
                        </a>
                    </li>
                    @endcan
                    @can('storecategory:manage')
                    <li @class([
                            'menu-item',
                            'active' => isActiveRoute(['storecategory.manage', 'storecategory.create', 'storecategory.edit']),
                        ])>
                        <a href="{{ route('storecategory.manage') }}" class="menu-link">
                            <div>مدیریت دسته بندی ها</div>
                        </a>
                    </li>
                    @endcan
                    @can('storediscountsstats:stats')
                    <li @class([
                            'menu-item',
                            'active' => isActiveRoute(['store.stats']),
                        ])>
                        <a href="{{ route('store.stats') }}" class="menu-link">
                            <div>آمار درخواست ها</div>
                        </a>
                    </li>
                    @endcan
                    @can('alldiscounts:manage')
                    <li @class([
                            'menu-item',
                            'active' => isActiveRoute(['store.alldiscounts']),
                        ])>
                        <a href="{{ route('store.alldiscounts') }}" class="menu-link">
                            <div>متصدی رفاهی</div>
                        </a>
                    </li>
                    @endcan
                    @can('verifydiscounts:manage')
                    <li @class([
                            'menu-item',
                            'active' => isActiveRoute(['store.verifydiscounts']),
                        ])>
                        <a href="{{ route('store.verifydiscounts') }}" class="menu-link">
                            <div>متصدی حقوق و دستمزد</div>
                        </a>
                    </li>
                    @endcan
                    @can('storediscounts:request')
                    <li @class([
                            'menu-item',
                            'active' => isActiveRoute(['store.index', 'store.show', 'store.discountinfo', 'store.discount.create']),
                        ])>
                        <a href="{{ route('store.index') }}" class="menu-link">
                            <div>درخواست خدمات رفاهی</div>
                        </a>
                    </li>
                    @endcan
                    @can('storediscounts:mydiscounts')
                    <li @class([
                            'menu-item',
                            'active' => isActiveRoute(['store.mydiscounts', 'store.letter']),
                        ])>
                        <a href="{{ route('store.mydiscounts') }}" class="menu-link">
                            <div>درخواست های من</div>
                        </a>
                    </li>
                    @endcan
            </ul>
        </li>
        @endcanany











        @canany(['foodreservation:reserve', 'food:manage', 'food:create', 'food:edit', 'food:delete', 'food:export', 'food:togglestatus',
                'foodassignment:manage', 'foodassignment:edit', 'foodstats:stats', 'foodreservation:reserve', 'foodreservation:myreservations' ])
            <li @class([
                'menu-item',
                'open' => isActiveRoute([
                    'food.index',
                    'food.manage',
                    'food.create',
                    'food.edit',
                    'food.show',
                    'food.letter',
                    'food.stats',
                    'reserve.index',
                    'food.reserve.create',
                    'food.myreservations',
                    'foodassignment.manage',
                    'foodassignment.edit',
                ]),
            ])>
                <a href="#" class="menu-link menu-toggle">
                    <i class="menu-icon tf-icons bx bx-bowl-hot restaurant"></i>
                    <div>رستوران</div>
                </a>

                <ul class="menu-sub">
                    @can('food:manage')
                        <li @class([
                            'menu-item',
                            'active' => isActiveRoute(['food.manage', 'food.create', 'food.edit']),
                        ])>
                            <a href="{{ route('food.manage') }}" class="menu-link">
                                <div>مدیریت غذاها</div>
                            </a>
                        </li>
                    @endcan
                    @can('foodassignment:manage')
                        <li @class([
                            'menu-item',
                            'active' => isActiveRoute(['foodassignment.manage', 'foodassignment.edit']),
                        ])>
                            <a href="{{ route('foodassignment.manage') }}" class="menu-link">
                                <div>تخصیص غذا به ماهها</div>
                            </a>
                        </li>
                    @endcan
                    @can('foodstats:stats')
                        <li @class([
                            'menu-item',
                            'active' => isActiveRoute(['food.stats']),
                        ])>
                            <a href="{{ route('food.stats') }}" class="menu-link">
                                <div>آمار غذاها</div>
                            </a>
                        </li>
                    @endcan
                    @can('foodreservation:reserve')
                        <li @class([
                            'menu-item',
                            'active' => isActiveRoute(['food.reserve.create', 'reserve.index']),
                        ])>
                            <a href="{{ route('food.reserve.create') }}" class="menu-link">
                                <div>رزرو غذا</div>
                            </a>
                        </li>
                    @endcan
                    @can('foodreservation:myreservations')
                        <li @class([
                            'menu-item',
                            'active' => isActiveRoute(['food.myreservations']),
                        ])>
                            <a href="{{ route('food.myreservations') }}" class="menu-link">
                                <div>رزروهای من</div>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcanany




        @can('role:manage')
        <li @class([
            'menu-item',
            'active' => isActiveRoute([
                'role.manage',
                'role.create',
                'role.edit',]),
        ])>
            <a href="{{ route('role.manage') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-key"></i>
                <div data-i18n="Page 2">مدیریت نقش ها</div>
            </a>
        </li>
        @endcan
        @canany(['users:manage', 'users:create', 'users:edit', 'users:delete'])
        <li @class([
            'menu-item',
            'active' => isActiveRoute([
                'users.manage',
                'users.create',
                'users.edit',
            ]),
        ])>
            <a href="{{ route('users.manage') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Page 1">مدیریت کاربران</div>
            </a>
        </li>
        @endcanany

    </ul>
</aside>
