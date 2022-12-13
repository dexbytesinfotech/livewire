<aside
    class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-end me-3 rotate-caret  bg-gradient-dark"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute start-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0 p-4 d-flex align-items-center text-wrap" href="{{ route('analytics') }}">
                <img src="{{ asset('assets') }}/img/logo-ct.png" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-2 font-weight-bold text-white">Material Dashboard 2 PRO Laravel Livewire</span>
            </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse px-0 w-auto h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item mb-2 mt-0">
                <a data-bs-toggle="collapse" href="#ProfileNav" class="nav-link text-white" aria-controls="ProfileNav"
                    role="button" aria-expanded="false">
                    @if (auth()->user()->picture)
                    <img src="/storage/{{(auth()->user()->picture)}}" alt="avatar" class="avatar">
                    @else
                    <img src="{{ asset('assets') }}/img/default-avatar.png" alt="avatar" class="avatar">
                    @endif
                    <span class="nav-link-text ms-2 ps-1">{{ auth()->user()->name }}</span>
                </a>
                <div class="collapse" id="ProfileNav" style="">
                    <ul class="nav ">
                        <li class="nav-item">
                            <a class="nav-link text-white" href="{{ route('overview') }}">
                                <span class="sidenav-mini-icon"> MP </span>
                                <span class="sidenav-normal  ms-3  ps-1"> My Profile </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white " href="{{ route('settings') }}">
                                <span class="sidenav-mini-icon"> S </span>
                                <span class="sidenav-normal  ms-3  ps-1"> Settings </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <livewire:auth.logout/>
                        </li>
                    </ul>
                </div>
            </li>
            <hr class="horizontal light mt-0">
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#dashboardsExamples" class="nav-link text-white "
                    aria-controls="dashboardsExamples" role="button" aria-expanded="false">
                    <i class="material-icons-round opacity-10">dashboard</i>
                    <span class="nav-link-text me-1">Dashboards</span>
                </a>
                <div class="collapse " id="dashboardsExamples">
                    <ul class="nav  pe-0 ">
                        <li class="nav-item ">
                            <a class="nav-link text-white " href="{{ route('analytics') }}">
                                <span class="sidenav-mini-icon"> A </span>
                                <span class="sidenav-normal  me-3  ps-1"> Analytics </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white " href="{{ route('discover') }}">
                                <span class="sidenav-mini-icon"> D </span>
                                <span class="sidenav-normal  me-3  ps-1"> Discover </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white " href="{{ route('sales') }}">
                                <span class="sidenav-mini-icon"> S </span>
                                <span class="sidenav-normal  me-3  ps-1"> Sales </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white " href="{{ route('automotive') }}">
                                <span class="sidenav-mini-icon"> A </span>
                                <span class="sidenav-normal  me-3  ps-1"> Automotive </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white " href="{{ route('smart-home') }}">
                                <span class="sidenav-mini-icon"> S </span>
                                <span class="sidenav-normal  me-3  ps-1"> Smart Home </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 me-4 text-uppercase text-xs font-weight-bolder text-white">PAGES</h6>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#pagesExamples" class="nav-link text-white active"
                    aria-controls="pagesExamples" role="button" aria-expanded="false">
                    <i class="material-icons-round {% if page.brand == 'RTL' %}ms-2{% else %} me-2{% endif %}">image</i>
                    <span class="nav-link-text me-1">Pages</span>
                </a>
                <div class="collapse  show " id="pagesExamples">
                    <ul class="nav  pe-0 ">
                        <li class="nav-item ">
                            <a class="nav-link text-white " data-bs-toggle="collapse" aria-expanded="false"
                                href="#profileExample">
                                <span class="sidenav-mini-icon"> P </span>
                                <span class="sidenav-normal  me-3  ps-1"> Profile <b class="caret"></b></span>
                            </a>
                            <div class="collapse " id="profileExample">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link text-white " href="{{ route('overview') }}">
                                            <span class="sidenav-mini-icon"> P </span>
                                            <span class="sidenav-normal  me-3  ps-1"> Profile Overview </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white " href="{{ route('projects') }}">
                                            <span class="sidenav-mini-icon"> A </span>
                                            <span class="sidenav-normal  me-3  ps-1"> All Projects </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white " data-bs-toggle="collapse" aria-expanded="false"
                                href="#usersExample">
                                <span class="sidenav-mini-icon"> U </span>
                                <span class="sidenav-normal  me-3  ps-1"> Users <b class="caret"></b></span>
                            </a>
                            <div class="collapse " id="usersExample">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link text-white " href="{{ route('reports') }}">
                                            <span class="sidenav-mini-icon"> R </span>
                                            <span class="sidenav-normal  me-3  ps-1"> Reports </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white " href="{{ route('new-user') }}">
                                            <span class="sidenav-mini-icon"> N </span>
                                            <span class="sidenav-normal  me-3  ps-1"> New User </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white " data-bs-toggle="collapse" aria-expanded="false"
                                href="#accountExample">
                                <span class="sidenav-mini-icon"> A </span>
                                <span class="sidenav-normal  me-3  ps-1"> Account <b class="caret"></b></span>
                            </a>
                            <div class="collapse " id="accountExample">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link text-white " href="{{ route('settings') }}">
                                            <span class="sidenav-mini-icon"> S </span>
                                            <span class="sidenav-normal  me-3  ps-1"> Settings </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white " href="{{ route('billing') }}">
                                            <span class="sidenav-mini-icon"> B </span>
                                            <span class="sidenav-normal  me-3  ps-1"> Billing </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white " href="{{ route('invoice') }}">
                                            <span class="sidenav-mini-icon"> I </span>
                                            <span class="sidenav-normal  me-3  ps-1"> Invoice </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white " href="{{ route('security') }}">
                                            <span class="sidenav-mini-icon"> S </span>
                                            <span class="sidenav-normal  me-3  ps-1"> Security </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white " data-bs-toggle="collapse" aria-expanded="false"
                                href="#projectsExample">
                                <span class="sidenav-mini-icon"> P </span>
                                <span class="sidenav-normal  me-3  ps-1"> Projects <b class="caret"></b></span>
                            </a>
                            <div class="collapse " id="projectsExample">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link text-white " href="{{ route('general') }}">
                                            <span class="sidenav-mini-icon"> G </span>
                                            <span class="sidenav-normal  me-3  ps-1"> General </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white " href="{{ route('timeline') }}">
                                            <span class="sidenav-mini-icon"> T </span>
                                            <span class="sidenav-normal  me-3  ps-1"> Timeline </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white " href="{{ route('new-project') }}">
                                            <span class="sidenav-mini-icon"> N </span>
                                            <span class="sidenav-normal  me-3  ps-1"> New Project </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white " data-bs-toggle="collapse" aria-expanded="false"
                                href="#vrExamples">
                                <span class="sidenav-mini-icon"> V </span>
                                <span class="sidenav-normal  me-3  ps-1"> Virtual Reality <b class="caret"></b></span>
                            </a>
                            <div class="collapse " id="vrExamples">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link text-white " href="{{ route('vr-default') }}">
                                            <span class="sidenav-mini-icon"> V </span>
                                            <span class="sidenav-normal  me-3  ps-1"> VR Default </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white " href="{{ route('vr-info') }}">
                                            <span class="sidenav-mini-icon"> V </span>
                                            <span class="sidenav-normal  me-3  ps-1"> VR Info </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white " href="{{ route('pricing-page') }}">
                                <span class="sidenav-mini-icon"> P </span>
                                <span class="sidenav-normal  me-3  ps-1"> Pricing Page </span>
                            </a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link text-white active" href="{{ route('rtl') }}">
                                <span class="sidenav-mini-icon"> R </span>
                                <span class="sidenav-normal  me-3  ps-1"> RTL </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white " href="{{ route('widgets') }}">
                                <span class="sidenav-mini-icon"> W </span>
                                <span class="sidenav-normal  me-3  ps-1"> Widgets </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white " href="{{ route('charts') }}l">
                                <span class="sidenav-mini-icon"> C </span>
                                <span class="sidenav-normal  me-3  ps-1"> Charts </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white " href="{{ route('sweet-alerts') }}">
                                <span class="sidenav-mini-icon"> S </span>
                                <span class="sidenav-normal  me-3  ps-1"> Sweet Alerts </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white " href="{{ route('notifications') }}">
                                <span class="sidenav-mini-icon"> N </span>
                                <span class="sidenav-normal  me-3  ps-1"> Notifications </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#applicationsExamples" class="nav-link text-white "
                    aria-controls="applicationsExamples" role="button" aria-expanded="false">
                    <i class="material-icons-round {% if page.brand == 'RTL' %}ms-2{% else %} me-2{% endif %}">apps</i>
                    <span class="nav-link-text me-1">Applications</span>
                </a>
                <div class="collapse " id="applicationsExamples">
                    <ul class="nav  pe-0 ">
                        <li class="nav-item ">
                            <a class="nav-link text-white " href="{{ route('crm') }}">
                                <span class="sidenav-mini-icon"> C </span>
                                <span class="sidenav-normal  me-3  ps-1"> CRM </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white " href="{{ route('kanban') }}">
                                <span class="sidenav-mini-icon"> K </span>
                                <span class="sidenav-normal  me-3  ps-1"> Kanban </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white " href="{{ route('wizard') }}">
                                <span class="sidenav-mini-icon"> W </span>
                                <span class="sidenav-normal  me-3  ps-1"> Wizard </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white " href="{{ route('datatables') }}">
                                <span class="sidenav-mini-icon"> D </span>
                                <span class="sidenav-normal  me-3  ps-1"> DataTables </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white " href="{{ route('calendar') }}">
                                <span class="sidenav-mini-icon"> C </span>
                                <span class="sidenav-normal  me-3  ps-1"> Calendar </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white " href="{{ route('stats') }}">
                                <span class="sidenav-mini-icon"> S </span>
                                <span class="sidenav-normal  me-3  ps-1"> Stats </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#ecommerceExamples" class="nav-link text-white "
                    aria-controls="ecommerceExamples" role="button" aria-expanded="false">
                    <i
                        class="material-icons-round {% if page.brand == 'RTL' %}ms-2{% else %} me-2{% endif %}">shopping_basket</i>
                    <span class="nav-link-text me-1">Ecommerce</span>
                </a>
                <div class="collapse " id="ecommerceExamples">
                    <ul class="nav  pe-0 ">
                        <li class="nav-item ">
                            <a class="nav-link text-white " data-bs-toggle="collapse" aria-expanded="false"
                                href="#productsExample">
                                <span class="sidenav-mini-icon"> P </span>
                                <span class="sidenav-normal  me-3  ps-1"> Products <b class="caret"></b></span>
                            </a>
                            <div class="collapse " id="productsExample">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link text-white " href="{{ route('new-product') }}">
                                            <span class="sidenav-mini-icon"> N </span>
                                            <span class="sidenav-normal  me-3  ps-1"> New Product </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white " href="{{ route('edit-product') }}">
                                            <span class="sidenav-mini-icon"> E </span>
                                            <span class="sidenav-normal  me-3  ps-1"> Edit Product </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white " href="{{ route('product-page') }}">
                                            <span class="sidenav-mini-icon"> P </span>
                                            <span class="sidenav-normal  me-3  ps-1"> Product Page </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white " href="{{ route('products-list') }}">
                                            <span class="sidenav-mini-icon"> P </span>
                                            <span class="sidenav-normal  me-3  ps-1"> Products List </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white " data-bs-toggle="collapse" aria-expanded="false"
                                href="#ordersExample">
                                <span class="sidenav-mini-icon"> O </span>
                                <span class="sidenav-normal  me-3  ps-1"> Orders <b class="caret"></b></span>
                            </a>
                            <div class="collapse " id="ordersExample">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link text-white " href="{{ route('order-list') }}">
                                            <span class="sidenav-mini-icon"> O </span>
                                            <span class="sidenav-normal  me-3  ps-1"> Order List </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white " href="{{ route('order-details') }}">
                                            <span class="sidenav-mini-icon"> O </span>
                                            <span class="sidenav-normal  me-3  ps-1"> Order Details </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white " href="{{ route('referral') }}">
                                <span class="sidenav-mini-icon"> R </span>
                                <span class="sidenav-normal  me-3  ps-1"> Referral </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#authExamples" class="nav-link text-white "
                    aria-controls="authExamples" role="button" aria-expanded="false">
                    <i
                        class="material-icons-round {% if page.brand == 'RTL' %}ms-2{% else %} me-2{% endif %}">content_paste</i>
                    <span class="nav-link-text me-1">Authentication</span>
                </a>
                <div class="collapse " id="authExamples">
                    <ul class="nav  pe-0 ">
                        <li class="nav-item ">
                            <a class="nav-link text-white " data-bs-toggle="collapse" aria-expanded="false"
                                href="#signinExample">
                                <span class="sidenav-mini-icon"> S </span>
                                <span class="sidenav-normal  me-3  ps-1"> Sign In <b class="caret"></b></span>
                            </a>
                            <div class="collapse " id="signinExample">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link text-white " href="{{ route('basic-sign-in') }}">
                                            <span class="sidenav-mini-icon"> B </span>
                                            <span class="sidenav-normal  me-3  ps-1"> Basic </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white " href="{{ route('cover-sign-in') }}">
                                            <span class="sidenav-mini-icon"> C </span>
                                            <span class="sidenav-normal  me-3  ps-1"> Cover </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white " href="{{ route('illustration-sign-in') }}">
                                            <span class="sidenav-mini-icon"> I </span>
                                            <span class="sidenav-normal  me-3  ps-1"> Illustration </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white " data-bs-toggle="collapse" aria-expanded="false"
                                href="#signupExample">
                                <span class="sidenav-mini-icon"> S </span>
                                <span class="sidenav-normal  me-3  ps-1"> Sign Up <b class="caret"></b></span>
                            </a>
                            <div class="collapse " id="signupExample">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link text-white " href="{{ route('basic-sign-up') }}">
                                            <span class="sidenav-mini-icon"> B </span>
                                            <span class="sidenav-normal  me-3  ps-1"> Basic </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white " href="{{ route('cover-sign-up') }}">
                                            <span class="sidenav-mini-icon"> C </span>
                                            <span class="sidenav-normal  me-3  ps-1"> Cover </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white " href="{{ route('illustration-sign-up') }}">
                                            <span class="sidenav-mini-icon"> I </span>
                                            <span class="sidenav-normal  me-3  ps-1"> Illustration </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white " data-bs-toggle="collapse" aria-expanded="false"
                                href="#resetExample">
                                <span class="sidenav-mini-icon"> R </span>
                                <span class="sidenav-normal  me-3  ps-1"> Reset Password <b class="caret"></b></span>
                            </a>
                            <div class="collapse " id="resetExample">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link text-white " href="{{ route('basic-reset') }}">
                                            <span class="sidenav-mini-icon"> B </span>
                                            <span class="sidenav-normal  me-3  ps-1"> Basic </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white " href="{{ route('cover-reset') }}">
                                            <span class="sidenav-mini-icon"> C </span>
                                            <span class="sidenav-normal  me-3  ps-1"> Cover </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white " href="{{ route('illustration-reset') }}">
                                            <span class="sidenav-mini-icon"> I </span>
                                            <span class="sidenav-normal  me-3  ps-1"> Illustration </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white " data-bs-toggle="collapse" aria-expanded="false"
                                href="#lockExample">
                                <span class="sidenav-mini-icon"> L </span>
                                <span class="sidenav-normal  me-3  ps-1"> Lock <b class="caret"></b></span>
                            </a>
                            <div class="collapse " id="lockExample">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link text-white " href="{{ route('basic-lock') }}">
                                            <span class="sidenav-mini-icon"> B </span>
                                            <span class="sidenav-normal  me-3  ps-1"> Basic </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white " href="{{ route('cover-lock') }}">
                                            <span class="sidenav-mini-icon"> C </span>
                                            <span class="sidenav-normal  me-3  ps-1"> Cover </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white " href="{{ route('illustration-lock') }}">
                                            <span class="sidenav-mini-icon"> I </span>
                                            <span class="sidenav-normal  me-3  ps-1"> Illustration </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white " data-bs-toggle="collapse" aria-expanded="false"
                                href="#StepExample">
                                <span class="sidenav-mini-icon"> 2 </span>
                                <span class="sidenav-normal  me-3  ps-1"> 2-Step Verification <b
                                        class="caret"></b></span>
                            </a>
                            <div class="collapse " id="StepExample">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link text-white " href="{{ route('basic-verification') }}">
                                            <span class="sidenav-mini-icon"> B </span>
                                            <span class="sidenav-normal  me-3  ps-1"> Basic </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white " href="{{ route('cover-verification') }}">
                                            <span class="sidenav-mini-icon"> C </span>
                                            <span class="sidenav-normal  me-3  ps-1"> Cover </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white " href="{{ route('illustration-verification') }}">
                                            <span class="sidenav-mini-icon"> I </span>
                                            <span class="sidenav-normal  me-3  ps-1"> Illustration </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white " data-bs-toggle="collapse" aria-expanded="false"
                                href="#errorExample">
                                <span class="sidenav-mini-icon"> E </span>
                                <span class="sidenav-normal  me-3  ps-1"> Error <b class="caret"></b></span>
                            </a>
                            <div class="collapse " id="errorExample">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link text-white " href="{{ route('error404') }}">
                                            <span class="sidenav-mini-icon"> E </span>
                                            <span class="sidenav-normal  me-3  ps-1"> Error 404 </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white " href="{{ route('error500') }}">
                                            <span class="sidenav-mini-icon"> E </span>
                                            <span class="sidenav-normal  me-3  ps-1"> Error 500 </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <hr class="horizontal light" />
                <h6 class="ps-4 me-4 text-uppercase text-xs font-weight-bolder text-white">DOCS</h6>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#basicExamples" class="nav-link text-white "
                    aria-controls="basicExamples" role="button" aria-expanded="false">
                    <i
                        class="material-icons-round {% if page.brand == 'RTL' %}ms-2{% else %} me-2{% endif %}">upcoming</i>
                    <span class="nav-link-text me-1">Basic</span>
                </a>
                <div class="collapse " id="basicExamples">
                    <ul class="nav  pe-0 ">
                        <li class="nav-item ">
                            <a class="nav-link text-white " data-bs-toggle="collapse" aria-expanded="false"
                                href="#gettingStartedExample">
                                <span class="sidenav-mini-icon"> G </span>
                                <span class="sidenav-normal  me-3  ps-1"> Getting Started <b class="caret"></b></span>
                            </a>
                            <div class="collapse " id="gettingStartedExample">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link text-white "
                                            href="https://www.creative-tim.com/learning-lab/bootstrap/quick-start/material-dashboard"
                                            target="_blank">
                                            <span class="sidenav-mini-icon"> Q </span>
                                            <span class="sidenav-normal  me-3  ps-1"> Quick Start </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white "
                                            href="https://www.creative-tim.com/learning-lab/bootstrap/license/material-dashboard"
                                            target="_blank">
                                            <span class="sidenav-mini-icon"> L </span>
                                            <span class="sidenav-normal  me-3  ps-1"> License </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white "
                                            href="https://www.creative-tim.com/learning-lab/bootstrap/overview/material-dashboard"
                                            target="_blank">
                                            <span class="sidenav-mini-icon"> C </span>
                                            <span class="sidenav-normal  me-3  ps-1"> Contents </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white "
                                            href="https://www.creative-tim.com/learning-lab/bootstrap/build-tools/material-dashboard"
                                            target="_blank">
                                            <span class="sidenav-mini-icon"> B </span>
                                            <span class="sidenav-normal  me-3  ps-1"> Build Tools </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white " data-bs-toggle="collapse" aria-expanded="false"
                                href="#foundationExample">
                                <span class="sidenav-mini-icon"> F </span>
                                <span class="sidenav-normal  me-3  ps-1"> Foundation <b class="caret"></b></span>
                            </a>
                            <div class="collapse " id="foundationExample">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link text-white "
                                            href="https://www.creative-tim.com/learning-lab/bootstrap/colors/material-dashboard"
                                            target="_blank">
                                            <span class="sidenav-mini-icon"> C </span>
                                            <span class="sidenav-normal  me-3  ps-1"> Colors </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white "
                                            href="https://www.creative-tim.com/learning-lab/bootstrap/grid/material-dashboard"
                                            target="_blank">
                                            <span class="sidenav-mini-icon"> G </span>
                                            <span class="sidenav-normal  me-3  ps-1"> Grid </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white "
                                            href="https://www.creative-tim.com/learning-lab/bootstrap/typography/material-dashboard"
                                            target="_blank">
                                            <span class="sidenav-mini-icon"> T </span>
                                            <span class="sidenav-normal  me-3  ps-1"> Typography </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link text-white "
                                            href="https://www.creative-tim.com/learning-lab/bootstrap/icons/material-dashboard"
                                            target="_blank">
                                            <span class="sidenav-mini-icon"> I </span>
                                            <span class="sidenav-normal  me-3  ps-1"> Icons </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a data-bs-toggle="collapse" href="#componentsExamples" class="nav-link text-white "
                    aria-controls="componentsExamples" role="button" aria-expanded="false">
                    <i
                        class="material-icons-round {% if page.brand == 'RTL' %}ms-2{% else %} me-2{% endif %}">view_in_ar</i>
                    <span class="nav-link-text me-1">Components</span>
                </a>
                <div class="collapse " id="componentsExamples">
                    <ul class="nav  pe-0 ">
                        <li class="nav-item ">
                            <a class="nav-link text-white "
                                href="https://www.creative-tim.com/learning-lab/bootstrap/alerts/material-dashboard"
                                target="_blank">
                                <span class="sidenav-mini-icon"> A </span>
                                <span class="sidenav-normal  me-3  ps-1"> Alerts </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white "
                                href="https://www.creative-tim.com/learning-lab/bootstrap/badge/material-dashboard"
                                target="_blank">
                                <span class="sidenav-mini-icon"> B </span>
                                <span class="sidenav-normal  me-3  ps-1"> Badge </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white "
                                href="https://www.creative-tim.com/learning-lab/bootstrap/buttons/material-dashboard"
                                target="_blank">
                                <span class="sidenav-mini-icon"> B </span>
                                <span class="sidenav-normal  me-3  ps-1"> Buttons </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white "
                                href="https://www.creative-tim.com/learning-lab/bootstrap/cards/material-dashboard"
                                target="_blank">
                                <span class="sidenav-mini-icon"> C </span>
                                <span class="sidenav-normal  me-3  ps-1"> Card </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white "
                                href="https://www.creative-tim.com/learning-lab/bootstrap/carousel/material-dashboard"
                                target="_blank">
                                <span class="sidenav-mini-icon"> C </span>
                                <span class="sidenav-normal  me-3  ps-1"> Carousel </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white "
                                href="https://www.creative-tim.com/learning-lab/bootstrap/collapse/material-dashboard"
                                target="_blank">
                                <span class="sidenav-mini-icon"> C </span>
                                <span class="sidenav-normal  me-3  ps-1"> Collapse </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white "
                                href="https://www.creative-tim.com/learning-lab/bootstrap/dropdowns/material-dashboard"
                                target="_blank">
                                <span class="sidenav-mini-icon"> D </span>
                                <span class="sidenav-normal  me-3  ps-1"> Dropdowns </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white "
                                href="https://www.creative-tim.com/learning-lab/bootstrap/forms/material-dashboard"
                                target="_blank">
                                <span class="sidenav-mini-icon"> F </span>
                                <span class="sidenav-normal  me-3  ps-1"> Forms </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white "
                                href="https://www.creative-tim.com/learning-lab/bootstrap/modal/material-dashboard"
                                target="_blank">
                                <span class="sidenav-mini-icon"> M </span>
                                <span class="sidenav-normal  me-3  ps-1"> Modal </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white "
                                href="https://www.creative-tim.com/learning-lab/bootstrap/navs/material-dashboard"
                                target="_blank">
                                <span class="sidenav-mini-icon"> N </span>
                                <span class="sidenav-normal  me-3  ps-1"> Navs </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white "
                                href="https://www.creative-tim.com/learning-lab/bootstrap/navbar/material-dashboard"
                                target="_blank">
                                <span class="sidenav-mini-icon"> N </span>
                                <span class="sidenav-normal  me-3  ps-1"> Navbar </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white "
                                href="https://www.creative-tim.com/learning-lab/bootstrap/pagination/material-dashboard"
                                target="_blank">
                                <span class="sidenav-mini-icon"> P </span>
                                <span class="sidenav-normal  me-3  ps-1"> Pagination </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white "
                                href="https://www.creative-tim.com/learning-lab/bootstrap/popovers/material-dashboard"
                                target="_blank">
                                <span class="sidenav-mini-icon"> P </span>
                                <span class="sidenav-normal  me-3  ps-1"> Popovers </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white "
                                href="https://www.creative-tim.com/learning-lab/bootstrap/progress/material-dashboard"
                                target="_blank">
                                <span class="sidenav-mini-icon"> P </span>
                                <span class="sidenav-normal  me-3  ps-1"> Progress </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white "
                                href="https://www.creative-tim.com/learning-lab/bootstrap/spinners/material-dashboard"
                                target="_blank">
                                <span class="sidenav-mini-icon"> S </span>
                                <span class="sidenav-normal  me-3  ps-1"> Spinners </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white "
                                href="https://www.creative-tim.com/learning-lab/bootstrap/tables/material-dashboard"
                                target="_blank">
                                <span class="sidenav-mini-icon"> T </span>
                                <span class="sidenav-normal  me-3  ps-1"> Tables </span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white "
                                href="https://www.creative-tim.com/learning-lab/bootstrap/tooltips/material-dashboard"
                                target="_blank">
                                <span class="sidenav-mini-icon"> T </span>
                                <span class="sidenav-normal  me-3  ps-1"> Tooltips </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link"
                    href="https://github.com/creativetimofficial/ct-material-dashboard-pro/blob/master/CHANGELOG.md"
                    target="_blank">
                    <i
                        class="material-icons-round {% if page.brand == 'RTL' %}ms-2{% else %} me-2{% endif %}">receipt_long</i>
                    <span class="nav-link-text me-1">Changelog</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg overflow-x-hidden">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg position-sticky mt-4 top-1 px-0 mx-4 shadow-none border-radius-xl z-index-sticky"
        id="navbarBlur" data-scroll="true">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 ">
                    <li class="breadcrumb-item text-sm ps-2"><a class="opacity-5 text-dark" href="javascript:;">لوحات
                            القيادة</a></li>
                    <li class="breadcrumb-item text-sm text-dark active" aria-current="page">RTL</li>
                </ol>
                <h6 class="font-weight-bolder mb-0">RTL</h6>
            </nav>
            <div class="sidenav-toggler sidenav-toggler-inner d-xl-block d-none me-3">
                <a href="javascript:;" class="nav-link text-body p-0">
                    <div class="sidenav-toggler-inner">
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                        <i class="sidenav-toggler-line"></i>
                    </div>
                </a>
            </div>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 px-0" id="navbar">
                <div class="me-md-auto pe-md-3 d-flex align-items-center">
                    <div class="input-group input-group-outline">
                        <label class="form-label">ابحث هنا</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <ul class="navbar-nav ms-0 justify-content-end">
                    <li class="nav-item">
                        <a href="{{ route('illustration-sign-in') }}" class="nav-link text-body p-0 position-relative"
                            target="_blank">
                            <i class="material-icons ms-sm-1 ">
                                account_circle
                            </i>
                        </a>
                    </li>
                    <li class="nav-item d-xl-none pe-3 d-flex align-items-center">
                        <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item px-3">
                        <a href="javascript:;" class="nav-link text-body p-0">
                            <i class="material-icons fixed-plugin-button-nav cursor-pointer">
                                settings
                            </i>
                        </a>
                    </li>
                    <li class="nav-item dropdown ps-2">
                        <a href="javascript:;" class="nav-link text-body p-0 position-relative" id="dropdownMenuButton"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="material-icons cursor-pointer">
                                notifications
                            </i>
                            <span
                                class="position-absolute top-5 start-100 translate-middle badge rounded-pill bg-danger border border-white small py-1 px-2">
                                <span class="small">11</span>
                                <span class="visually-hidden">unread notifications</span>
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end p-2 me-sm-n4" aria-labelledby="dropdownMenuButton">
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md" href="javascript:;">
                                    <div class="d-flex align-items-center py-1">
                                        <span class="material-icons">email</span>
                                        <div class="ms-2">
                                            <h6 class="text-sm font-weight-normal my-auto">
                                                Check new messages
                                            </h6>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md" href="javascript:;">
                                    <div class="d-flex align-items-center py-1">
                                        <span class="material-icons">podcasts</span>
                                        <div class="ms-2">
                                            <h6 class="text-sm font-weight-normal my-auto">
                                                Manage podcast session
                                            </h6>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item border-radius-md" href="javascript:;">
                                    <div class="d-flex align-items-center py-1">
                                        <span class="material-icons">shopping_cart</span>
                                        <div class="ms-2">
                                            <h6 class="text-sm font-weight-normal my-auto">
                                                Payment successfully completed
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
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-lg-4 col-md-7">
                <div class="card">
                    <div class="card-header p-3 pb-0">
                        <h6 class="mb-0">الأحداث القادمة</h6>
                        <p class="text-sm mb-0 text-capitalize font-weight-bold">انضم</p>
                    </div>
                    <div class="card-body border-radius-lg p-3">
                        <div class="d-flex">
                            <div>
                                <div
                                    class="icon icon-shape bg-gradient-dark icon-md text-center border-radius-md shadow-none">
                                    <i class="material-icons text-white opacity-10" aria-hidden="true">savings</i>
                                </div>
                            </div>
                            <div class="me-3">
                                <div class="numbers">
                                    <h6 class="mb-1 text-dark text-sm">أسبوع الإنترنت</h6>
                                    <span class="text-sm">01 يونيو 2021, ي 12:30 PM</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex mt-4">
                            <div>
                                <div
                                    class="icon icon-shape bg-gradient-dark icon-md text-center border-radius-md shadow-none">
                                    <i class="material-icons text-white opacity-10"
                                        aria-hidden="true">notifications_active</i>
                                </div>
                            </div>
                            <div class="me-3">
                                <div class="numbers">
                                    <h6 class="mb-1 text-dark text-sm">لقاء مع ماري</h6>
                                    <span class="text-sm">24 مايو 2021, ي 10:00 PM</span>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex mt-4">
                            <div>
                                <div
                                    class="icon icon-shape bg-gradient-dark icon-md text-center border-radius-md shadow-none">
                                    <i class="material-icons text-white opacity-10" aria-hidden="true">task</i>
                                </div>
                            </div>
                            <div class="me-3">
                                <div class="numbers">
                                    <h6 class="mb-1 text-dark text-sm">تخطيط المهمة</h6>
                                    <span class="text-sm">25 مايو 2021, ي 10:00 PM</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 mt-lg-0 mt-4">
                <div class="card overflow-hidden">
                    <div class="card-header p-3 pb-0">
                        <div class="d-flex align-items-center">
                            <div
                                class="icon icon-md icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="material-icons text-white opacity-10">
                                    today
                                </i>
                            </div>
                            <div class="me-3">
                                <p class="text-sm mb-0 text-capitalize">مهام</p>
                                <h5 class="font-weight-bolder mb-0">
                                    480
                                </h5>
                            </div>
                            <div class="progress-wrapper me-auto w-25">
                                <div class="progress-info">
                                    <div class="progress-percentage">
                                        <span class="text-xs font-weight-bold">60%</span>
                                    </div>
                                </div>
                                <div class="progress">
                                    <div class="progress-bar bg-gradient-primary w-60" role="progressbar"
                                        aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body mt-3 p-0">
                        <div class="chart">
                            <canvas id="chart-line-widgets" class="chart-canvas" height="200"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-3 col-sm-6">
                <div class="card mb-4">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-4">
                                <div
                                    class="icon icon-lg icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="material-icons opacity-10">battery_charging_full</i>
                                </div>
                            </div>
                            <div class="col-8 my-auto text-start">
                                <p class="text-sm mb-0 opacity-7">صحة البطارية</p>
                                <h5 class="font-weight-bolder mb-0">
                                    99 %
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-4">
                                <div
                                    class="icon icon-lg icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                    <i class="material-icons opacity-10">volume_down</i>
                                </div>
                            </div>
                            <div class="col-8 my-auto text-start">
                                <p class="text-sm mb-0 opacity-7">طبقة صوت الموسيقا</p>
                                <h5 class="font-weight-bolder mb-0">
                                    30/100
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 col-sm-6 mt-sm-0 mt-4">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header mx-4 p-3 text-center">
                                <div
                                    class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                    <i class="material-icons opacity-10">account_balance</i>
                                </div>
                            </div>
                            <div class="card-body pt-0 p-3 text-center">
                                <h6 class="text-center mb-0">مرتب</h6>
                                <span class="text-xs">تنتمي التفاعلية</span>
                                <hr class="horizontal dark my-3">
                                <h5 class="mb-0">+$2000</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-md-0 mt-4">
                        <div class="card">
                            <div class="card-header mx-4 p-3 text-center">
                                <div
                                    class="icon icon-shape icon-lg bg-gradient-primary shadow text-center border-radius-lg">
                                    <i class="material-icons opacity-10">account_balance_wallet</i>
                                </div>
                            </div>
                            <div class="card-body pt-0 p-3 text-center">
                                <h6 class="text-center mb-0">باي بال</h6>
                                <span class="text-xs">دفع لحسابهم الخاص</span>
                                <hr class="horizontal dark my-3">
                                <h5 class="mb-0">$455.00</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6 mt-lg-0 mt-4">
                <div class="card bg-transparent shadow-xl">
                    <div class="overflow-hidden position-relative border-radius-xl">
                        <img src="{{ asset('assets') }}/img/illustrations/pattern-tree.svg"
                            class="position-absolute opacity-2 start-0 top-0 w-100 z-index-1 h-100" alt="pattern-tree">
                        <span class="mask bg-gradient-dark opacity-10"></span>
                        <div class="card-body position-relative z-index-1 p-3">
                            <i class="fas fa-wifi text-white p-2"></i>
                            <h5 class="text-white mt-4 mb-5 pb-2">
                                4562&nbsp;&nbsp;&nbsp;1122&nbsp;&nbsp;&nbsp;4594&nbsp;&nbsp;&nbsp;7852</h5>
                            <div class="d-flex">
                                <div class="d-flex">
                                    <div class="ms-4">
                                        <p class="text-white text-sm opacity-8 mb-0">حامل البطاقة</p>
                                        <h6 class="text-white mb-0">جاك بيترسون</h6>
                                    </div>
                                    <div>
                                        <p class="text-white text-sm opacity-8 mb-0">نتهي</p>
                                        <h6 class="text-white mb-0">11/22</h6>
                                    </div>
                                </div>
                                <div class="me-auto w-20 d-flex align-items-end justify-content-end">
                                    <img class="w-60 mt-2" src="{{ asset('assets') }}/img/logos/mastercard.png"
                                        alt="logo">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-3 col-md-6 col-12">
                <div class="card h-100">
                    <div class="card-header pb-0">
                        <div class="d-flex">
                            <p>جسم كامل</p>
                            <div class="me-auto">
                                <span class="badge badge-primary">معتدل</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <p class="mb-0">ما يهم هو الأشخاص الذين أوقدوه. والناس الذين يشبهونهم مستاءون منه.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-12 mt-4 mt-md-0">
                <div class="card blur shadow-blur">
                    <div class="card-body">
                        <div class="d-flex">
                            <p class="mb-0">على</p>
                            <div class="form-check form-switch me-auto">
                                <input class="form-check-input me-0" type="checkbox" checked
                                    id="flexSwitchCheckDefault">
                            </div>
                        </div>
                        <img class="img-fluid pt-3 pb-2" src="{{ asset('assets') }}/img/small-logos/icon-bulb.svg"
                            alt="logo image">
                        <p class="mb-0">درجة حرارة</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-12 mt-4 mt-lg-0">
                <div class="card overflow-hidden">
                    <div class="card-header p-3 pb-0">
                        <p class="text-sm mb-0 text-capitalize">سعرات حراريه</p>
                        <h5 class="font-weight-bolder mb-0">
                            97
                            <span class="text-success text-sm font-weight-bolder">+5%</span>
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="chart">
                            <canvas id="chart-widgets-1" class="chart-canvas" height="100"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-12 mt-4 mt-lg-0">
                <div class="card">
                    <div class="card-body">
                        <div class="icon icon-shape bg-gradient-primary shadow text-center">
                            <i class="material-icons opacity-10" aria-hidden="true">refresh</i>
                        </div>
                        <h5 class="mt-3 mb-0">754 <span class="text-secondary text-sm">م</span></h5>
                        <p class="mb-0">مدينة نيويورك</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-2 col-md-4 col-12 mt-4 mt-lg-0">
                <div class="card">
                    <div class="card-body">
                        <p>خطوات</p>
                        <h3>11.4ك</h3>
                        <span class="badge badge-success">+4.3%</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-5">
                <div class="card widget-calendar h-100">
                    <!-- Card header -->
                    <div class="card-header p-3 pb-0">
                        <h6 class="mb-0">تقويم</h6>
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
            <div class="col-lg-3 col-md-12 mt-4 mt-lg-0">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">فئات</h6>
                    </div>
                    <div class="card-body p-3">
                        <ul class="list-group pe-0">
                            <li
                                class="list-group-item border-0 d-flex justify-content-between pe-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="icon icon-shape icon-sm ms-3 bg-gradient-dark shadow text-center">
                                        <i class="material-icons opacity-10 pt-2">launch</i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">الأجهزة</h6>
                                        <span class="text-xs">250 في المخزن, <span class="font-weight-bold">346+ تم
                                                البيع</span></span>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <button
                                        class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                            class="ni ni-bold-right" aria-hidden="true"></i></button>
                                </div>
                            </li>
                            <li
                                class="list-group-item border-0 d-flex justify-content-between pe-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="icon icon-shape icon-sm ms-3 bg-gradient-dark shadow text-center">
                                        <i class="material-icons opacity-10 pt-2">book_online</i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">تذاكر</h6>
                                        <span class="text-xs">123 مغلق, <span class="font-weight-bold">15
                                                افتح</span></span>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <button
                                        class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                            class="ni ni-bold-right" aria-hidden="true"></i></button>
                                </div>
                            </li>
                            <li
                                class="list-group-item border-0 d-flex justify-content-between pe-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="icon icon-shape icon-sm ms-3 bg-gradient-dark shadow text-center">
                                        <i class="material-icons opacity-10 pt-2">priority_high</i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">سجلات الخطأ</h6>
                                        <span class="text-xs">1 is نشيط, <span class="font-weight-bold">40
                                                مغلق</span></span>
                                    </div>
                                </div>
                                <div class="d-flex">
                                    <button
                                        class="btn btn-link btn-icon-only btn-rounded btn-sm text-dark icon-move-right my-auto"><i
                                            class="ni ni-bold-right" aria-hidden="true"></i></button>
                                </div>
                            </li>
                            <li
                                class="list-group-item border-0 d-flex justify-content-between pe-0 mb-2 border-radius-lg">
                                <div class="d-flex align-items-center">
                                    <div class="icon icon-shape icon-sm ms-3 bg-gradient-dark shadow text-center">
                                        <i class="material-icons opacity-10 pt-2">insert_emoticon</i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-1 text-dark text-sm">المستخدمين السعداء</h6>
                                        <span class="text-xs font-weight-bold">+ 430</span>
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
                <div class="card card-background card-background-mask-dark align-items-start mt-4">
                    <div class="cursor-pointer">
                        <div class="full-background"
                            style="background-image: url('https://images.unsplash.com/photo-1604213410393-89f141bb96b8?ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTA5fHxuYXR1cmV8ZW58MHx8MHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=800&q=60')">
                        </div>
                        <div class="card-body">
                            <h5 class="text-white mb-0">نوع من البلوز</h5>
                            <p class="text-white text-sm">ديفتونز</p>
                            <div class="d-flex mt-5">
                                <button class="btn btn-outline-white rounded-circle p-2 mb-0" type="button"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                    data-bs-original-title="Next">
                                    <i class="material-icons p-2">skip_next</i>
                                </button>
                                <button class="btn btn-outline-white rounded-circle p-2 mx-2 mb-0" type="button"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                    data-bs-original-title="Play">
                                    <i class="material-icons p-2">play_arrow</i>
                                </button>
                                <button class="btn btn-outline-white rounded-circle p-2 mb-0" type="button"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title=""
                                    data-bs-original-title="Prev">
                                    <i class="material-icons p-2">skip_previous</i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-12 mt-4 mt-lg-0">
                <div class="card h-100">
                    <div class="card-header pb-0">
                        <h6>نظرة عامة على الطلبات</h6>
                        <p class="text-sm">
                            <i class="material-icons text-sm text-success" aria-hidden="true">north</i>
                            <span class="font-weight-bold">24%</span> هذا الشهر
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="timeline timeline-one-side">
                            <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="material-icons text-success text-gradient text-lg">notifications</i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">$2400, تغييرات في التصميم
                                    </h6>
                                    <p class="text-secondary text-xs mt-1 mb-0">22 ديسمبر 7:20 مساءً</p>
                                </div>
                            </div>
                            <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="material-icons text-danger text-gradient text-lg">code</i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">طلب جديد # 1832412</h6>
                                    <p class="text-secondary text-xs mt-1 mb-0">21 ديسمبر 11 م</p>
                                </div>
                            </div>
                            <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="material-icons text-info text-gradient text-lg">shopping_cart</i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">مدفوعات الخادم لشهر أبريل
                                    </h6>
                                    <p class="text-secondary text-xs mt-1 mb-0">21 ديسمبر 9:34 مساءً</p>
                                </div>
                            </div>
                            <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="material-icons text-warning text-gradient text-lg">credit_card</i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">تمت إضافة بطاقة جديدة للأمر
                                        رقم 4395133</h6>
                                    <p class="text-secondary text-xs mt-1 mb-0">20 ديسمبر 2:20 صباحًا</p>
                                </div>
                            </div>
                            <div class="timeline-block mb-3">
                                <span class="timeline-step">
                                    <i class="material-icons text-primary text-gradient text-lg">vpn_key</i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">فتح الحزم من أجل التطوير
                                    </h6>
                                    <p class="text-secondary text-xs mt-1 mb-0">18 ديسمبر ، 4:54 صباحًا</p>
                                </div>
                            </div>
                            <div class="timeline-block">
                                <span class="timeline-step">
                                    <i class="material-icons text-dark text-gradient text-lg">bug_report</i>
                                </span>
                                <div class="timeline-content">
                                    <h6 class="text-dark text-sm font-weight-bold mb-0">طلب جديد # 9583120</h6>
                                    <p class="text-secondary text-xs mt-1 mb-0">17 ديسمبر</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer py-4  ">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-end">
                            © <script>
                                document.write(new Date().getFullYear())

                            </script>,
                            made with <i class="fa fa-heart"></i> by
                            <a href="https://www.creative-tim.com" class="font-weight-bold" target="_blank">Creative
                                Tim &UPDIVISION</a>
                            for a better web.
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com" class="nav-link text-muted"
                                    target="_blank">Creative Tim</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted"
                                    target="_blank">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/blog" class="nav-link text-muted"
                                    target="_blank">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted"
                                    target="_blank">License</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</main>
@push('js')
<!--   Core JS Files   -->

<script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.min.js"></script>

<script src="{{ asset('assets') }}/js/plugins/fullcalendar.min.js"></script>
<!-- Kanban scripts -->
<script src="{{ asset('assets') }}/js/plugins/chartjs.min.js"></script>
<script>
    var ctx1 = document.getElementById("chart-widgets-1").getContext("2d");

    new Chart(ctx1, {
        type: "line",
        data: {
            labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Calories",
                tension: 0.5,
                borderWidth: 0,
                pointRadius: 0,
                borderColor: "#252f40",
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
                        display: false
                    }
                },
            },
        },
    });

    var ctx3 = document.getElementById("chart-line-widgets").getContext("2d");

    var gradientStroke3 = ctx3.createLinearGradient(0, 230, 0, 50);

    gradientStroke3.addColorStop(1, 'rgba(33,82,255,0.1)');
    gradientStroke3.addColorStop(0.2, 'rgba(33,82,255,0.0)');
    gradientStroke3.addColorStop(0, 'rgba(33,82,255,0)'); //purple colors

    new Chart(ctx3, {
        type: "line",
        data: {
            labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Tasks",
                tension: 0,
                pointRadius: 5,
                pointBackgroundColor: "#E91E63",
                pointBorderColor: "transparent",
                borderColor: "#E91E63",
                borderWidth: 4,
                backgroundColor: "transparent",
                data: [40, 45, 42, 41, 40, 43, 40, 42, 39],
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
                        borderDash: [5, 5]
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
            },
        },
    });

</script>
<script src="{{ asset('assets') }}/js/plugins/choices.min.js"></script>
@endpush
