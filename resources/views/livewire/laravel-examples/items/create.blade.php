        <div class="container-fluid py-4">
            <div class="row mt-4">
                <div class="col-12">
                    <div class="card">
                        <!-- Card header -->
                        <div class="card-header">
                            <h5 class="mb-0">Add Item</h5>
                            <p>Create new item</p>
                        </div>
                        <div class="col-12 text-end">
                            <a class="btn bg-gradient-dark mb-0 me-4" href="{{ route('item-management') }}">Back to list</a>
                        </div>
                        <div class="card-body">
                            <form wire:submit.prevent="store" class='d-flex flex-column align-items-center'
                                enctype="multipart/form-data">

                                <div class="avatar avatar-xxl position-relative">
                                    <div class="position-relative preview">
                                        <label for="file-input"
                                            class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                                            <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="" aria-hidden="true" data-bs-original-title="Select Image"
                                                aria-label="Select Image"></i><span class="sr-only">Select Image</span>
                                        </label>
                                        <span class="h-12 w-12 rounded-full overflow-hidden bg-gray-100">
                                            @if ($picture)
                                            <img src="{{ $picture->temporaryUrl() }}" alt="Profile Photo">
                                            @else
                                            <img src="{{ asset('assets') }}/img/placeholder.jpg" alt="avatar">
                                            @endif</span>

                                        <input wire:model="picture" type="file" id="file-input">
                                    </div>
                                </div>
                                @error('picture')
                                <p class='text-danger inputerror'>{{ $message }} </p>
                                @enderror

                                <div class="form-group col-12 col-md-6 mt-3">

                                    <label for="exampleInputname">Name</label>
                                    <input wire:model.lazy="name" type="name" class="form-control border border-2 p-2"
                                        id="exampleInputname" placeholder="Enter name">
                                        @error('name')
                                        <p class='text-danger inputerror'>{{ $message }} </p>
                                        @enderror
                                </div>

                                <div class="form-group col-12 col-md-6 mt-3">

                                    <label for='category_id'>Category</label>
                                    <select wire:model.lazy="category_id" class="form-select border border-2 p-2"
                                        data-style="select-with-transition" title="" data-size="100" id="category_id">
                                        <option value="">-</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="form-group col-12 mt-2 col-md-6">

                                    <label for="description">Description</label>
                                    <div wire:ignore>
                                        <div x-data x-ref="quill" x-init="quill = new Quill($refs.quill, {theme: 'snow'});
                                        quill.on('text-change', function () {
                                            $dispatch('quill-text-change', quill.root.innerHTML);
                                        });"
                                            x-on:quill-text-change.debounce.2000ms="@this.set('description', $event.detail)">

                                            {!! $description !!}
                                        </div>
                                    </div>
                                    @error('description')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="form-group col-12 col-md-6 mt-3">

                                    <label>Tags</label>
                                        <div
                                        wire:ignore
                                        x-data
                                        x-init="
                                            choices = new Choices($refs.multiple, {
                                                delimiter: ',',
                                                editItems: true,
                                                maxItemCount: 7,
                                                removeItemButton: true,
                                                addItems: true
                                            });
                                            $refs.multiple.addEventListener('change', function (event) {
                                                values = []
                                                Array.from($refs.multiple.options).forEach(function (option) {
                                                    values.push(option.value || option.text)
                                                })
                                                @this.set('tags_id', values);
                                            })">
                                        <select wire:model="tags_id" x-ref="multiple" multiple="multiple">
                                            @foreach($tags as $tag)
                                                <option value="{{ $tag->id}}">{{ $tag->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('tags_id')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="form-group col-12 col-md-6 mt-3">
                                    <label>Item Status</label>

                                    <div class="form-check">
                                        <input wire:model="status" class="form-check-input" type="radio"
                                            value='published' id="published">
                                        <label class="form-check-label" for="published">
                                            Published
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input wire:model="status" class="form-check-input" type="radio" id="draft"
                                            value='draft'>
                                        <label class="form-check-label" for="draft">
                                            Draft
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input wire:model="status" class="form-check-input" type="radio" id="archive"
                                            value='archive'>
                                        <label class="form-check-label" for="archive">
                                            Archive
                                        </label>
                                    </div>
                                    @error('status')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                <div class="form-check form-switch col-12 col-md-6 mt-3">
                                    <label class="form-check-label" for="flexSwitchCheckDefault">Show on
                                        homepage</label>
                                    <input wire:model="showOnHomepage" class="form-check-input" type="checkbox"
                                        id="flexSwitchCheckDefault" value='1'>
                                </div>
                                <div class="form-group col-12 col-md-6 mt-3">

                                    <label> Item Options</label>
                                    <div class="form-check">
                                        <input wire:model="options" class="form-check-input" type="checkbox"
                                            value="0" id="flexCheckFirst">
                                        <label class="form-check-label" for="flexCheckFirst">
                                            First
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input wire:model="options" class="form-check-input" type="checkbox"
                                            value="1" id="flexCheckSecond">
                                        <label class="form-check-label" for="flexCheckSecond">
                                            Second
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input wire:model="options" class="form-check-input" type="checkbox"
                                            value="2" id="flexCheckThird">
                                        <label class="form-check-label" for="flexCheckThird">
                                            Third
                                        </label>
                                    </div>
                                    @error('options')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>

                                <div class="form-group col-12 col-md-6 mt-3">

                                    <label for="exampleDate">Date</label>
                                    <div
                                        wire:ignore
                                        x-data
                                        x-init="
                                        flatpickr($refs.picker, {
                                            allowInput: true
                                        });">
                                    <input wire:model="date" type="date"
                                    x-ref="picker" class=" form-control border border-2 p-2" id="exampleDate">
                                    @error('date')
                                    <p class='text-danger inputerror'>{{ $message }} </p>
                                    @enderror
                                </div>
                                </div>
                                <button type="submit" class="btn btn-dark mt-3">Add Item</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @push('js')
        <script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.min.js"></script>
        <script src="{{ asset('assets') }}/js/plugins/quill.min.js"></script>
        <script src="{{ asset('assets') }}/js/plugins/flatpickr.min.js"></script>
        <script src="{{ asset('assets') }}/js/plugins/choices.min.js"></script>

        @endpush
