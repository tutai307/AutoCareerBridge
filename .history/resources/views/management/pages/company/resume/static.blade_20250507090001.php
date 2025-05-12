@extends('management.layouts.main')

@section('content')
    <div class="container">
        <h1>Company Resume</h1>
    </div>

    @if(isset($selectedJob))
    <div class="row">
        <!-- Thống kê tổng quan -->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-3 col-sm-6">
                            <div class="widget-stat card bg-primary">
                                <div class="card-body p-4">
                                    <h4 class="text-white">Tổng số CV</h4>
                                    <h3 class="text-white">{{ $stats['total'] }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="widget-stat card bg-warning">
                                <div class="card-body p-4">
                                    <h4 class="text-white">Chưa duyệt</h4>
                                    <h3 class="text-white">{{ $stats['pending'] }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="widget-stat card bg-success">
                                <div class="card-body p-4">
                                    <h4 class="text-white">Phù hợp</h4>
                                    <h3 class="text-white">{{ $stats['suitable'] }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <div class="widget-stat card bg-danger">
                                <div class="card-body p-4">
                                    <h4 class="text-white">Không phù hợp</h4>
                                    <h3 class="text-white">{{ $stats['notSuitable'] }}</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Biểu đồ phân phối điểm -->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Phân phối điểm đánh giá</h4>
                </div>
                <div class="card-body">
                    <canvas id="scoreDistributionChart"></canvas>
                </div>
            </div>
        </div>

        <!-- Biểu đồ trạng thái CV -->
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Trạng thái CV</h4>
                </div>
                <div class="card-body">
                    <canvas id="applicationStatusChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    $(document).ready(function() {
        $('#jobSelect').change(function() {
            const jobId = $(this).val();
            if (jobId) {
                window.location.href = `/company/manage-resumes/static/${jobId}`;
            }
        });

        @if(isset($selectedJob))
        // Biểu đồ phân phối điểm
        const scoreCtx = document.getElementById('scoreDistributionChart').getContext('2d');
        new Chart(scoreCtx, {
            type: 'bar',
            data: {
                labels: ['0-20', '21-40', '41-60', '61-80', '81-100'],
                datasets: [{
                    label: 'Số lượng CV',
                    data: [
                        {{ $scoreDistribution['0-20'] }},
                        {{ $scoreDistribution['21-40'] }},
                        {{ $scoreDistribution['41-60'] }},
                        {{ $scoreDistribution['61-80'] }},
                        {{ $scoreDistribution['81-100'] }}
                    ],
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Phân phối điểm đánh giá CV'
                    }
                }
            }
        });

        // Biểu đồ trạng thái CV
        const statusCtx = document.getElementById('applicationStatusChart').getContext('2d');
        new Chart(statusCtx, {
            type: 'pie',
            data: {
                labels: ['Chưa duyệt', 'Phù hợp', 'Không phù hợp'],
                datasets: [{
                    data: [
                        {{ $stats['pending'] }},
                        {{ $stats['suitable'] }},
                        {{ $stats['notSuitable'] }}
                    ],
                    backgroundColor: [
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(255, 99, 132, 0.5)'
                    ],
                    borderColor: [
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Trạng thái CV'
                    }
                }
            }
        });
        @endif
    });
    </script>
@endsection
