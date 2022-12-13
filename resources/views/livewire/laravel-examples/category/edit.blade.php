
        <div class="container-fluid py-4">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header">
                            <h5 class="mb-0">Edit Category</h5>
                            <p>Edit your category</p>
                        </div>
                        <div class="col-12 text-end">
                            <a class="btn bg-gradient-dark mb-0 me-4" href="{{ route('category-management') }}">Back to list</a>
                        </div>
                        <div class="card-body">
                            <form wire:submit.prevent="update" class='d-flex flex-column align-items-center'>

                                <div class="form-group col-12 col-md-6">
                                    <label for="exampleInputname">Name</label>
                                    <input wire:model.lazy="category.name" type="name" class="form-control border border-2 p-2" id="exampleInputname" placeholder="Enter name">
                                    @error('category.name')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>


                                <div class="form-group col-12 mt-2 col-md-6">
                                    <label for="description">Category Description</label>
                                    <textarea wire:model.lazy="category.description" class="form-control border border-2 p-2" placeholder="Description" id="description" ></textarea>
                                    @error('category.description')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-dark mt-3">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @push('js')
    <script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.min.js"></script>
        
    @endpush

