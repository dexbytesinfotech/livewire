<div class="container-fluid py-4 bg-gray-200">
    <div class="row">
        <div class="col-12">
            <div class="multisteps-form mb-9">
                <!--progress bar-->
                <div class="row">
                    <div class="col-12 col-lg-8 mx-auto my-5">
                    </div>
                </div>
                <!--form panels-->
                <div class="row">
                    <div class="col-12 col-lg-8 m-auto">
                        <div class="card">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                    <div class="multisteps-form__progress">
                                        <button class="multisteps-form__progress-btn js-active" type="button"
                                            title="User Info">
                                            <span>User Info</span>
                                        </button>
                                        <button class="multisteps-form__progress-btn" type="button"
                                            title="Address">Address</button>
                                        <button class="multisteps-form__progress-btn" type="button"
                                            title="Socials">Socials</button>
                                        <button class="multisteps-form__progress-btn" type="button"
                                            title="Profile">Profile</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form class="multisteps-form__form">
                                    <!--single form panel-->
                                    <div class="multisteps-form__panel border-radius-xl bg-white js-active"
                                        data-animation="FadeIn">
                                        <h5 class="font-weight-bolder mb-0">About me</h5>
                                        <p class="mb-0 text-sm">Mandatory informations</p>
                                        <div class="multisteps-form__content">
                                            <div class="row mt-3">
                                                <div class="col-12 col-sm-6">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">First Name</label>
                                                        <input class="multisteps-form__input form-control"
                                                            type="text" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Last Name</label>
                                                        <input class="multisteps-form__input form-control"
                                                            type="text" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12 col-sm-6">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Company</label>
                                                        <input class="multisteps-form__input form-control"
                                                            type="text" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Email Address</label>
                                                        <input class="multisteps-form__input form-control"
                                                            type="email" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12 col-sm-6">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Password</label>
                                                        <input class="multisteps-form__input form-control"
                                                            type="password" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 mt-3 mt-sm-0">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Repeat Password</label>
                                                        <input class="multisteps-form__input form-control"
                                                            type="password" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="button-row d-flex mt-4">
                                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next"
                                                    type="button" title="Next">Next</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!--single form panel-->
                                    <div class="multisteps-form__panel border-radius-xl bg-white"
                                        data-animation="FadeIn">
                                        <h5 class="font-weight-bold mb-0">Address</h5>
                                        <p class="mb-0 text-sm">Tell us where are you living</p>
                                        <div class="multisteps-form__content">
                                            <div class="row mt-3">
                                                <div class="col">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Address 1</label>
                                                        <input class="multisteps-form__input form-control"
                                                            type="text" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Address 2</label>
                                                        <input class="multisteps-form__input form-control"
                                                            type="text" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-3">
                                                <div class="col-12 col-sm-6">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">City</label>
                                                        <input class="multisteps-form__input form-control"
                                                            type="text" />
                                                    </div>
                                                </div>
                                                <div class="col-6 col-sm-4 mt-3 mt-sm-0">
                                                    <select class="form-control" name="choices-state"
                                                        id="choices-state">
                                                        <option value="Asia" selected="">Asia</option>
                                                        <option value="America">America</option>
                                                    </select>
                                                </div>
                                                <div class="col-6 col-sm-2 mt-3 mt-sm-0">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Zip</label>
                                                        <input class="multisteps-form__input form-control"
                                                            type="text" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="button-row d-flex mt-4">
                                                <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button"
                                                    title="Prev">Prev</button>
                                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next"
                                                    type="button" title="Next">Next</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!--single form panel-->
                                    <div class="multisteps-form__panel border-radius-xl bg-white"
                                        data-animation="FadeIn">
                                        <h5 class="font-weight-bolder mb-0">Socials</h5>
                                        <p class="mb-0 text-sm">Please provide at least one social link</p>
                                        <div class="multisteps-form__content">
                                            <div class="row mt-3">
                                                <div class="col-12">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Twitter Handle</label>
                                                        <input class="multisteps-form__input form-control"
                                                            type="text" />
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Facebook Account</label>
                                                        <input class="multisteps-form__input form-control"
                                                            type="text" />
                                                    </div>
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Instagram Account</label>
                                                        <input class="multisteps-form__input form-control"
                                                            type="text" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="button-row d-flex mt-4 col-12">
                                                    <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button"
                                                        title="Prev">Prev</button>
                                                    <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next"
                                                        type="button" title="Next">Next</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--single form panel-->
                                    <div class="multisteps-form__panel border-radius-xl bg-white h-100"
                                        data-animation="FadeIn">
                                        <h5 class="font-weight-bolder mb-0">Profile</h5>
                                        <p class="mb-0 text-sm">Optional informations</p>
                                        <div class="multisteps-form__content mt-3">
                                            <div class="row">
                                                <div class="col-12 mt-3">
                                                    <div class="input-group input-group-dynamic">
                                                        <textarea class="multisteps-form__textarea form-control"
                                                            rows="5"
                                                            placeholder="Say a few words about who you are or what you're working on."></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="button-row d-flex mt-4">
                                                <button class="btn bg-gradient-light mb-0 js-btn-prev" type="button"
                                                    title="Prev">Prev</button>
                                                <button class="btn bg-gradient-dark ms-auto mb-0" type="button"
                                                    title="Send">Send</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js') 
<script src="{{ asset('assets') }}/js/plugins/choices.min.js"></script>
<script src="{{ asset('assets') }}/js/plugins/multistep-form.js"></script>
<script>
    if (document.getElementById('choices-state')) {
        var element = document.getElementById('choices-state');
        const example = new Choices(element, {
            searchEnabled: false
        });
    };

</script>
@endpush
