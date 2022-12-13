<div class="container-fluid py-4">
    <div class="row">
        <div class="col-sm-3">
            <div class="card">
                <div class="card-body p-3 position-relative">
                    <div class="row">
                        <div class="col-7 text-start">
                            <p class="text-sm mb-1 text-capitalize font-weight-bold">Total Customers</p>
                            <h5 class="font-weight-bolder mb-0">
                                {{ $totalCustomers }}
                            </h5>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3 mt-sm-0 mt-4">
            <div class="card">
                <div class="card-body p-3 position-relative">
                   @if(auth()->user()->hasRole('Provider'))
                    <div class="row">
                        <div class="col-7 text-start">
                            <p class="text-sm mb-1 text-capitalize font-weight-bold">Completed Order</p>
                            <h5 class="font-weight-bolder mb-0">
                                {{ $totalCompletedOrders }}
                            </h5>
                        </div>
                        <div class="col-5">
                            <div class="dropdown text-end">
                                <a href="javascript:;" class="cursor-pointer text-secondary" id="dropdownUsers2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="ms-lg-n6 text-xs text-secondary">{{ $dateBeforeSeven->format('d M') }} - {{ $todayDate->format('d M') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="row">
                        <div class="col-7 text-start">
                            <p class="text-sm mb-1 text-capitalize font-weight-bold">New Customers</p>
                            <h5 class="font-weight-bolder mb-0">
                                {{ $newCustomers }}
                            </h5>
                        </div>
                        <div class="col-5">
                            <div class="dropdown text-end">
                                <a href="javascript:;" class="cursor-pointer text-secondary" id="dropdownUsers2" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="ms-lg-n6 text-xs text-secondary">{{ $dateBeforeSeven->format('d M') }} - {{ $todayDate->format('d M') }}</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-sm-3 mt-sm-0 mt-4">
            <div class="card">
                <div class="card-body p-3 position-relative">
                    <div class="row">
                        <div class="col-7 text-start">
                            <p class="text-sm mb-1 text-capitalize font-weight-bold">Total Order</p>
                            <h5 class="font-weight-bolder mb-0">
                                {{ $totalOrders }}
                            </h5>
                        </div>
                        <div class="col-5">
                            <div class="dropdown text-end">
                                <a href="javascript:;" class="cursor-pointer text-secondary" id="dropdownUsers3" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="ms-lg-n6 text-xs text-secondary">{{ $dateBeforeSeven->format('d M') }} - {{ $todayDate->format('d M') }}</span>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-3 mt-sm-0 mt-4">
            <div class="card">
                <div class="card-body p-3 position-relative">
                    <div class="row">
                        <div class="col-7 text-start">
                            <p class="text-sm mb-1 text-capitalize font-weight-bold">Sales</p>
                            <h5 class="font-weight-bolder mb-0 me-lg-n1">
                                {{ \Utils::ConvertPrice($sales) }}
                            </h5>
                        </div>
                        <div class="col-5">
                            <div class="dropdown text-end">
                                <a href="javascript:;" class="cursor-pointer text-secondary" id="dropdownUsers3" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="ms-lg-n6 text-xs text-secondary">{{ $dateBeforeSeven->format('d M') }} - {{ $todayDate->format('d M') }}</span>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-4 col-sm-6">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-0">Orders</h6>
                    </div>
                </div>
                <div class="card-body pb-0 p-3 mt-4">
                    <div class="row">
                        <div class="col-7 text-start">
                            <div class="chart">
                                <canvas id="chart-pie" class="chart-canvas" height="200"></canvas>
                            </div>
                        </div>
                        <div class="col-5 my-auto">
                            <span class="badge badge-md badge-dot me-4 d-block text-start">
                                <i class="bg-info"></i>
                                <span class="text-dark text-xs">Completed</span>
                            </span>
                            <span class="badge badge-md badge-dot me-4 d-block text-start">
                                <i class="bg-primary"></i>
                                <span class="text-dark text-xs">Pending</span>
                            </span>
                            <span class="badge badge-md badge-dot me-4 d-block text-start">
                                <i class="bg-dark"></i>
                                <span class="text-dark text-xs">Cancelled</span>
                            </span>
                            <span class="badge badge-md badge-dot me-4 d-block text-start">
                                <i class="bg-secondary"></i>
                                <span class="text-dark text-xs">Refund</span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-sm-6 mt-sm-0 mt-4">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex justify-content-between">
                        <h6 class="mb-0">Revenue</h6>
                    </div>
                    <div class="d-flex align-items-center">
                        <span class="badge badge-md badge-dot me-4">
                            <i class="bg-primary"></i>
                            <span class="text-dark text-xs">Total</span>
                        </span>
                        <span class="badge badge-md badge-dot me-4">
                            <i class="bg-dark"></i>
                            <span class="text-dark text-xs">Completed</span>
                        </span>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="chart-line" class="chart-canvas" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@push('js')
<script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.min.js"></script>
<script src="{{ asset('assets') }}/js/plugins/chartjs.min.js"></script>
<script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");
    var ctx2 = document.getElementById("chart-pie").getContext("2d");
    
    var cData = @json($data);
    new Chart(ctx1, {
        type: "line",
        data: {
            labels: cData.months,
            datasets: [{
                    label: "Total",
                    tension: 0,
                    pointRadius: 5,
                    pointBackgroundColor: "#e91e63",
                    pointBorderColor: "transparent",
                    borderColor: "#e91e63",
                    borderWidth: 4,
                    backgroundColor: "transparent",
                    fill: true,
                    data: cData.total,
                    maxBarThickness: 6
                },
                {
                    label: "Completed",
                    tension: 0,
                    borderWidth: 0,
                    pointRadius: 5,
                    pointBackgroundColor: "#4caf50",
                    pointBorderColor: "transparent",
                    borderColor: "#4caf50",
                    borderWidth: 4,
                    backgroundColor: "transparent",
                    fill: true,
                    data: cData.completed,
                    maxBarThickness: 6
                }
            ],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5],
                        color: '#c1c4ce5c'
                    },
                    ticks: {
                        display: true,
                        padding: 10,
                        color: '#9ca2b7',
                        font: {
                            size: 14,
                            weight: 300,
                            family: "Roboto",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: true,
                        borderDash: [5, 5],
                        color: '#c1c4ce5c'
                    },
                    ticks: {
                        display: true,
                        color: '#9ca2b7',
                        padding: 10,
                        font: {
                            size: 14,
                            weight: 300,
                            family: "Roboto",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
            },
        },
    });
 
        
    // Pie chart
   
    new Chart(ctx2, {
    type: "pie",
    data: {
        labels: cData.label,
        datasets: [{
            label: "Projects",
            weight: 9,
            cutout: 0,
            tension: 0.9,
            pointRadius: 2,
            borderWidth: 1,
            backgroundColor: ['#17c1e8', '#e91e63', '#3A416F', '#a8b8d8'],
            data: cData.data,
            fill: false
        }],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: false,
            }
        },
        interaction: {
            intersect: false,
            mode: 'index',
        },
        scales: {
            y: {
                grid: {
                    drawBorder: false,
                    display: false,
                    drawOnChartArea: false,
                    drawTicks: false,
                    color: '#c1c4ce5c'
                },
                ticks: {
                    display: false
                }
            },
            x: {
                grid: {
                    drawBorder: false,
                    display: false,
                    drawOnChartArea: false,
                    drawTicks: false,
                    color: '#c1c4ce5c'
                },
                ticks: {
                    display: false,
                }
            },
        },
    },
    });

</script>
@endpush