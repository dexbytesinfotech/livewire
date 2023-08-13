<div class="container-fluid py-4 bg-gray-200">
    <div class="row mt-5">
        <div class="col-xl-8 col-lg-7">
            <div class="row">
                <div class="col-sm-4">
                    <div class="card">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-success shadow-success border-radius-lg py-2 pe-1">
                                <div class="chart">
                                    <canvas id="chart-line-1" class="chart-canvas" height="100"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="card-body py-3">
                            <p class="text-sm mb-0">Visitors</p>
                            <h5 class="font-weight-bolder mb-0">
                                5,927
                                <span class="text-success text-sm font-weight-bolder">+55%</span>
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 mt-md-0 mt-5">
                    <div class="card">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="bg-gradient-primary shadow-primary border-radius-lg py-2 pe-1">
                                <div class="chart">
                                    <canvas id="chart-line-2" class="chart-canvas" height="100"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="card-body py-3">
                            <p class="text-sm mb-0">Income</p>
                            <h5 class="font-weight-bolder mb-0">
                                $130,832
                                <span class="text-success text-sm font-weight-bolder">+90%</span>
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 mt-md-0 mt-5">
                    <div class="card h-100">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div
                                class="bg-gradient-dark shadow-dark border-radius-lg py-2 pe-1 d-flex align-items-center text-center">
                                <a href="javascript:;" class="mx-auto my-3">
                                    <i class="material-icons text-white text-xl mb-1" aria-hidden="true">add</i>
                                    <h6 class="text-white font-weight-normal"> New tab </h6>
                                </a>
                            </div>
                        </div>
                        <div class="card-body pt-1 pb-2 d-flex flex-column justify-content-center text-center">
                            <p class="mb-0 text-sm">Press the button above and complete the new tab data.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card widget-calendar h-100">
                        <!-- Card header -->
                        <div class="card-header p-3 pb-0">
                            <h6 class="mb-0">Calendar</h6>
                            <div class="d-flex">
                                <div class="p text-sm mb-0 widget-calendar-day"></div>
                                <span>,&nbsp;</span>
                                <div class="p text-sm mb-1 widget-calendar-year"></div>
                            </div>
                        </div>
                        <!-- Card body -->
                        <div class="card-body p-3">
                            <div data-toggle="widget-calendar"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-5 mt-lg-0 mt-4">
            <div class="row">
                <div class="col-lg-12 mt-4 mt-lg-0">
                    <div class="card">
                        <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                            <div class="overflow-hidden position-relative border-radius-lg shadow-dark bg-cover h-100"
                                style="background-image: url('{{ asset('assets') }}/img/ivancik.jpg');">
                                <span class="mask bg-gradient-dark"></span>
                                <div class="card-body position-relative z-index-1 h-100 p-3">
                                    <h6 class="text-white font-weight-bolder mb-3">Hey John!</h6>
                                    <p class="text-white mb-3">Wealth creation is an evolutionarily recent
                                        positive-sum game. It is all about who take the opportunity first.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="card-body py-3">
                            <a class="btn btn-round btn-sm btn-outline-dark mb-0" href="javascript:;">
                                Read More
                                <i class="material-icons text-sm ms-1">chevron_right</i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-sm-6">
                    <div class="card mt-4">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0">Categories</h6>
                        </div>
                        <div class="card-body p-3">
                            <ul class="list-group">
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                            <i class="material-icons opacity-10 pt-2">launch</i>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Devices</h6>
                                            <span class="text-xs">250 in stock, <span class="font-weight-bold">346+
                                                    sold</span></span>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <button
                                            class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                                class="ni ni-bold-right" aria-hidden="true"></i></button>
                                    </div>
                                </li>
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                            <i class="material-icons opacity-10 pt-2">book_online</i>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Tickets</h6>
                                            <span class="text-xs">123 closed, <span class="font-weight-bold">15
                                                    open</span></span>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <button
                                            class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                                class="ni ni-bold-right" aria-hidden="true"></i></button>
                                    </div>
                                </li>
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                            <i class="material-icons opacity-10 pt-2">priority_high</i>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">Error logs</h6>
                                            <span class="text-xs">1 is active, <span class="font-weight-bold">40
                                                    closed</span></span>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <button
                                            class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                                class="ni ni-bold-right" aria-hidden="true"></i></button>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-sm-6">
                    <div class="card mt-5">
                        <div class="card-body p-3 pt-0">
                            <div class="row">
                                <div class="col-4">
                                    <img src="{{ asset('assets') }}/img/kal-visuals-square.jpg" alt="kal"
                                        class="border-radius-lg shadow shadow-dark w-100 mt-n4">
                                </div>
                                <div class="col-8 my-auto">
                                    <p class="text-muted text-sm mt-3">
                                        Today is Mike's birthday. Wish him the best of luck!
                                    </p>
                                    <a href="javascript:;" class="btn btn-sm bg-gradient-dark mb-0">Send
                                        message</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-sm-6">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="mb-0">Transactions</h6>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end align-items-center">
                            <i class="material-icons me-2 text-lg">date_range</i>
                            <small>23 - 30 March 2021</small>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <ul class="list-group">
                        <li class="list-group-item border-0 justify-content-between ps-0 pb-0 border-radius-lg">
                            <div class="d-flex">
                                <div class="d-flex align-items-center">
                                    <button
                                        class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i
                                            class="material-icons text-lg">expand_more</i></button>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Netflix</h6>
                                        <span class="text-xs">27 March 2020, at 12:30 PM</span>
                                    </div>
                                </div>
                                <div
                                    class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold ms-auto">
                                    - $ 2,500
                                </div>
                            </div>
                            <hr class="horizontal dark mt-3 mb-2" />
                        </li>
                        <li class="list-group-item border-0 justify-content-between ps-0 pb-0 border-radius-lg">
                            <div class="d-flex">
                                <div class="d-flex align-items-center">
                                    <button
                                        class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i
                                            class="material-icons text-lg">expand_less</i></button>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Apple</h6>
                                        <span class="text-xs">23 March 2020, at 04:30 AM</span>
                                    </div>
                                </div>
                                <div
                                    class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold ms-auto">
                                    + $ 2,000
                                </div>
                            </div>
                            <hr class="horizontal dark mt-3 mb-2" />
                        </li>
                        <li class="list-group-item border-0 justify-content-between ps-0 mb-2 border-radius-lg">
                            <div class="d-flex">
                                <div class="d-flex align-items-center">
                                    <button
                                        class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i
                                            class="material-icons text-lg">expand_less</i></button>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Partner #22213</h6>
                                        <span class="text-xs">19 March 2020, at 02:50 AM</span>
                                    </div>
                                </div>
                                <div
                                    class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold ms-auto">
                                    + $ 1,400
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-6 mt-sm-0 mt-4">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="mb-0">Revenue</h6>
                        </div>
                        <div class="col-md-6 d-flex justify-content-end align-items-center">
                            <i class="material-icons me-2 text-lg">date_range</i>
                            <small>01 - 07 June 2021</small>
                        </div>
                    </div>
                </div>
                <div class="card-body p-3">
                    <ul class="list-group">
                        <li class="list-group-item border-0 justify-content-between ps-0 pb-0 border-radius-lg">
                            <div class="d-flex">
                                <div class="d-flex align-items-center">
                                    <button
                                        class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i
                                            class="material-icons text-lg">expand_less</i></button>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">via PayPal</h6>
                                        <span class="text-xs">07 June 2021, at 09:00 AM</span>
                                    </div>
                                </div>
                                <div
                                    class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold ms-auto">
                                    + $ 4,999
                                </div>
                            </div>
                            <hr class="horizontal dark mt-3 mb-2" />
                        </li>
                        <li class="list-group-item border-0 justify-content-between ps-0 pb-0 border-radius-lg">
                            <div class="d-flex">
                                <div class="d-flex align-items-center">
                                    <button
                                        class="btn btn-icon-only btn-rounded btn-outline-success mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i
                                            class="material-icons text-lg">expand_less</i></button>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Partner #90211</h6>
                                        <span class="text-xs">07 June 2021, at 05:50 AM</span>
                                    </div>
                                </div>
                                <div
                                    class="d-flex align-items-center text-success text-gradient text-sm font-weight-bold ms-auto">
                                    + $ 700
                                </div>
                            </div>
                            <hr class="horizontal dark mt-3 mb-2" />
                        </li>
                        <li class="list-group-item border-0 justify-content-between ps-0 mb-2 border-radius-lg">
                            <div class="d-flex">
                                <div class="d-flex align-items-center">
                                    <button
                                        class="btn btn-icon-only btn-rounded btn-outline-danger mb-0 me-3 p-3 btn-sm d-flex align-items-center justify-content-center"><i
                                            class="material-icons text-lg">expand_more</i></button>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">Services</h6>
                                        <span class="text-xs">07 June 2021, at 07:10 PM</span>
                                    </div>
                                </div>
                                <div
                                    class="d-flex align-items-center text-danger text-gradient text-sm font-weight-bold ms-auto">
                                    - $ 1,800
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!--   Core JS Files   -->
@push('js') 
<script src="{{ asset('assets') }}/js/plugins/fullcalendar.min.js"></script>
<!-- Kanban scripts -->

<script src="{{ asset('assets') }}/js/plugins/chartjs.min.js"></script>
<script>
    var ctx1 = document.getElementById("chart-line-1").getContext("2d");

    var ctx2 = document.getElementById("chart-line-2").getContext("2d");

    new Chart(ctx1, {
        type: "line",
        data: {
            labels: ["A", "M", "J", "J", "A", "S", "O", "N", "D"],
            datasets: [{
                label: "Visitors",
                tension: 0.5,
                borderWidth: 0,
                pointRadius: 0,
                borderColor: "#fff",
                borderWidth: 2,
                backgroundColor: "transparent",
                data: [50, 45, 60, 60, 80, 65, 90, 80, 100],
                maxBarThickness: 6,
                fill: true
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
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5],
                    },
                    ticks: {
                        display: true,
                        padding: 10,
                        color: '#f8f9fa',
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5],
                        color: 'rgba(255, 255, 255, .2)'
                    },
                    ticks: {
                        display: true,
                        padding: 10,
                        color: '#f8f9fa',
                    }
                },
            },
        },
    });

    new Chart(ctx2, {
        type: "line",
        data: {
            labels: ["A", "M", "J", "J", "A", "S", "O", "N", "D"],
            datasets: [{
                label: "Income",
                tension: 0.5,
                borderWidth: 0,
                pointRadius: 0,
                borderColor: "#fff",
                borderWidth: 2,
                backgroundColor: "transparent",
                data: [60, 80, 75, 90, 67, 100, 90, 110, 120],
                maxBarThickness: 6,
                fill: true
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
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5],
                        color: 'rgba(255, 255, 255, .2)'

                    },
                    ticks: {
                        callback: function (value, index, values) {
                            return '$' + value;
                        },
                        display: true,
                        padding: 10,
                        color: '#f8f9fa',
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5],
                        color: 'rgba(255, 255, 255, .2)'
                    },
                    ticks: {
                        display: true,
                        padding: 10,
                        color: '#f8f9fa',
                    }
                },
            },
        },
    });

</script>
@endpush
