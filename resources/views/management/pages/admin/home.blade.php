@extends('management.layout.main')

@section('title', 'Dashboard')

@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="row">
                <div class="col-xl-12">
                    <div class="page-titles">
                        <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#">{{ __('label.hello') }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ __('label.welcome') }}</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>

            <style>

                .swiper-wrapper {
                    display: flex;
                    flex-wrap: wrap; /* Đảm bảo các phần tử tự động xuống dòng */
                    gap: 20px; /* Tạo khoảng cách giữa các phần tử */
                    justify-content: space-between; /* Phân bố đều các phần tử */
                }

                .swiper-slide {
                    flex: 1 1 calc(25% - 20px); /* Đảm bảo mỗi phần tử chiếm 1/4 chiều rộng, trừ đi khoảng cách */
                    box-sizing: border-box; /* Đảm bảo padding và border không làm thay đổi kích thước của phần tử */
                    margin-bottom: 20px; /* Thêm khoảng cách giữa các hàng */
                }

                /* Responsive cho màn hình nhỏ hơn */
                @media (max-width: 1200px) {
                    .swiper-slide {
                        flex: 1 1 calc(33.33% - 20px); /* Chia đều 3 phần tử mỗi dòng */
                    }
                }

                @media (max-width: 768px) {
                    .swiper-slide {
                        flex: 1 1 calc(50% - 20px); /* Chia đều 2 phần tử mỗi dòng */
                    }
                }

                @media (max-width: 480px) {
                    .swiper-slide {
                        flex: 1 1 100%; /* Chỉ hiển thị 1 phần tử mỗi dòng */
                    }
                }

            </style>
            <div
                    class="swiper mySwiper-counter position-relative overflow-hidden swiper-initialized swiper-horizontal swiper-watch-progress swiper-backface-hidden">
                <div class="swiper-wrapper">
                    <!--swiper-slide-->
                    <div class="swiper-slide">
                        <div class="card counter">
                            <div class="card-body d-flex align-items-center">
                                <div class="card-box-icon">
                                    <i class="bi bi-people" style="font-size: 22px;"></i> <!-- Bootstrap Icon -->
                                </div>
                                <div class="chart-num">
                                    <h2 class="mb-0">{{$totalUserComJobUni['users']}}</h2>
                                    <p class="mb-0">{{ __('label.admin.dashboard.total_user')  }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="card counter">
                            <div class="card-body d-flex align-items-center">
                                <div class="card-box-icon">
                                    <i class="bi bi-buildings" style="font-size: 22px;"></i>
                                    <!-- Bootstrap Icon cho Doanh nghiệp -->
                                </div>
                                <div class="chart-num">
                                    <h2 class="mb-0">{{$totalUserComJobUni['companies']}}</h2>
                                    <p class="mb-0">{{ __('label.admin.dashboard.total_company')  }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="card counter">
                            <div class="card-body d-flex align-items-center">
                                <div class="card-box-icon">
                                    <i class="bi bi-briefcase" style="font-size: 22px;"></i>
                                    <!-- Bootstrap Icon cho Job -->
                                </div>
                                <div class="chart-num">
                                    <h2 class="font-w600 mb-0">{{$totalUserComJobUni['jobs']}}</h2>
                                    <p class="mb-0">{{ __('label.admin.dashboard.total_job')  }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <div class="card counter">
                            <div class="card-body d-flex align-items-center">
                                <div class="card-box-icon">
                                    <i class="bi bi-building" style="font-size: 22px;"></i>
                                    <!-- Bootstrap Icon cho Trường đại học -->
                                </div>
                                <div class="chart-num">
                                    <h2 class="mb-0">{{$totalUserComJobUni['universities']}}</h2>
                                    <p class="mb-0">{{ __('label.admin.dashboard.total_university')  }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
            </div>


            <div class="row">
                <div class="col-xl-8 wow fadeInUp" data-wow-delay="1.5s"
                     style="visibility: visible; animation-delay: 1.5s; animation-name: fadeInUp;">
                    <div class="card crypto-chart ">
                        <div class="card-header pb-0 border-0 flex-wrap">
                            <div class="mb-2 mb-sm-0">
                                <div class="chart-title mb-3">
                                    <h2 class="card-title">{{ __('label.admin.dashboard.job_statistics')  }}</h2>
                                </div>

                            </div>
                            <div class="p-static">
                                <div class="dropdown custom-dropdown">
                                    <div class="btn sharp btn-primary tp-btn " data-bs-toggle="dropdown">
                                        <svg width="5" height="15" viewBox="0 0 6 20" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                    d="M5.19995 10.001C5.19995 9.71197 5.14302 9.42576 5.03241 9.15872C4.9218 8.89169 4.75967 8.64905 4.55529 8.44467C4.35091 8.24029 4.10828 8.07816 3.84124 7.96755C3.5742 7.85694 3.28799 7.80001 2.99895 7.80001C2.70991 7.80001 2.4237 7.85694 2.15667 7.96755C1.88963 8.07816 1.64699 8.24029 1.44261 8.44467C1.23823 8.64905 1.0761 8.89169 0.965493 9.15872C0.854882 9.42576 0.797952 9.71197 0.797952 10.001C0.798085 10.5848 1.0301 11.1445 1.44296 11.5572C1.85582 11.9699 2.41571 12.2016 2.99945 12.2015C3.58319 12.2014 4.14297 11.9694 4.55565 11.5565C4.96832 11.1436 5.20008 10.5838 5.19995 10L5.19995 10.001ZM5.19995 3.00101C5.19995 2.71197 5.14302 2.42576 5.03241 2.15872C4.9218 1.89169 4.75967 1.64905 4.55529 1.44467C4.35091 1.24029 4.10828 1.07816 3.84124 0.967552C3.5742 0.856941 3.28799 0.800011 2.99895 0.800011C2.70991 0.800011 2.4237 0.856941 2.15667 0.967552C1.88963 1.07816 1.64699 1.24029 1.44261 1.44467C1.23823 1.64905 1.0761 1.89169 0.965493 2.15872C0.854883 2.42576 0.797953 2.71197 0.797953 3.00101C0.798085 3.58475 1.0301 4.14453 1.44296 4.55721C1.85582 4.96988 2.41571 5.20164 2.99945 5.20151C3.58319 5.20138 4.14297 4.96936 4.55565 4.5565C4.96832 4.14364 5.20008 3.58375 5.19995 3.00001L5.19995 3.00101ZM5.19995 17.001C5.19995 16.712 5.14302 16.4258 5.03241 16.1587C4.9218 15.8917 4.75967 15.6491 4.55529 15.4447C4.35091 15.2403 4.10828 15.0782 3.84124 14.9676C3.5742 14.8569 3.28799 14.8 2.99895 14.8C2.70991 14.8 2.4237 14.8569 2.15666 14.9676C1.88963 15.0782 1.64699 15.2403 1.44261 15.4447C1.23823 15.6491 1.0761 15.8917 0.965493 16.1587C0.854882 16.4258 0.797952 16.712 0.797952 17.001C0.798084 17.5848 1.0301 18.1445 1.44296 18.5572C1.85582 18.9699 2.41571 19.2016 2.99945 19.2015C3.58319 19.2014 4.14297 18.9694 4.55565 18.5565C4.96832 18.1436 5.20008 17.5838 5.19995 17L5.19995 17.001Z"
                                                    fill="#01A3FF"></path>
                                        </svg>
                                    </div>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        @php
                                            $total = 0;
                                            $totalYear = 0;
                                        @endphp
                                        @foreach($dataJobs as $y => $m )
                                            <a class="dropdown-item @if($y == $currentYear) active @endif"
                                               href="javascript:void(0);" onclick="changeActiveState(this); updateChart({{ json_encode($m) }})">{{$y}}</a>
                                            @foreach($m as $item)
                                                @php
                                                    $total += $item;
                                                    if ($y == $currentYear){
                                                        $totalYear += $item;
                                                        $data = json_encode($m);
                                                    }
                                                @endphp
                                            @endforeach
                                        @endforeach
                                    </div>

                                </div>
                                <div class="progress-content">
                                    <div class="d-flex justify-content-between">
                                        <p class="mb-0">{{ __('label.admin.dashboard.total')  }}: </p>
                                        <p class="pull-end mb-0"> {{$totalYear}}</p>
                                    </div>
                                    <div class="progress mt-1">
                                        <div class="progress-bar bg-primary"
                                             style="width: @if($total == 0) 0 @else {{number_format($totalYear / $total * 100, 0)}} @endif%; height:	100%;"
                                             role="progressbar">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-body pt-2 custome-tooltip pb-0">
                            <div id="activity"></div>
                        </div>
                    </div>
                </div>
                <!--column-->
                <div class="col-xl-4 wow fadeInUp" data-wow-delay="1s"
                     style="visibility: visible; animation-delay: 1s; animation-name: fadeInUp;">
                    <div class="card">
                        <div class="card-header border-0">
                            <h2 class="card-title">{{ __('label.admin.dashboard.com_uni_statistics')  }}</h2>

                        </div>
                        <div class="card-body text-center pt-0 pb-2">
                            <div id="pieChart" class="d-inline-block" style="min-height: 182.8px;">

                            </div>
                            <div class="chart-items">
                                <!--row-->
                                <div class="row">
                                    <!--column-->
                                    <div class=" col-xl-12 col-sm-12">
                                        <div class="text-start mt-2">
                                            <h6>Legend</h6>
                                            <div class="color-picker">
                                                <p class="mb-0  text-gray">
                                                    <svg class="me-2" width="14" height="14" viewBox="0 0 14 14"
                                                         fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect width="14" height="14" rx="4" fill="#9568FF"></rect>
                                                    </svg>
                                                    {{ __('label.admin.company')  }} ({{number_format($totalUserComJobUni['companies'] / ($totalUserComJobUni['universities'] + $totalUserComJobUni['companies']) * 100, 0) }}%)
                                                </p>
                                                <h6 class="mb-0">{{$totalUserComJobUni['companies']}}</h6>
                                            </div>
                                            <div class="color-picker">
                                                <p class="mb-0 text-gray">
                                                    <svg class="me-2" width="14" height="14" viewBox="0 0 14 14"
                                                         fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <rect width="14" height="14" rx="4" fill="#000"></rect>
                                                    </svg>
                                                    {{ __('label.admin.university')  }} ({{number_format($totalUserComJobUni['universities'] / ($totalUserComJobUni['universities'] + $totalUserComJobUni['companies']) * 100, 0) }}%)
                                                </p>
                                                <h6 class="mb-0">{{$totalUserComJobUni['universities']}}</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/column-->
                                </div>
                                <!--/row-->
                            </div>
                        </div>
                    </div>
                </div>
                <!--/column-->
            </div>

            <div class="row">
                <!--column-->
                <div class="col-lg-12 wow fadeInUp" data-wow-delay="1.5s" style="visibility: visible; animation-delay: 1.5s; animation-name: fadeInUp;">
                    <!--card-->
                    <div class="card statistic">
                        <div class="row">
                            <div class="col-xl-9">
                                <div class="card-header border-0 flex-wrap pb-2">
                                    <div class="chart-title mb-2 ">
                                        <h2 class="card-title text-white">{{ __('label.admin.dashboard.job_matching_statistics')  }}({{$currentYear}})</h2>
                                    </div>
                                </div>
                                <div class="card-body pt-0 custome-tooltip pe-0 pb-0">
                                    <div id="chartBarRunning"></div>
                                </div>
                            </div>
                            <div class="col-xl-3">
                                <div class="statistic-content">

                                    <div class="statistic-toggle my-3">
                                        <div class="toggle-btn" id="dzExpenseSeries">
                                            <div>
                                                <input type="checkbox" id="checkbox3" name="toggle-btn" value="Income">
                                                <label for="checkbox3" class="check"></label>
                                            </div>
                                            <div>
                                                <p class="mb-0 text-white">{{ __('label.admin.dashboard.job_matching_success')  }}</p>
                                                <h6 class="mb-0 text-white">1.982</h6>
                                            </div>
                                        </div>
                                        <div class="toggle-btn expense" id="dzIncomeSeries">
                                            <div>
                                                <input type="checkbox" id="checkbox2" name="toggle-btn" value="Expense">
                                                <label for="checkbox2" class="check"></label>
                                            </div>
                                            <div>
                                                <p class="mb-0 text-yellow">{{ __('label.admin.dashboard.job_vacant')  }}</p>
                                                <h6 class="mb-0 text-yellow">1.982</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <!--card-->
                                    <div class="card expense mb-3">
                                        <div class="card-body p-3">
                                            <div class="students1 d-flex align-items-center justify-content-between ">
                                                <div class="content">
                                                    <p class="mb-0 text-white">{{ __('label.admin.dashboard.job_matching_success')  }}
                                                    </p><h3 class="text-white">12,890</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/card-->
                                    <!--card-->
                                    <div class="card expense mb-3 ">
                                        <div class="card-body p-3 ">
                                            <div class="students1 d-flex align-items-center justify-content-between ">
                                                <div class="content">
                                                    <p class="mb-0 text-yellow">{{ __('label.admin.dashboard.job_vacant')  }}
                                                    </p><h3 class="text-yellow">12,890</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/card-->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/card-->
                </div>
                <!--/column-->
                <!--column-->


            </div>


        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let dzchart = null;
        var activity = function (data) {
            let month = @json(__('label.admin.dashboard.months'));
            month = month.slice(0, data.length);
            var optionsArea = {
                series: [
                    {
                        name: "Jobs",
                        data: data,
                    },
                ],
                chart: {
                    height: 300,
                    type: "area",
                    group: "social",
                    toolbar: {
                        show: false,
                    },
                    zoom: {
                        enabled: false,
                    },
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    width: [3, 3, 3],
                    colors: ["var(--secondary)", "var(--primary)"],
                    curve: "straight",
                },
                legend: {
                    show: false,
                    tooltipHoverFormatter: function (val, opts) {
                        return (
                            val +
                            " - " +
                            opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] +
                            ""
                        );
                    },
                    markers: {
                        fillColors: ["var(--secondary)", "var(--primary)"],
                        width: 10,
                        height: 10,
                        strokeWidth: 0,
                        radius: 16,
                    },
                },
                markers: {
                    size: [8, 8],
                    strokeWidth: [4, 4],
                    strokeColors: ["var(--secondary)", "var(--primary)"],
                    border: 2,
                    radius: 2,
                    colors: ["#fff", "#fff", "#fff"],
                    hover: {
                        size: 10,
                    },
                },
                xaxis: {
                    categories: month,
                    labels: {
                        style: {
                            colors: "var(--text)",
                            fontSize: "14px",
                            fontFamily: "Poppins",
                            fontWeight: 100,
                        },
                    },
                    axisBorder: {
                        show: false,
                    },
                },
                yaxis: {
                    labels: {
                        minWidth: 20,
                        offsetX: -16,
                        style: {
                            colors: "var(--text)",
                            fontSize: "14px",
                            fontFamily: "Poppins",
                            fontWeight: 100,
                        },
                    },
                },
                fill: {
                    colors: ["#fff", "#fff"],
                    type: "gradient",
                    opacity: 1,
                    gradient: {
                        shade: "light",
                        shadeIntensity: 1,
                        colorStops: [
                            [
                                {
                                    offset: 0,
                                    color: "#fff",
                                    opacity: 0,
                                },
                                {
                                    offset: 0.6,
                                    color: "#fff",
                                    opacity: 0,
                                },
                                {
                                    offset: 100,
                                    color: "#fff",
                                    opacity: 0,
                                },
                            ],
                            [
                                {
                                    offset: 0,
                                    color: "#fff",
                                    opacity: 0.4,
                                },
                                {
                                    offset: 50,
                                    color: "#fff",
                                    opacity: 0.25,
                                },
                                {
                                    offset: 100,
                                    color: "#fff",
                                    opacity: 0,
                                },
                            ],
                        ],
                    },
                },
                colors: ["#1EA7C5", "#FF9432"],
                grid: {
                    borderColor: "var(--border)",
                    xaxis: {
                        lines: {
                            show: true,
                        },
                    },
                    yaxis: {
                        lines: {
                            show: false,
                        },
                    },
                },

                responsive: [
                    {
                        breakpoint: 1602,
                        options: {
                            markers: {
                                size: [6, 6, 4],
                                hover: {
                                    size: 7,
                                },
                            },
                            chart: {
                                height: 230,
                            },
                        },
                    },
                ],
            };
            if (jQuery("#activity").length > 0) {
                dzchart = new ApexCharts(
                    document.querySelector("#activity"),
                    optionsArea
                );
                dzchart.render();
            }
        };

        var chartBarRunning = function (jobAccess, vacantJob) {
            let months = @json(__('label.admin.dashboard.months'));
            months = months.slice(0, jobAccess.length);
            vacantJob = vacantJob.slice(0, jobAccess.length)
            var options = {
                series: [
                    {
                        name: "{{ __('label.admin.dashboard.job_matching_success')  }}",
                        data: jobAccess,
                    },
                    {
                        name: "{{ __('label.admin.dashboard.job_vacant')  }}",
                        data: vacantJob,
                    },
                ],
                chart: {
                    type: "bar",
                    height: 350,

                    toolbar: {
                        show: false,
                    },
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        endingShape: "rounded",
                        columnWidth: "45%",
                        borderRadius: 5,
                    },
                },
                colors: ["#", "#77248B"],
                dataLabels: {
                    enabled: false,
                },
                markers: {
                    shape: "circle",
                },
                legend: {
                    show: false,
                    fontSize: "12px",
                    labels: {
                        colors: "#000000",
                    },
                    markers: {
                        width: 30,
                        height: 30,
                        strokeWidth: 0,
                        strokeColor: "#fff",
                        fillColors: undefined,
                        radius: 35,
                    },
                },
                stroke: {
                    show: true,
                    width: 6,
                    colors: ["transparent"],
                },
                grid: {
                    borderColor: "rgba(252, 252, 252,0.2)",
                },
                xaxis: {
                    categories: months,
                    labels: {
                        style: {
                            colors: "#ffffff",
                            fontSize: "13px",
                            fontFamily: "poppins",
                            fontWeight: 100,
                            cssClass: "apexcharts-xaxis-label",
                        },
                    },
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false,
                        borderType: "solid",
                        color: "#78909C",
                        height: 6,
                        offsetX: 0,
                        offsetY: 0,
                    },
                    crosshairs: {
                        show: false,
                    },
                },
                yaxis: {
                    labels: {
                        offsetX: -16,
                        style: {
                            colors: "#ffffff",
                            fontSize: "13px",
                            fontFamily: "poppins",
                            fontWeight: 100,
                            cssClass: "apexcharts-xaxis-label",
                        },
                    },
                },
                fill: {
                    opacity: 1,
                    colors: ["#ffffff", "#FFD125"],
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return val ;
                        },
                    },
                },
                responsive: [
                    {
                        breakpoint: 575,
                        options: {
                            plotOptions: {
                                bar: {
                                    columnWidth: "1%",
                                    borderRadius: -1,
                                },
                            },
                            chart: {
                                height: 250,
                            },
                            series: [
                                {
                                    name: "Projects",
                                    data: [31, 40, 28, 31, 40, 28, 31, 40],
                                },
                                {
                                    name: "Projects",
                                    data: [11, 32, 45, 31, 40, 28, 31, 40],
                                },
                            ],
                        },
                    },
                ],
            };

            if (jQuery("#chartBarRunning").length > 0) {
                let chart = new ApexCharts(
                    document.querySelector("#chartBarRunning"),
                    options
                );
                chart.render();

                jQuery("#checkbox2").on("change", function () {
                    jQuery("#dzIncomeSeries").toggleClass("disabled");
                    chart.toggleSeries("{{ __('label.admin.dashboard.job_vacant')  }}");
                });

                jQuery("#checkbox3").on("change", function () {
                    console.log("Checkbox 3 changed"); // Kiểm tra xem sự kiện có chạy không
                    jQuery("#dzExpenseSeries").toggleClass("disabled");
                    chart.toggleSeries("{{ __('label.admin.dashboard.job_matching_success')  }}");
                });

            }
        };

        var pieChart = function () {
            var options = {
                series: [{{$totalUserComJobUni['universities']}}, {{$totalUserComJobUni['companies']}}],
                chart: {
                    type: "donut",
                    height: 200,
                    innerRadius: 50,
                },
                dataLabels: {
                    enabled: false,
                },
                stroke: {
                    width: 0,
                },
                plotOptions: {
                    pie: {
                        startAngle: 0,
                        endAngle: 360,
                        donut: {
                            size: "80%",
                        },
                    },
                },
                colors: ["#2A353A", "#9568FF"],
                legend: {
                    position: "bottom",
                    show: false,
                },
                responsive: [
                    {
                        breakpoint: 768,
                        options: {
                            chart: {
                                width: 200,
                            },
                        },
                    },
                ],
            };

            var chart = new ApexCharts(document.querySelector("#pieChart"), options);
            chart.render();
        };


        pieChart()

        const totalJobInY = {!! $data !!};
        const totalApply = {!! json_encode($applyJobs) !!};
        console.log(totalJobInY, totalApply)

        function calculateDifference(totalJobs, totalApply) {
            // Chuyển object thành array chứa giá trị của các tháng
            const jobArr = Object.values(totalJobs);
            const applyArr = Object.values(totalApply);

            // Duyệt qua từng tháng và tính hiệu giữa job và apply
            const resultArr = jobArr.map((job, index) => job - (applyArr[index] || 0));

            return resultArr;
        }

        const differenceArray = calculateDifference(totalJobInY, totalApply);

        chartBarRunning(Object.values(totalApply), differenceArray)

        function updateChart(data){
            if (dzchart !== null) {
                dzchart.destroy();  // This removes the current chart
            }
            data = Object.values(data)
            activity(data)
        }

        updateChart(totalJobInY)

        function changeActiveState(selectedElement) {
            // Find all elements with class "active" and remove the class
            document.querySelectorAll(".dropdown-item.active").forEach((el) => {
                el.classList.remove("active");
            });

            // Add "active" class to the selected element
            selectedElement.classList.add("active");
        }

    </script>
@endsection
