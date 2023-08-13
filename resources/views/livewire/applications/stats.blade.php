<div class="container-fluid py-4 bg-gray-200">
    <div class="row">
        <div class="col-lg-6 col-12 d-flex ms-auto">
            <a href="javascript:;" class="btn btn-icon btn-outline-secondary ms-auto">
                Export
            </a>
            <div class="dropleft ms-3">
                <button class="btn bg-gradient-dark dropdown-toggle" type="button" id="dropdownImport"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    Today
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownImport">
                    <li><a class="dropdown-item" href="javascript:;">Yesterday</a></li>
                    <li><a class="dropdown-item" href="javascript:;">Last 7 days</a></li>
                    <li><a class="dropdown-item" href="javascript:;">Last 30 days</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card mb-4">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-md mt-n4 position-absolute">
                        <i class="material-icons opacity-10">person</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Users</p>
                        <h5 class="mb-0">
                            930
                        </h5>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than lask week</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card mb-4">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-md mt-n4 position-absolute">
                        <i class="material-icons opacity-10">public</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">New Users</p>
                        <h5 class="mb-0">
                            744
                        </h5>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+5% </span>than yesterday</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
            <div class="card mb-4">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-md mt-n4 position-absolute">
                        <i class="material-icons opacity-10">devices</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Sessions</p>
                        <h5 class="mb-0">
                            1,414
                        </h5>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-danger text-sm font-weight-bolder">-2% </span>just updated</p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-sm-6">
            <div class="card mb-4">
                <div class="card-header p-3 pt-2">
                    <div
                        class="icon icon-lg icon-shape bg-gradient-dark shadow text-center border-radius-md mt-n4 position-absolute">
                        <i class="material-icons opacity-10">filter_none</i>
                    </div>
                    <div class="text-end pt-1">
                        <p class="text-sm mb-0 text-capitalize">Pages/Session</p>
                        <h5 class="mb-0">
                            1.76
                        </h5>
                    </div>
                </div>
                <hr class="dark horizontal my-0">
                <div class="card-footer p-3">
                    <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+5% </span>than lask month</p>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-7 col-md-12">
            <div class="card">
                <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Traffic channels</h6>
                    <div class="d-flex align-items-center">
                        <span class="badge badge-md badge-dot me-4">
                            <i class="bg-primary"></i>
                            <span class="text-dark text-xs">Organic search</span>
                        </span>
                        <span class="badge badge-md badge-dot me-4">
                            <i class="bg-dark"></i>
                            <span class="text-dark text-xs">Referral</span>
                        </span>
                        <span class="badge badge-md badge-dot me-4">
                            <i class="bg-info"></i>
                            <span class="text-dark text-xs">Social media</span>
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
        <div class="col-lg-5 col-md-12 mt-4 mt-lg-0">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex align-items-center">
                        <h6 class="mb-0">Referrals</h6>
                        <button type="button"
                            class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center ms-auto"
                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                            title="See which websites are sending traffic to your website">
                            <i class="material-icons text-sm">priority_high</i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-lg-5 col-12 text-center">
                            <div class="chart mt-5">
                                <canvas id="chart-doughnut" class="chart-canvas" height="200"></canvas>
                            </div>
                            <a class="btn btn-sm bg-gradient-secondary mt-4">See all referrals</a>
                        </div>
                        <div class="col-lg-7 col-12">
                            <div class="table-responsive">
                                <table class="table align-items-center mb-0">
                                    <tbody>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="{{ asset('assets') }}/img/small-logos/logo-xd.svg"
                                                            class="avatar avatar-sm me-2" alt="logo_xd">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">Adobe</h6>
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
                                                        <img src="{{ asset('assets') }}/img/small-logos/logo-atlassian.svg"
                                                            class="avatar avatar-sm me-2" alt="logo_atlassian">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">Atlassian</h6>
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
                                                        <img src="{{ asset('assets') }}/img/small-logos/logo-slack.svg"
                                                            class="avatar avatar-sm me-2" alt="logo_slack">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">Slack</h6>
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
                                                        <img src="{{ asset('assets') }}/img/small-logos/logo-spotify.svg"
                                                            class="avatar avatar-sm me-2" alt="logo_spotify">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">Spotify</h6>
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
                                                        <img src="{{ asset('assets') }}/img/small-logos/logo-jira.svg"
                                                            class="avatar avatar-sm me-2" alt="logo_jira">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">Jira</h6>
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
            </div>
        </div>
    </div>
    <div class="row mt-4 mb-5 mb-md-0">
        <div class="col-sm-6">
            <div class="card h-100">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex align-items-center">
                        <h6 class="mb-0">Social</h6>
                        <button type="button"
                            class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center ms-auto"
                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                            title="See how much traffic do you get from social media">
                            <i class="material-icons text-sm">priority_high</i>
                        </button>
                    </div>
                </div>
                <div class="card-body p-3">
                    <ul class="list-group">
                        <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                            <div class="w-100">
                                <div class="d-flex align-items-center mb-2">
                                    <a class="btn btn-facebook btn-simple mb-0 p-0" href="javascript:;">
                                        <i class="fab fa-facebook fa-lg"></i>
                                    </a>
                                    <span class="me-2 text-sm font-weight-normal text-capitalize ms-2">Facebook</span>
                                    <span class="ms-auto text-sm font-weight-normal">80%</span>
                                </div>
                                <div>
                                    <div class="progress progress-md">
                                        <div class="progress-bar bg-gradient-dark w-80" role="progressbar"
                                            aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                            <div class="w-100">
                                <div class="d-flex align-items-center mb-2">
                                    <a class="btn btn-twitter btn-simple mb-0 p-0" href="javascript:;">
                                        <i class="fab fa-twitter fa-lg"></i>
                                    </a>
                                    <span class="me-2 text-sm font-weight-normal text-capitalize ms-2">Twitter</span>
                                    <span class="ms-auto text-sm font-weight-normal">40%</span>
                                </div>
                                <div>
                                    <div class="progress progress-md">
                                        <div class="progress-bar bg-gradient-dark w-40" role="progressbar"
                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                            <div class="w-100">
                                <div class="d-flex align-items-center mb-2">
                                    <a class="btn btn-reddit btn-simple mb-0 p-0" href="javascript:;">
                                        <i class="fab fa-reddit fa-lg"></i>
                                    </a>
                                    <span class="me-2 text-sm font-weight-normal text-capitalize ms-2">Reddit</span>
                                    <span class="ms-auto text-sm font-weight-normal">30%</span>
                                </div>
                                <div>
                                    <div class="progress progress-md">
                                        <div class="progress-bar bg-gradient-dark w-30" role="progressbar"
                                            aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                            <div class="w-100">
                                <div class="d-flex align-items-center mb-2">
                                    <a class="btn btn-youtube btn-simple mb-0 p-0" href="javascript:;">
                                        <i class="fab fa-youtube fa-lg"></i>
                                    </a>
                                    <span class="me-2 text-sm font-weight-normal text-capitalize ms-2">Youtube</span>
                                    <span class="ms-auto text-sm font-weight-normal">25%</span>
                                </div>
                                <div>
                                    <div class="progress progress-md">
                                        <div class="progress-bar bg-gradient-dark w-25" role="progressbar"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                            <div class="w-100">
                                <div class="d-flex align-items-center mb-2">
                                    <a class="btn btn-slack btn-simple mb-0 p-0" href="javascript:;">
                                        <i class="fab fa-slack fa-lg"></i>
                                    </a>
                                    <span class="me-2 text-sm font-weight-normal text-capitalize ms-2">Slack</span>
                                    <span class="ms-auto text-sm font-weight-normal">15%</span>
                                </div>
                                <div>
                                    <div class="progress progress-md">
                                        <div class="progress-bar bg-gradient-dark w-15" role="progressbar"
                                            aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card h-100 mt-4 mt-md-0">
                <div class="card-header pb-0 p-3">
                    <div class="d-flex align-items-center">
                        <h6>Pages</h6>
                        <button type="button"
                            class="btn btn-icon-only btn-rounded btn-outline-success mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center ms-auto"
                            data-bs-toggle="tooltip" data-bs-placement="bottom"
                            title="Data is based from sessions and is 100% accurate">
                            <i class="material-icons text-sm">done</i>
                        </button>
                    </div>
                </div>
                <div class="card-body px-3 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center justify-content-center mb-0">
                            <thead>
                                <tr>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Page</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Page Views</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Avg. Time</th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Bounce Rate</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <p class="text-sm font-weight-normal mb-0">1. /bits</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-normal mb-0">345</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-normal mb-0">00:17:07</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-normal mb-0">40.91%</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="text-sm font-weight-normal mb-0">2. /pages/argon-dashboard</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-normal mb-0">520</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-normal mb-0">00:23:13</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-normal mb-0">30.14%</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="text-sm font-weight-normal mb-0">3. /pages/soft-ui-dashboard</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-normal mb-0">122</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-normal mb-0">00:3:10</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-normal mb-0">54.10%</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="text-sm font-weight-normal mb-0">4. /bootstrap-themes</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-normal mb-0">1,900</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-normal mb-0">00:30:42</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-normal mb-0">20.93%</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="text-sm font-weight-normal mb-0">5. /react-themes</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-normal mb-0">1,442</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-normal mb-0">00:31:50</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-normal mb-0">34.98%</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="text-sm font-weight-normal mb-0">6. /product/argon-dashboard-angular
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-normal mb-0">201</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-normal mb-0">00:12:42</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-normal mb-0">21.4%</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <p class="text-sm font-weight-normal mb-0">7. /product/material-dashboard-pro
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-normal mb-0">2,115</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-normal mb-0">00:50:11</p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-normal mb-0">34.98%</p>
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
<!--   Core JS Files   -->
@push('js') 
<script src="{{ asset('assets') }}/js/plugins/chartjs.min.js"></script>
<script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");
    var ctx2 = document.getElementById("chart-doughnut").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

    var gradientStroke2 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

    // Line chart
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
                    backgroundColor: gradientStroke1,
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
                    backgroundColor: gradientStroke2,
                    data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
                    maxBarThickness: 6
                },
                {
                    label: "Direct",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 2,
                    pointBackgroundColor: "#17c1e8",
                    borderColor: "#17c1e8",
                    borderWidth: 3,
                    backgroundColor: gradientStroke2,
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
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        padding: 10,
                        color: '#9ca2b7'
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: true,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        color: '#9ca2b7',
                        padding: 10
                    }
                },
            },
        },
    });


    // Doughnut chart
    new Chart(ctx2, {
        type: "doughnut",
        data: {
            labels: ['Atlassian', 'Jira', 'Slack', 'Spotify', 'Adobe'],
            datasets: [{
                label: "Projects",
                weight: 9,
                cutout: 60,
                tension: 0.9,
                pointRadius: 2,
                borderWidth: 2,
                backgroundColor: ['#2152ff', '#3A416F', '#f53939', '#a8b8d8', '#e91e63'],
                data: [25, 13, 12, 37, 13],
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

</script>
<script src="{{ asset('assets') }}/js/plugins/chartjs.min.js"></script>
<script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");
    var ctx2 = document.getElementById("chart-doughnut").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

    var gradientStroke2 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

    // Line chart
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
                    backgroundColor: gradientStroke1,
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
                    backgroundColor: gradientStroke2,
                    data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
                    maxBarThickness: 6
                },
                {
                    label: "Direct",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 2,
                    pointBackgroundColor: "#17c1e8",
                    borderColor: "#17c1e8",
                    borderWidth: 3,
                    backgroundColor: gradientStroke2,
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
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        padding: 10,
                        color: '#9ca2b7'
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: true,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        color: '#9ca2b7',
                        padding: 10
                    }
                },
            },
        },
    });


    // Doughnut chart
    new Chart(ctx2, {
        type: "doughnut",
        data: {
            labels: ['Atlassian', 'Jira', 'Slack', 'Spotify', 'Adobe'],
            datasets: [{
                label: "Projects",
                weight: 9,
                cutout: 60,
                tension: 0.9,
                pointRadius: 2,
                borderWidth: 2,
                backgroundColor: ['#2152ff', '#3A416F', '#f53939', '#a8b8d8', '#e91e63'],
                data: [25, 13, 12, 37, 13],
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

</script>
@endpush
