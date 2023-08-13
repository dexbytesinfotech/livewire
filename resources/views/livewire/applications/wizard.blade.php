<div class="container-fluid py-4 bg-gray-200">
    <div class="row">
        <div class="col-12 text-center">
            <h3 class="mt-5">Build Your Profile</h3>
            <h5 class="font-weight-normal opacity-6">This information will let us know more about you.</h5>
            <div class="multisteps-form mb-5">
                <!--progress bar-->
                <div class="row">
                    <div class="col-12 col-lg-8 mx-auto my-5">
                        <div class="card">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-primary shadow-primary border-radius-lg pt-4 pb-3">
                                    <div class="multisteps-form__progress">
                                        <button class="multisteps-form__progress-btn js-active" type="button"
                                            title="User Info">
                                            <span>About</span>
                                        </button>
                                        <button class="multisteps-form__progress-btn" type="button" title="Address">
                                            <span>Account</span>
                                        </button>
                                        <button class="multisteps-form__progress-btn" type="button" title="Order Info">
                                            <span>Address</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form class="multisteps-form__form">
                                    <!--single form panel-->
                                    <div class="multisteps-form__panel js-active" data-animation="FadeIn">
                                        <div class="row text-center mt-4">
                                            <div class="col-10 mx-auto">
                                                <h5 class="font-weight-normal">Let's start with the basic information
                                                </h5>
                                                <p>Let us know your name and email address. Use an address you don't
                                                    mind other users contacting you at</p>
                                            </div>
                                        </div>
                                        <div class="multisteps-form__content">
                                            <div class="row mt-3">
                                                <div class="col-12 col-sm-4">
                                                    <div class="avatar avatar-xxl position-relative">
                                                        <img src="{{ asset('assets') }}/img/team-2.jpg"
                                                            class="border-radius-md" alt="team-2">
                                                        <a href="javascript:;"
                                                            class="btn btn-sm btn-icon-only bg-gradient-primary position-absolute bottom-0 end-0 mb-n2 me-n2">
                                                            <span class="material-icons text-xs top-0"
                                                                data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="" aria-hidden="true"
                                                                data-bs-original-title="Edit Image"
                                                                aria-label="Edit Image">
                                                                edit
                                                            </span>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-8 mt-4 mt-sm-0 text-start">
                                                    <div class="input-group input-group-dynamic mb-4">
                                                        <label class="form-label">First Name</label>
                                                        <input type="text" class="form-control multisteps-form__input">
                                                    </div>
                                                    <div class="input-group input-group-dynamic mb-4">
                                                        <label class="form-label">Last Name</label>
                                                        <input type="text" class="form-control multisteps-form__input">
                                                    </div>
                                                    <div class="input-group input-group-dynamic">
                                                        <label class="form-label">Email Address</label>
                                                        <input type="email" class="form-control multisteps-form__input">
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
                                    <div class="multisteps-form__panel" data-animation="FadeIn">
                                        <div class="row text-center mt-4">
                                            <div class="col-10 mx-auto">
                                                <h5 class="font-weight-normal">What are you doing? (checkboxes)</h5>
                                                <p>Give us more details about you. What do you enjoy doing in your spare
                                                    time?</p>
                                            </div>
                                        </div>
                                        <div class="multisteps-form__content">
                                            <div class="row mt-4">
                                                <div class="col-sm-3 ms-auto">
                                                    <input type="checkbox" class="btn-check" id="btncheck1">
                                                    <label class="btn btn-lg btn-outline-primary border-2 px-6 py-5"
                                                        for="btncheck1">
                                                        <i class="material-icons">
                                                            brush
                                                        </i>
                                                    </label>
                                                    <h6>Design</h6>
                                                </div>
                                                <div class="col-sm-3">
                                                    <input type="checkbox" class="btn-check" id="btncheck2">
                                                    <label class="btn btn-lg btn-outline-primary border-2 px-6 py-5"
                                                        for="btncheck2">
                                                        <i class="material-icons">
                                                            integration_instructions
                                                        </i>
                                                    </label>
                                                    <h6>Code</h6>
                                                </div>
                                                <div class="col-sm-3 me-auto">
                                                    <input type="checkbox" class="btn-check" id="btncheck3">
                                                    <label class="btn btn-lg btn-outline-primary border-2 px-6 py-5"
                                                        for="btncheck3">
                                                        <i class="material-icons">
                                                            developer_mode
                                                        </i>
                                                    </label>
                                                    <h6>Develop</h6>
                                                </div>
                                            </div>
                                            <div class="button-row d-flex mt-4">
                                                <button class="btn btn-outline-dark mb-0 js-btn-prev" type="button"
                                                    title="Prev">Prev</button>
                                                <button class="btn bg-gradient-dark ms-auto mb-0 js-btn-next"
                                                    type="button" title="Next">Next</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!--single form panel-->
                                    <div class="multisteps-form__panel" data-animation="FadeIn">
                                        <div class="row text-center mt-4">
                                            <div class="col-10 mx-auto">
                                                <h5 class="font-weight-normal">Are you living in a nice area?</h5>
                                                <p>One thing I love about the later sunsets is the chance to go for a
                                                    walk through the neighborhood woods before dinner</p>
                                            </div>
                                        </div>
                                        <div class="multisteps-form__content">
                                            <div class="row text-start">
                                                <div class="col-12 col-md-8 mt-3">
                                                    <div class="input-group input-group-static">
                                                        <label>Street Name</label>
                                                        <input type="text" class="form-control multisteps-form__input">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-4 mt-3">
                                                    <div class="input-group input-group-static">
                                                        <label>Street No</label>
                                                        <input class="multisteps-form__input form-control"
                                                            type="number" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-7 mt-3">
                                                    <div class="input-group input-group-static">
                                                        <label>City</label>
                                                        <input class="multisteps-form__input form-control"
                                                            type="text" />
                                                    </div>
                                                </div>
                                                <div class="col-12 col-md-5 ms-auto mt-3 text-start">
                                                    <div>
                                                        <label class="form-label mb-0 ms-0">Country</label>
                                                        <select class="form-control" name="choices-country"
                                                            id="choices-country">
                                                            <option value="Argentina">Argentina</option>
                                                            <option value="Albania">Albania</option>
                                                            <option value="Algeria">Algeria</option>
                                                            <option value="Andorra">Andorra</option>
                                                            <option value="Angola">Angola</option>
                                                            <option value="Brasil">Brasil</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="button-row d-flex mt-4 col-12">
                                                    <button class="btn btn-outline-dark mb-0 js-btn-prev" type="button"
                                                        title="Prev">Prev</button>
                                                    <button class="btn bg-gradient-dark ms-auto mb-0" type="button"
                                                        title="Send">Send</button>
                                                </div>
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
<script src="{{ asset('assets') }}/js/plugins/multistep-form.js"></script>
<script src="{{ asset('assets') }}/js/plugins/choices.min.js"></script>
<script>
    if (document.getElementById('choices-country')) {
        var country = document.getElementById('choices-country');
        const example = new Choices(country);
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
