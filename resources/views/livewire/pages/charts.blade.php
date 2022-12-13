<div class="container-fluid py-4 bg-gray-200">
    <div class="row">
        <div class="col-md-6">
            <h5 class="mb-0">Charts</h5>
            <p class="text-sm mb-0">
                Charts on this page use Chart.js - Simple yet flexible JavaScript charting for designers &
                developers.
            </p>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-6 col-12">
            <div class="card z-index-2 mt-4">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 me-3 float-start">
                        <i class="material-icons opacity-10">insights</i>
                    </div>
                    <div class="d-block d-md-flex">
                        <div class="me-auto">
                            <h6 class="mb-0">Line chart</h6>
                            <p class="mb-0 text-sm">Product insights</p>
                        </div>
                        <span class="badge badge-lg badge-dot me-4 d-inline-block text-start">
                            <i class="bg-primary"></i>
                            <span class="text-dark">Organic</span>
                        </span>
                        <span class="badge badge-lg badge-dot me-4 d-inline-block text-start">
                            <i class="bg-dark"></i>
                            <span class="text-dark">Refferal</span>
                        </span>
                        <span class="badge badge-lg badge-dot me-4 d-inline-block text-start">
                            <i class="bg-info"></i>
                            <span class="text-dark">Direct</span>
                        </span>
                    </div>
                </div>
                <div class="card-body p-3 pt-0">
                    <div class="chart">
                        <canvas id="line-chart" class="chart-canvas" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12 mt-md-0 mt-4">
            <div class="card z-index-2 mt-4">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 me-3 float-start">
                        <i class="material-icons opacity-10">show_chart</i>
                    </div>
                    <div class="d-block d-md-flex">
                        <div class="me-auto">
                            <h6 class="mb-0">Line chart without dots</h6>
                            <p class="mb-0 text-sm">Visits from devices</p>
                        </div>
                        <span class="badge badge-lg badge-dot me-4 d-inline-block text-start">
                            <i class="bg-primary"></i>
                            <span class="text-dark">Mobile Apps</span>
                        </span>
                        <span class="badge badge-lg badge-dot me-4 d-inline-block text-start">
                            <i class="bg-dark"></i>
                            <span class="text-dark">Websites</span>
                        </span>
                    </div>
                </div>
                <div class="card-body p-3 pt-0">
                    <div class="chart">
                        <canvas id="line-chart-gradient" class="chart-canvas" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-6 col-12">
            <div class="card z-index-2 mt-4">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 me-3 float-start">
                        <i class="material-icons opacity-10">leaderboard</i>
                    </div>
                    <h6 class="mb-0">Bar chart</h6>
                    <p class="mb-0 text-sm">Sales related to age average</p>
                </div>
                <div class="card-body p-3 pt-0">
                    <div class="chart">
                        <canvas id="bar-chart" class="chart-canvas" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12 mt-md-0 mt-4">
            <div class="card z-index-2 mt-4">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 me-3 float-start">
                        <i class="material-icons opacity-10">splitscreen</i>
                    </div>
                    <h6 class="mb-0">Bar chart horizontal</h6>
                    <p class="mb-0 text-sm">Sales related to age average</p>
                </div>
                <div class="card-body p-3 pt-0">
                    <div class="chart">
                        <canvas id="bar-chart-horizontal" class="chart-canvas" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-6 col-12">
            <div class="card z-index-2 mt-4">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 me-3 float-start">
                        <i class="material-icons opacity-10">auto_graph</i>
                    </div>
                    <h6 class="mb-0">Mixed chart</h6>
                    <p class="mb-0 text-sm">Analytics Insights</p>
                </div>
                <div class="card-body p-3 pt-0">
                    <div class="chart">
                        <canvas id="mixed-chart" class="chart-canvas" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12 mt-md-0 mt-4">
            <div class="card z-index-2 mt-4">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 me-3 float-start">
                        <i class="material-icons opacity-10">multiline_chart</i>
                    </div>
                    <h6 class="mb-0">Bubble chart</h6>
                    <p class="mb-0 text-sm">Users divided by regions</p>
                </div>
                <div class="card-body p-3 pt-0">
                    <div class="chart">
                        <canvas id="bubble-chart" class="chart-canvas" height="140"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-lg-6 col-12">
            <div class="card z-index-2 mt-4">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-warning shadow-warning text-center border-radius-xl mt-n4 me-3 float-start">
                        <i class="material-icons opacity-10">donut_small</i>
                    </div>
                    <h6 class="mb-0">Doughnut chart</h6>
                    <p class="mb-0 text-sm">Affiliates program</p>
                </div>
                <div class="card-body d-flex p-3 pt-0">
                    <div class="chart w-50">
                        <canvas id="doughnut-chart" class="chart-canvas" height="300"></canvas>
                    </div>
                    <div class="table-responsive w-50">
                        <table class="table align-items-center mb-0">
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="{{ asset('assets') }}/img/small-logos/devto.svg"
                                                    class="avatar avatar-sm me-2" alt="logo_xd">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">DevTo</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold"> 25% </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="{{ asset('assets') }}/img/small-logos/creative-tim.svg"
                                                    class="avatar avatar-sm me-2" alt="logo_atlassian">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">CreativeTim</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold"> 13% </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="{{ asset('assets') }}/img/small-logos/bootstrap.svg"
                                                    class="avatar avatar-sm me-2" alt="logo_slack">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Bootsnip</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold"> 12% </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="{{ asset('assets') }}/img/small-logos/github.svg"
                                                    class="avatar avatar-sm me-2" alt="logo_spotify">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Github</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold"> 37% </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div>
                                                <img src="{{ asset('assets') }}/img/small-logos/google-webdev.svg"
                                                    class="avatar avatar-sm me-2" alt="logo_jira">
                                            </div>
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">Codeinwp</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <span class="text-xs font-weight-bold"> 13% </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-12 mt-md-0 mt-4">
            <div class="card z-index-2 mt-4">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-warning shadow-warning text-center border-radius-xl mt-n4 me-3 float-start">
                        <i class="material-icons opacity-10">pie_chart</i>
                    </div>
                    <h6 class="mb-0">Pie chart</h6>
                    <p class="mb-0 text-sm">Analytics Insights</p>
                </div>
                <div class="card-body d-flex p-3 pt-0">
                    <div class="chart w-50">
                        <canvas id="pie-chart" class="chart-canvas" height="300"></canvas>
                    </div>
                    <div class="w-50 my-auto ms-5">
                        <span class="badge badge-lg badge-dot me-4 d-block text-start">
                            <i class="bg-info"></i>
                            <span class="text-dark">Facebook</span>
                        </span>
                        <span class="badge badge-lg badge-dot me-4 d-block text-start">
                            <i class="bg-primary"></i>
                            <span class="text-dark">Direct</span>
                        </span>
                        <span class="badge badge-lg badge-dot me-4 d-block text-start">
                            <i class="bg-dark"></i>
                            <span class="text-dark">Organic</span>
                        </span>
                        <span class="badge badge-lg badge-dot me-4 d-block text-start">
                            <i class="bg-secondary"></i>
                            <span class="text-dark">Referral</span>
                        </span>
                        <p class="text-sm mt-3">
                            More than <b>1,200,000</b> sales are made using referral marketing, and
                            <b>700,000</b> are from social media.
                        </p>
                        <a class="btn bg-gradient-secondary mb-0" href="javascript:;">Read more</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="card z-index-2 mt-4">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 me-3 float-start">
                        <i class="material-icons opacity-10">data_saver_on</i>
                    </div>
                    <h6 class="mb-0">Radar chart</h6>
                    <p class="mb-0 text-sm">Sciences score</p>
                </div>
                <div class="card-body p-5 pt-0">
                    <div class="chart">
                        <canvas id="radar-chart" class="chart-canvas" height="100"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 mt-md-0 mt-4">
            <div class="card z-index-2 mt-4">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 me-3 float-start">
                        <i class="material-icons opacity-10">scatter_plot</i>
                    </div>
                    <h6 class="mb-0">Polar chart</h6>
                    <p class="mb-0 text-sm">Analytics Insights</p>
                </div>
                <div class="card-body p-5 pt-0">
                    <div class="chart">
                        <canvas id="polar-chart" class="chart-canvas" height="100"></canvas>
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
    // Line chart
    var ctx1 = document.getElementById("line-chart").getContext("2d");

    new Chart(ctx1, {
        type: "line",
        data: {
            labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                    label: "Organic Search",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 2,
                    pointBackgroundColor: "#e91e63",
                    borderColor: "#e91e63",
                    borderWidth: 3,
                    backgroundColor: "transparent",
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 6
                },
                {
                    label: "Referral",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 2,
                    pointBackgroundColor: "#3A416F",
                    borderColor: "#3A416F",
                    borderWidth: 3,
                    backgroundColor: "transparent",
                    data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
                    maxBarThickness: 6
                },
                {
                    label: "Direct",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 2,
                    pointBackgroundColor: "#03A9F4",
                    borderColor: "#03A9F4",
                    borderWidth: 3,
                    backgroundColor: "transparent",
                    data: [40, 80, 70, 90, 30, 90, 140, 130, 200],
                    maxBarThickness: 6
                },
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
                        color: '#b2b9bf',
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
                        color: '#b2b9bf',
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

    // Line chart with gradient
    var ctx2 = document.getElementById("line-chart-gradient").getContext("2d");

    new Chart(ctx2, {
        type: "line",
        data: {
            labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                    label: "Mobile apps",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#e91e63",
                    borderWidth: 3,
                    backgroundColor: "transparent",
                    fill: true,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 6

                },
                {
                    label: "Websites",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    borderColor: "#3A416F",
                    borderWidth: 3,
                    backgroundColor: "transparent",
                    fill: true,
                    data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
                    maxBarThickness: 6
                },
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
                        color: '#b2b9bf',
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
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                        borderDash: [5, 5],
                        color: '#c1c4ce5c'
                    },
                    ticks: {
                        display: true,
                        color: '#b2b9bf',
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

    // Doughnut chart
    var ctx3 = document.getElementById("doughnut-chart").getContext("2d");

    new Chart(ctx3, {
        type: "doughnut",
        data: {
            labels: ['Creative Tim', 'Github', 'Bootsnipp', 'Dev.to', 'Codeinwp'],
            datasets: [{
                label: "Projects",
                weight: 9,
                cutout: 60,
                tension: 0.9,
                pointRadius: 2,
                borderWidth: 2,
                backgroundColor: ['#03A9F4', '#3A416F', '#fb8c00', '#a8b8d8', '#e91e63'],
                data: [15, 20, 12, 60, 20],
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
                    },
                    ticks: {
                        display: false,
                    }
                },
            },
        },
    });

    // Pie chart
    var ctx4 = document.getElementById("pie-chart").getContext("2d");

    new Chart(ctx4, {
        type: "pie",
        data: {
            labels: ['Facebook', 'Direct', 'Organic', 'Referral'],
            datasets: [{
                label: "Projects",
                weight: 9,
                cutout: 0,
                tension: 0.9,
                pointRadius: 2,
                borderWidth: 2,
                backgroundColor: ['#03A9F4', '#e91e63', '#3A416F', '#a8b8d8'],
                data: [15, 20, 12, 60],
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
                    },
                    ticks: {
                        display: false,
                    }
                },
            },
        },
    });

    // Bar chart
    var ctx5 = document.getElementById("bar-chart").getContext("2d");

    new Chart(ctx5, {
        type: "bar",
        data: {
            labels: ['16-20', '21-25', '26-30', '31-36', '36-42', '42+'],
            datasets: [{
                label: "Sales by age",
                weight: 5,
                borderWidth: 0,
                borderRadius: 4,
                backgroundColor: '#3A416F',
                data: [15, 20, 12, 60, 20, 15],
                fill: false,
                maxBarThickness: 35
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
                        display: false,
                        drawOnChartArea: true,
                        drawTicks: true,
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

    // Bar chart horizontal
    var ctx6 = document.getElementById("bar-chart-horizontal").getContext("2d");

    new Chart(ctx6, {
        type: "bar",
        data: {
            labels: ['16-20', '21-25', '26-30', '31-36', '36-42', '42+'],
            datasets: [{
                label: "Sales by age",
                weight: 5,
                borderWidth: 0,
                borderRadius: 4,
                backgroundColor: '#3A416F',
                data: [15, 20, 12, 60, 20, 15],
                fill: false
            }],
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
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
                        display: false,
                        drawOnChartArea: true,
                        drawTicks: true,
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

    // Mixed chart
    var ctx7 = document.getElementById("mixed-chart").getContext("2d");

    new Chart(ctx7, {
        data: {
            labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                    type: "bar",
                    label: "Organic Search",
                    weight: 5,
                    tension: 0.4,
                    borderWidth: 0,
                    pointBackgroundColor: "#3A416F",
                    borderColor: "#3A416F",
                    backgroundColor: '#3A416F',
                    borderRadius: 4,
                    borderSkipped: false,
                    data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 10,
                },
                {
                    type: "line",
                    label: "Referral",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 0,
                    pointBackgroundColor: "#e91e63",
                    borderColor: "#e91e63",
                    borderWidth: 3,
                    backgroundColor: "transparent",
                    data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
                    fill: true,
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
                        color: '#b2b9bf',
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
                        color: '#b2b9bf',
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

    // Bubble chart
    var ctx8 = document.getElementById("bubble-chart").getContext("2d");

    new Chart(ctx8, {
        type: "bubble",
        data: {
            labels: ['0', '10', '20', '30', '40', '50', '60', '70', '80', '90'],
            datasets: [{
                    label: 'Dataset 1',
                    data: [{
                        x: 100,
                        y: 0,
                        r: 10
                    }, {
                        x: 60,
                        y: 30,
                        r: 20
                    }, {
                        x: 40,
                        y: 350,
                        r: 10
                    }, {
                        x: 80,
                        y: 80,
                        r: 10
                    }, {
                        x: 20,
                        y: 30,
                        r: 15
                    }, {
                        x: 0,
                        y: 100,
                        r: 5
                    }],
                    backgroundColor: '#e91e63',
                },
                {
                    label: 'Dataset 2',
                    data: [{
                        x: 70,
                        y: 40,
                        r: 10
                    }, {
                        x: 30,
                        y: 60,
                        r: 20
                    }, {
                        x: 10,
                        y: 300,
                        r: 25
                    }, {
                        x: 60,
                        y: 200,
                        r: 10
                    }, {
                        x: 50,
                        y: 300,
                        r: 15
                    }, {
                        x: 20,
                        y: 350,
                        r: 5
                    }],
                    backgroundColor: '#3A416F',
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
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
                        color: '#b2b9bf',
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
                        drawTicks: false,
                        borderDash: [5, 5],
                        color: '#c1c4ce5c'
                    },
                    ticks: {
                        display: true,
                        color: '#b2b9bf',
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

    // Radar chart
    var ctx9 = document.getElementById("radar-chart").getContext("2d");

    new Chart(ctx9, {
        type: "radar",
        data: {
            labels: ["English", "Maths", "Physics", "Chemistry", "Biology", "History"],
            datasets: [{
                label: "Student A",
                backgroundColor: "rgba(58,65,111,0.2)",
                data: [65, 75, 70, 80, 60, 80],
                borderDash: [5, 5],
            }, {
                label: "Student B",
                backgroundColor: "rgba(203,12,159,0.2)",
                data: [54, 65, 60, 70, 70, 75]
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false,
                }
            }
        }
    });

    // Radar chart
    var ctx10 = document.getElementById("polar-chart").getContext("2d");

    new Chart(ctx10, {
        type: "polarArea",
        data: {
            labels: [
                'Red',
                'Green',
                'Yellow',
                'Grey',
                'Blue'
            ],
            datasets: [{
                label: 'My First Dataset',
                data: [11, 16, 7, 3, 14],
                backgroundColor: ['#03A9F4', '#e91e63', '#3A416F', '#a8b8d8', '#4CAF50'],
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false,
                }
            }
        }
    });

</script>
@endpush
