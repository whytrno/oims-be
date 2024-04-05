<nav class="navbar navbar-main navbar-expand-lg  px-0 mx-4 shadow-none border-radius-xl z-index-sticky "
     id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm">
                    <a class="text-white" href="javascript:;">
                        <i class="ni ni-box-2"></i>
                    </a>
                </li>
                <li class="breadcrumb-item text-sm text-white"><a class="opacity-5 text-white"
                                                                  href="javascript:;">Master Data</a>
                </li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">User</li>
            </ol>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <ul class="ms-md-auto pe-md-3 d-flex navbar-nav  justify-content-end">
                <li class="nav-item dropdown d-flex align-items-center">
                    <a href="javascript:;"
                       class="nav-link text-white font-weight-bold px-0" data-bs-toggle="dropdown"
                       aria-expanded="false">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none">{{ucfirst(Auth::user()->profile->nama)}}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n4"
                        aria-labelledby="dropdownMenuButton">
                        <li>
                            <a class="dropdown-item border-radius-md" href="{{route('logout')}}">
                                <div class="d-flex py-1">
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="text-sm font-weight-normal mb-1">
                                            <span class="font-weight-bold">Logout
                                        </h6>
                                    </div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
