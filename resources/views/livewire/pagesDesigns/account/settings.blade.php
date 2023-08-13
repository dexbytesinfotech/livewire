
        <div class="container-fluid mt-4">
            <div class="row align-items-center">
                <div class="col-lg-4 col-sm-8">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 active  active " data-bs-toggle="tab"
                                    href="{{ route('settings') }}" role="tab" aria-selected="true">
                                    Messages
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="{{ route('billing') }}"
                                    role="tab" aria-selected="false">
                                    Social
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="{{ route('invoice') }}"
                                    role="tab" aria-selected="false">
                                    Notifications
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="{{ route('security') }}"
                                    role="tab" aria-selected="false">
                                    Backup
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid my-3 py-3">
            <div class="row mb-5">
                <div class="col-lg-3">
                    <div class="card position-sticky top-1">
                        <ul class="nav flex-column bg-white border-radius-lg p-3">
                            <li class="nav-item">
                                <a class="nav-link text-dark d-flex" data-scroll="" href="#profile">
                                    <i class="material-icons text-lg me-2">person</i>
                                    <span class="text-sm">Profile</span>
                                </a>
                            </li>
                            <li class="nav-item pt-2">
                                <a class="nav-link text-dark d-flex" data-scroll="" href="#basic-info">
                                    <i class="material-icons text-lg me-2">receipt_long</i>
                                    <span class="text-sm">Basic Info</span>
                                </a>
                            </li>
                            <li class="nav-item pt-2">
                                <a class="nav-link text-dark d-flex" data-scroll="" href="#password">
                                    <i class="material-icons text-lg me-2">lock</i>
                                    <span class="text-sm">Change Password</span>
                                </a>
                            </li>
                            <li class="nav-item pt-2">
                                <a class="nav-link text-dark d-flex" data-scroll="" href="#2fa">
                                    <i class="material-icons text-lg me-2">security</i>
                                    <span class="text-sm">2FA</span>
                                </a>
                            </li>
                            <li class="nav-item pt-2">
                                <a class="nav-link text-dark d-flex" data-scroll="" href="#accounts">
                                    <i class="material-icons text-lg me-2">badge</i>
                                    <span class="text-sm">Accounts</span>
                                </a>
                            </li>
                            <li class="nav-item pt-2">
                                <a class="nav-link text-dark d-flex" data-scroll="" href="#notifications">
                                    <i class="material-icons text-lg me-2">campaign</i>
                                    <span class="text-sm">Notifications</span>
                                </a>
                            </li>
                            <li class="nav-item pt-2">
                                <a class="nav-link text-dark d-flex" data-scroll="" href="#sessions">
                                    <i class="material-icons text-lg me-2">settings_applications</i>
                                    <span class="text-sm">Sessions</span>
                                </a>
                            </li>
                            <li class="nav-item pt-2">
                                <a class="nav-link text-dark d-flex" data-scroll="" href="#delete">
                                    <i class="material-icons text-lg me-2">delete</i>
                                    <span class="text-sm">Delete Account</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9 mt-lg-0 mt-4">
                    <!-- Card Profile -->
                    <div class="card card-body" id="profile">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-sm-auto col-4">
                                <div class="avatar avatar-xl position-relative">
                                    <img src="{{ asset('assets') }}/img/bruce-mars.jpg" alt="bruce"
                                        class="w-100 rounded-circle shadow-sm">
                                </div>
                            </div>
                            <div class="col-sm-auto col-8 my-auto">
                                <div class="h-100">
                                    <h5 class="mb-1 font-weight-bolder">
                                        Richard Davis
                                    </h5>
                                    <p class="mb-0 font-weight-normal text-sm">
                                        CEO / Co-Founder
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-auto ms-sm-auto mt-sm-0 mt-3 d-flex">
                                <label class="form-check-label mb-0">
                                    <small id="profileVisibility">
                                        Switch to invisible
                                    </small>
                                </label>
                                <div class="form-check form-switch ms-2 my-auto">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault23"
                                        checked onchange="visible()">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card Basic Info -->
                    <div class="card mt-4" id="basic-info">
                        <div class="card-header">
                            <h5>Basic Info</h5>
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-6">
                                    <div class="input-group input-group-static">
                                        <label>First Name</label>
                                        <input type="text" class="form-control" placeholder="Alec">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-group input-group-static">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" placeholder="Thompson">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4 col-6">
                                    <label class="form-label mt-4 ms-0">I'm</label>
                                    <select class="form-control" name="choices-gender" id="choices-gender">
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="col-sm-8">
                                    <div class="row">
                                        <div class="col-sm-5 col-5">
                                            <label class="form-label mt-4 ms-0">Birth Date</label>
                                            <select class="form-control" name="choices-month"
                                                id="choices-month"></select>
                                        </div>
                                        <div class="col-sm-4 col-3">
                                            <label class="form-label mt-4 ms-0">&nbsp;</label>
                                            <select class="form-control" name="choices-day" id="choices-day"></select>
                                        </div>
                                        <div class="col-sm-3 col-4">
                                            <label class="form-label mt-4">&nbsp;</label>
                                            <select class="form-control" name="choices-year" id="choices-year"></select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-6">
                                    <div class="input-group input-group-static">
                                        <label>Email</label>
                                        <input type="email" class="form-control" placeholder="example@email.com">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-group input-group-static">
                                        <label>Confirm Email</label>
                                        <input type="email" class="form-control" placeholder="example@email.com">
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-6">
                                    <div class="input-group input-group-static">
                                        <label>Your location</label>
                                        <input type="text" class="form-control" placeholder="Sydney, A">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="input-group input-group-static">
                                        <label>Phone Number</label>
                                        <input type="number" class="form-control" placeholder="+40 735 631 620">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 align-self-center">
                                    <label class="form-label mt-4 ms-0">Language</label>
                                    <select class="form-control" name="choices-language" id="choices-language">
                                        <option value="English">English</option>
                                        <option value="French">French</option>
                                        <option value="Spanish">Spanish</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label mt-4">Skills</label>
                                    <input class="form-control" id="choices-skills" type="text"
                                        value="vuejs, angular, react" placeholder="Enter something" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card Change Password -->
                    <div class="card mt-4" id="password">
                        <div class="card-header">
                            <h5>Change Password</h5>
                        </div>
                        <div class="card-body pt-0">
                            <div class="input-group input-group-outline">
                                <label class="form-label">Current password</label>
                                <input type="password" class="form-control">
                            </div>
                            <div class="input-group input-group-outline my-4">
                                <label class="form-label">New password</label>
                                <input type="password" class="form-control">
                            </div>
                            <div class="input-group input-group-outline">
                                <label class="form-label">Confirm New password</label>
                                <input type="password" class="form-control">
                            </div>
                            <h5 class="mt-5">Password requirements</h5>
                            <p class="text-muted mb-2">
                                Please follow this guide for a strong password:
                            </p>
                            <ul class="text-muted ps-4 mb-0 float-start">
                                <li>
                                    <span class="text-sm">One special characters</span>
                                </li>
                                <li>
                                    <span class="text-sm">Min 6 characters</span>
                                </li>
                                <li>
                                    <span class="text-sm">One number (2 are recommended)</span>
                                </li>
                                <li>
                                    <span class="text-sm">Change it often</span>
                                </li>
                            </ul>
                            <button class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0">Update password</button>
                        </div>
                    </div>
                    <!-- Card Change Password -->
                    <div class="card mt-4" id="2fa">
                        <div class="card-header d-flex">
                            <h5 class="mb-0">Two-factor authentication</h5>
                            <span class="badge badge-success ms-auto mb-auto">Enabled</span>
                        </div>
                        <div class="card-body">
                            <div class="d-flex">
                                <p class="my-auto">Security keys</p>
                                <p class="text-secondary text-sm ms-auto my-auto me-3">No Security Keys</p>
                                <button class="btn btn-sm btn-outline-dark mb-0" type="button">Add</button>
                            </div>
                            <hr class="horizontal dark">
                            <div class="d-flex">
                                <p class="my-auto">SMS number</p>
                                <p class="text-secondary text-sm ms-auto my-auto me-3">+4012374423</p>
                                <button class="btn btn-sm btn-outline-dark mb-0" type="button">Edit</button>
                            </div>
                            <hr class="horizontal dark">
                            <div class="d-flex">
                                <p class="my-auto">Authenticator app</p>
                                <p class="text-secondary text-sm ms-auto my-auto me-3">Not Configured</p>
                                <button class="btn btn-sm btn-outline-dark mb-0" type="button">Set up</button>
                            </div>
                        </div>
                    </div>
                    <!-- Card Accounts -->
                    <div class="card mt-4" id="accounts">
                        <div class="card-header">
                            <h5>Accounts</h5>
                            <p class="text-sm">Here you can setup and manage your integration settings.</p>
                        </div>
                        <div class="card-body pt-0">
                            <div class="d-flex">
                                <img class="width-48-px" src="{{ asset('assets') }}/img/small-logos/logo-slack.svg"
                                    alt="logo_slack">
                                <div class="my-auto ms-3">
                                    <div class="h-100">
                                        <h5 class="mb-0">Slack</h5>
                                        <a class="text-sm text-body" href="javascript:;">Show less <i
                                                class="fas fa-chevron-up text-xs ms-1" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                <p class="text-sm text-secondary ms-auto me-3 my-auto">Enabled</p>
                                <div class="form-check form-switch my-auto">
                                    <input class="form-check-input" checked type="checkbox"
                                        id="flexSwitchCheckDefault1">
                                </div>
                            </div>
                            <div class="ps-5 pt-3 ms-3">
                                <p class="mb-0 text-sm">You haven't added your Slack yet or you aren't authorized.
                                    Please add our Slack Bot to your account by clicking on <a
                                        href="javascript">here</a>. When you've added the bot, send your verification
                                    code that you have received.</p>
                                <div class="d-sm-flex bg-gray-100 border-radius-lg p-2 my-4">
                                    <p class="text-sm font-weight-bold my-auto ps-sm-2">Verification Code</p>
                                    <input class="form-control form-control-sm ms-sm-auto mt-sm-0 mt-2 w-sm-15 w-40"
                                        type="text" value="1172913" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Copy!">
                                </div>
                                <div class="d-sm-flex bg-gray-100 border-radius-lg p-2 my-4">
                                    <p class="text-sm font-weight-bold my-auto ps-sm-2">Connected account</p>
                                    <h6 class="text-sm ms-auto me-3 my-auto">hello@creative-tim.com</h6>
                                    <button class="btn btn-sm bg-gradient-dark my-sm-auto mt-2 mb-0" type="button"
                                        name="button">Delete</button>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <div class="d-flex">
                                <img class="width-48-px" src="{{ asset('assets') }}/img/small-logos/logo-spotify.svg"
                                    alt="logo_spotify">
                                <div class="my-auto ms-3">
                                    <div class="h-100">
                                        <h5 class="mb-0">Spotify</h5>
                                        <p class="mb-0 text-sm">Music</p>
                                    </div>
                                </div>
                                <p class="text-sm text-secondary ms-auto me-3 my-auto">Enabled</p>
                                <div class="form-check form-switch my-auto">
                                    <input class="form-check-input" checked type="checkbox"
                                        id="flexSwitchCheckDefault2">
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <div class="d-flex">
                                <img class="width-48-px" src="{{ asset('assets') }}/img/small-logos/logo-atlassian.svg"
                                    alt="logo_atlassian">
                                <div class="my-auto ms-3">
                                    <div class="h-100">
                                        <h5 class="mb-0">Atlassian</h5>
                                        <p class="mb-0 text-sm">Payment vendor</p>
                                    </div>
                                </div>
                                <p class="text-sm text-secondary ms-auto me-3 my-auto">Enabled</p>
                                <div class="form-check form-switch my-auto">
                                    <input class="form-check-input" checked type="checkbox"
                                        id="flexSwitchCheckDefault3">
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <div class="d-flex">
                                <img class="width-48-px" src="{{ asset('assets') }}/img/small-logos/logo-asana.svg"
                                    alt="logo_asana">
                                <div class="my-auto ms-3">
                                    <div class="h-100">
                                        <h5 class="mb-0">Asana</h5>
                                        <p class="mb-0 text-sm">Organize your team</p>
                                    </div>
                                </div>
                                <div class="form-check form-switch ms-auto my-auto">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault4">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Card Notifications -->
                    <div class="card mt-4" id="notifications">
                        <div class="card-header">
                            <h5>Notifications</h5>
                            <p class="text-sm">Choose how you receive notifications. These notification settings apply
                                to the things you’re watching.</p>
                        </div>
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <thead>
                                        <tr>
                                            <th class="ps-1" colspan="4">
                                                <p class="mb-0">Activity</p>
                                            </th>
                                            <th class="text-center">
                                                <p class="mb-0">Email</p>
                                            </th>
                                            <th class="text-center">
                                                <p class="mb-0">Push</p>
                                            </th>
                                            <th class="text-center">
                                                <p class="mb-0">SMS</p>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="ps-1" colspan="4">
                                                <div class="my-auto">
                                                    <span class="text-dark d-block text-sm">Mentions</span>
                                                    <span class="text-xs font-weight-normal">Notify when another user
                                                        mentions you in a comment</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div
                                                    class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                                    <input class="form-check-input" checked type="checkbox"
                                                        id="flexSwitchCheckDefault11">
                                                </div>
                                            </td>
                                            <td>
                                                <div
                                                    class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault12">
                                                </div>
                                            </td>
                                            <td>
                                                <div
                                                    class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault13">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="ps-1" colspan="4">
                                                <div class="my-auto">
                                                    <span class="text-dark d-block text-sm">Comments</span>
                                                    <span class="text-xs font-weight-normal">Notify when another user
                                                        comments your item.</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div
                                                    class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                                    <input class="form-check-input" checked type="checkbox"
                                                        id="flexSwitchCheckDefault14">
                                                </div>
                                            </td>
                                            <td>
                                                <div
                                                    class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                                    <input class="form-check-input" checked type="checkbox"
                                                        id="flexSwitchCheckDefault15">
                                                </div>
                                            </td>
                                            <td>
                                                <div
                                                    class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault16">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="ps-1" colspan="4">
                                                <div class="my-auto">
                                                    <span class="text-dark d-block text-sm">Follows</span>
                                                    <span class="text-xs font-weight-normal">Notify when another user
                                                        follows you.</span>
                                                </div>
                                            </td>
                                            <td>
                                                <div
                                                    class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault17">
                                                </div>
                                            </td>
                                            <td>
                                                <div
                                                    class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                                    <input class="form-check-input" checked type="checkbox"
                                                        id="flexSwitchCheckDefault18">
                                                </div>
                                            </td>
                                            <td>
                                                <div
                                                    class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                                    <input class="form-check-input" type="checkbox"
                                                        id="flexSwitchCheckDefault19">
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="ps-1" colspan="4">
                                                <div class="my-auto">
                                                    <p class="text-sm mb-0">Log in from a new device</p>
                                                </div>
                                            </td>
                                            <td>
                                                <div
                                                    class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                                    <input class="form-check-input" checked type="checkbox"
                                                        id="flexSwitchCheckDefault20">
                                                </div>
                                            </td>
                                            <td>
                                                <div
                                                    class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                                    <input class="form-check-input" checked type="checkbox"
                                                        id="flexSwitchCheckDefault21">
                                                </div>
                                            </td>
                                            <td>
                                                <div
                                                    class="form-check form-switch mb-0 d-flex align-items-center justify-content-center">
                                                    <input class="form-check-input" checked type="checkbox"
                                                        id="flexSwitchCheckDefault22">
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Card Sessions -->
                    <div class="card mt-4" id="sessions">
                        <div class="card-header pb-3">
                            <h5>Sessions</h5>
                            <p class="text-sm">This is a list of devices that have logged into your account. Remove
                                those that you do not recognize.</p>
                        </div>
                        <div class="card-body pt-0">
                            <div class="d-flex align-items-center">
                                <div class="text-center w-5">
                                    <i class="fas fa-desktop text-lg opacity-6"></i>
                                </div>
                                <div class="my-auto ms-3">
                                    <div class="h-100">
                                        <p class="text-sm mb-1">
                                            Bucharest 68.133.163.201
                                        </p>
                                        <p class="mb-0 text-xs">
                                            Your current session
                                        </p>
                                    </div>
                                </div>
                                <span class="badge badge-success badge-sm my-auto ms-auto me-3">Active</span>
                                <p class="text-secondary text-sm my-auto me-3">EU</p>
                                <a href="javascript:;" class="text-primary text-sm icon-move-right my-auto">See more
                                    <i class="fas fa-arrow-right text-xs ms-1" aria-hidden="true"></i>
                                </a>
                            </div>
                            <hr class="horizontal dark">
                            <div class="d-flex align-items-center">
                                <div class="text-center w-5">
                                    <i class="fas fa-desktop text-lg opacity-6"></i>
                                </div>
                                <p class="my-auto ms-3">Chrome on macOS</p>
                                <p class="text-secondary text-sm ms-auto my-auto me-3">US</p>
                                <a href="javascript:;" class="text-primary text-sm icon-move-right my-auto">See more
                                    <i class="fas fa-arrow-right text-xs ms-1" aria-hidden="true"></i>
                                </a>
                            </div>
                            <hr class="horizontal dark">
                            <div class="d-flex align-items-center">
                                <div class="text-center w-5">
                                    <i class="fas fa-mobile text-lg opacity-6"></i>
                                </div>
                                <p class="my-auto ms-3">Safari on iPhone</p>
                                <p class="text-secondary text-sm ms-auto my-auto me-3">US</p>
                                <a href="javascript:;" class="text-primary text-sm icon-move-right my-auto">See more
                                    <i class="fas fa-arrow-right text-xs ms-1" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- Card Delete Account -->
                    <div class="card mt-4" id="delete">
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-sm-0 mb-4">
                                <div class="w-50">
                                    <h5>Delete Account</h5>
                                    <p class="text-sm mb-0">Once you delete your account, there is no going back. Please
                                        be certain.</p>
                                </div>
                                <div class="w-50 text-end">
                                    <button class="btn btn-outline-secondary mb-3 mb-md-0 ms-auto" type="button"
                                        name="button">Deactivate</button>
                                    <button class="btn bg-gradient-danger mb-0 ms-2" type="button" name="button">Delete
                                        Account</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @push('js') 
    <script src="{{ asset('assets') }}/js/plugins/choices.min.js"></script>
    <!-- Kanban scripts -->
    <script>
        if (document.getElementById('choices-gender')) {
            var gender = document.getElementById('choices-gender');
            const example = new Choices(gender);
        }

        if (document.getElementById('choices-language')) {
            var language = document.getElementById('choices-language');
            const example = new Choices(language);
        }

        if (document.getElementById('choices-skills')) {
            var skills = document.getElementById('choices-skills');
            const example = new Choices(skills, {
                delimiter: ',',
                editItems: true,
                maxItemCount: 5,
                removeItemButton: true,
                addItems: true
            });
        }

        if (document.getElementById('choices-year')) {
            var year = document.getElementById('choices-year');
            setTimeout(function () {
                const example = new Choices(year);
            }, 1);

            for (y = 1900; y <= 2020; y++) {
                var optn = document.createElement("OPTION");
                optn.text = y;
                optn.value = y;

                if (y == 2020) {
                    optn.selected = true;
                }

                year.options.add(optn);
            }
        }

        if (document.getElementById('choices-day')) {
            var day = document.getElementById('choices-day');
            setTimeout(function () {
                const example = new Choices(day);
            }, 1);


            for (y = 1; y <= 31; y++) {
                var optn = document.createElement("OPTION");
                optn.text = y;
                optn.value = y;

                if (y == 1) {
                    optn.selected = true;
                }

                day.options.add(optn);
            }

        }

        if (document.getElementById('choices-month')) {
            var month = document.getElementById('choices-month');
            setTimeout(function () {
                const example = new Choices(month);
            }, 1);

            var d = new Date();
            var monthArray = new Array();
            monthArray[0] = "January";
            monthArray[1] = "February";
            monthArray[2] = "March";
            monthArray[3] = "April";
            monthArray[4] = "May";
            monthArray[5] = "June";
            monthArray[6] = "July";
            monthArray[7] = "August";
            monthArray[8] = "September";
            monthArray[9] = "October";
            monthArray[10] = "November";
            monthArray[11] = "December";
            for (m = 0; m <= 11; m++) {
                var optn = document.createElement("OPTION");
                optn.text = monthArray[m];
                // server side month start from one
                optn.value = (m + 1);
                // if june selected
                if (m == 1) {
                    optn.selected = true;
                }
                month.options.add(optn);
            }
        }

        function visible() {
            var elem = document.getElementById('profileVisibility');
            if (elem) {
                if (elem.innerHTML == "Switch to visible") {
                    elem.innerHTML = "Switch to invisible"
                } else {
                    elem.innerHTML = "Switch to visible"
                }
            }
        }

        var openFile = function (event) {
            var input = event.target;

            // Instantiate FileReader
            var reader = new FileReader();
            reader.onload = function () {
                imageFile = reader.result;

                document.getElementById("imageChange").innerHTML = '<img width="200" src="' + imageFile +
                    '" class="rounded-circle w-100 shadow" />';
            };
            reader.readAsDataURL(input.files[0]);
        };

    </script>
    @endpush
