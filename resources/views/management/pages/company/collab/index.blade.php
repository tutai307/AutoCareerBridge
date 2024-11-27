@extends('management.layout.main')

@section('title', 'Quản lý hợp tác')

@section('content')
    <div class="container-fluid">
        <div class="col-xl-12">
            <div class="page-titles">
                <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">{{ __('label.breadcrumb.home') }}</a></li>
                        <li class="breadcrumb-item active"
                            aria-current="page">{{ __('label.breadcrumb.collaboration') }}</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Recent Payments Queue</h4>
                    <div class="input-group search-area">
                        <span class="input-group-text"><a href="javascript:void(0)">
                                <svg width="15" height="15" viewBox="0 0 18 18" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M17.5605 15.4395L13.7527 11.6317C14.5395 10.446 15 9.02625 15 7.5C15 3.3645 11.6355 0 7.5 0C3.3645 0 0 3.3645 0 7.5C0 11.6355 3.3645 15 7.5 15C9.02625 15 10.446 14.5395 11.6317 13.7527L15.4395 17.5605C16.0245 18.1462 16.9755 18.1462 17.5605 17.5605C18.1462 16.9747 18.1462 16.0252 17.5605 15.4395V15.4395ZM2.25 7.5C2.25 4.605 4.605 2.25 7.5 2.25C10.395 2.25 12.75 4.605 12.75 7.5C12.75 10.395 10.395 12.75 7.5 12.75C4.605 12.75 2.25 10.395 2.25 7.5V7.5Z"
                                        fill="#01A3FF"/>
                                </svg>
                            </a></span>
                        <input type="text" class="form-control" placeholder="Search here...">
                    </div>
                </div>
                <div class="custom-tab-1">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#request"><i class="la la-code-branch mx-2"></i>
                                Pending Request</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#accept"><i class="la la-check-circle mx-2"></i>

                                Accepted</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#reject"><i class="la la-times-circle mx-2"></i>

                                Rejected</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="request" role="tabpanel">
                            <div class="pt-4">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-responsive-md">
                                            <thead>
                                            <tr>
                                                <th style="width:80px;">#</th>
                                                <th>Clients</th>
                                                <th>Instr. Name</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Price</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td><strong class="text-black">03</strong></td>
                                                <td>Mr. Bobby</td>
                                                <td>Jackson</td>
                                                <td>01 August 2020</td>
                                                <td><span class="badge light badge-warning">Pending</span></td>
                                                <td>$21.56</td>
                                                <td>
                                                    <div class="">
                                                        <a class="btn btn-primary shadow btn-xs sharp me-1" href="#"> <i
                                                                class="fa-solid fa-pen-to-square"></i></a>
{{--                                                        <a class="btn btn-danger shadow btn-xs sharp me-1 btn-remove"--}}
{{--                                                           href="#"><i class="fa-solid fa-trash"></i></a>--}}
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong class="text-black">03</strong></td>
                                                <td>Mr. Bobby</td>
                                                <td>Jackson</td>
                                                <td>01 August 2020</td>
                                                <td><span class="badge light badge-warning">Pending</span></td>
                                                <td>$21.56</td>
                                                <td>
                                                    <div class="">
                                                        <a class="btn btn-primary shadow btn-xs sharp me-1" href="#"> <i
                                                                class="fa-solid fa-pen-to-square"></i></a>
{{--                                                        <a class="btn btn-danger shadow btn-xs sharp me-1 btn-remove"--}}
{{--                                                           href="#"><i class="fa-solid fa-trash"></i></a>--}}
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong class="text-black">03</strong></td>
                                                <td>Mr. Bobby</td>
                                                <td>Jackson</td>
                                                <td>01 August 2020</td>
                                                <td><span class="badge light badge-warning">Pending</span></td>
                                                <td>$21.56</td>
                                                <td>
                                                    <div class="">
                                                        <a class="btn btn-primary shadow btn-xs sharp me-1" href="#"> <i
                                                                class="fa-solid fa-pen-to-square"></i></a>
{{--                                                        <a class="btn btn-danger shadow btn-xs sharp me-1 btn-remove"--}}
{{--                                                           href="#"><i class="fa-solid fa-trash"></i></a>--}}
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong class="text-black">03</strong></td>
                                                <td>Mr. Bobby</td>
                                                <td>Jackson</td>
                                                <td>01 August 2020</td>
                                                <td><span class="badge light badge-warning">Pending</span></td>
                                                <td>$21.56</td>
                                                <td>
                                                    <div class="">
                                                        <a class="btn btn-primary shadow btn-xs sharp me-1" href="#"> <i
                                                                class="fa-solid fa-pen-to-square"></i></a>
{{--                                                        <a class="btn btn-danger shadow btn-xs sharp me-1 btn-remove"--}}
{{--                                                           href="#"><i class="fa-solid fa-trash"></i></a>--}}
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="accept">
                            <div class="pt-4">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-responsive-md">
                                            <thead>
                                            <tr>
                                                <th style="width:80px;">#</th>
                                                <th>Clients</th>
                                                <th>Instr. Name</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Price</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td><strong class="text-black">03</strong></td>
                                                <td>Mr. Bobby</td>
                                                <td>Jackson</td>
                                                <td>01 August 2020</td>
                                                <td><span class="badge light badge-success">Successful</span></td>
                                                <td>$21.56</td>
                                                <td>
                                                    <div class="">
                                                        <a class="btn btn-primary shadow btn-xs sharp me-1" href="#"> <i
                                                                class="fa-solid fa-pen-to-square"></i></a>
{{--                                                        <a class="btn btn-danger shadow btn-xs sharp me-1 btn-remove"--}}
{{--                                                           href="#"><i class="fa-solid fa-trash"></i></a>--}}
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong class="text-black">03</strong></td>
                                                <td>Mr. Bobby</td>
                                                <td>Jackson</td>
                                                <td>01 August 2020</td>
                                                <td><span class="badge light badge-success">Successful</span></td>
                                                <td>$21.56</td>
                                                <td>
                                                    <div class="">
                                                        <a class="btn btn-primary shadow btn-xs sharp me-1" href="#"> <i
                                                                class="fa-solid fa-pen-to-square"></i></a>
{{--                                                        <a class="btn btn-danger shadow btn-xs sharp me-1 btn-remove"--}}
{{--                                                           href="#"><i class="fa-solid fa-trash"></i></a>--}}
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="reject">
                            <div class="pt-4">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-responsive-md">
                                            <thead>
                                            <tr>
                                                <th style="width:80px;">#</th>
                                                <th>Clients</th>
                                                <th>Instr. Name</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Price</th>
                                                <th>Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td><strong class="text-black">03</strong></td>
                                                <td>Mr. Bobby</td>
                                                <td>Jackson</td>
                                                <td>01 August 2020</td>
                                                <td><span class="badge light badge-danger">Canceled</span></td>
                                                <td>$21.56</td>
                                                <td>
                                                    <div class="">
                                                        <a class="btn btn-primary shadow btn-xs sharp me-1" href="#"> <i
                                                                class="fa-solid fa-pen-to-square"></i></a>
{{--                                                        <a class="btn btn-danger shadow btn-xs sharp me-1 btn-remove"--}}
{{--                                                           href="#"><i class="fa-solid fa-trash"></i></a>--}}
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong class="text-black">03</strong></td>
                                                <td>Mr. Bobby</td>
                                                <td>Jackson</td>
                                                <td>01 August 2020</td>
                                                <td><span class="badge light badge-danger">Canceled</span></td>
                                                <td>$21.56</td>
                                                <td>
                                                    <div class="">
                                                        <a class="btn btn-primary shadow btn-xs sharp me-1" href="#"> <i
                                                                class="fa-solid fa-pen-to-square"></i></a>
{{--                                                        <a class="btn btn-danger shadow btn-xs sharp me-1 btn-remove"--}}
{{--                                                           href="#"><i class="fa-solid fa-trash"></i></a>--}}
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        </div>
@endsection

@section('js')
    <script src="{{ asset('management-assets/vendor/jquery-steps/build/jquery.steps.min.js')}}"></script>
    <script src="{{ asset('management-assets/vendor/jquery-validation/jquery.validate.min.js')}}"></script>
    <script src="{{ asset('management-assets/js/plugins-init/jquery.validate-init.js')}}"></script>
    <script src="{{ asset('management-assets/vendor/jquery-smartwizard/dist/js/jquery.smartWizard.js')}}"></script>
@endsection
