@php
    $sidebarItems = [
        [
            'icon' => 'ni ni-ungroup',
            'title' => 'Master Data',
            'child' => [
                [
                    'title' => 'User',
                    'route' => 'users',
                ]
            ]
        ],
    ];
@endphp

<aside
        class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
        id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
           aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0"
           href=" https://demos.creative-tim.com/argon-dashboard-pro/pages/dashboards/default.html " target="_blank">
            <img src="{{asset('img/logo-ct-dark.png')}}" class="navbar-brand-img h-100" alt="main_logo">
            <span class="ms-1 font-weight-bold">Argon Dashboard 2 PRO</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link  @if(Route::currentRouteName() === 'dashboard') active @endif"
                   href="https://github.com/creativetimofficial/ct-argon-dashboard-pro/blob/main/CHANGELOG.md"
                   target="_blank">
                    <div class="icon icon-shape icon-sm text-center  me-2 d-flex align-items-center justify-content-center">
                        <i class="ni ni-shop text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4  ms-2 text-uppercase text-xs font-weight-bolder opacity-6">PAGES</h6>
            </li>
            @foreach($sidebarItems as $sidebarItem)
                <li class="nav-item">
                    <a data-bs-toggle="collapse" href="#pagesExamples" class="nav-link active"
                       aria-controls="pagesExamples"
                       role="button" aria-expanded="false">
                        <div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
                            <i class="{{$sidebarItem['icon']}} text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">{{$sidebarItem['title']}}</span>
                    </a>
                    <div class="collapse " id="pagesExamples">
                        <ul class="nav ms-4">
                            @foreach($sidebarItem['child'] as $child)
                                <li class="nav-item ">
                                    <a class="nav-link @if($child['route'] === Route::currentRouteName()) active @endif"
                                       href="{{route($child['route'])}}">
                                        <span class="sidenav-mini-icon"> {{strtoupper(substr($child['title'], 0, 1))}} </span>
                                        <span class="sidenav-normal"> {{$child['title']}} </span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>
</aside>
