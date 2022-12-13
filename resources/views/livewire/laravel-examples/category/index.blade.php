<div class="container-fluid py-4">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <h5 class="mb-0">Category</h5>
                </div>
                @if (Session::has('status'))
                <div class="alert alert-success alert-dismissible text-white mx-4" role="alert">
                    <span class="text-sm">{{ Session::get('status') }}</span>
                    <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @can('create', App\Models\Category::class)
                <div class="col-12 text-end">
                    <a class="btn bg-gradient-dark mb-0 me-4" href="{{ route('add-category') }}"><i
                            class="material-icons text-sm">add</i>&nbsp;&nbsp;Add Category</a>
                </div>
                @endcan
                <div class="d-flex flex-row justify-content-between mx-4">
                    <div class="d-flex mt-3 align-items-center justify-content-center">
                        <p class="text-secondary pt-2">Show&nbsp;&nbsp;</p>
                        <select wire:model="perPage" class="form-control mb-2" id="entries">
                            <option value="5">5</option>
                            <option selected value="10">10</option>
                            <option value="15">15</option>
                            <option value="20">20</option>
                        </select>
                        <p class="text-secondary pt-2">&nbsp;&nbsp;entries</p>
                    </div>
                    <div class="mt-3 ">
                        <input wire:model="search" type="text" class="form-control" placeholder="Search...">
                    </div>
                </div>
                <x-table>
                    <x-slot name="head">
                        <x-table.heading sortable wire:click="sortBy('id')"
                            :direction="$sortField === 'id' ? $sortDirection : null">ID
                        </x-table.heading>
                        <x-table.heading sortable wire:click="sortBy('name')"
                            :direction="$sortField === 'name' ? $sortDirection : null">Name
                        </x-table.heading>
                        <x-table.heading sortable wire:click="sortBy('description')"
                            :direction="$sortField === 'description' ? $sortDirection : null">Description
                        </x-table.heading>
                        <x-table.heading sortable wire:click="sortBy('created_at')"
                            :direction="$sortField === 'created_at' ? $sortDirection : null">
                            Creation Date
                        </x-table.heading>
                        @can('manage-items', App\User::class)
                        <x-table.heading>Actions</x-table.heading>
                        @endcan
                    </x-slot>

                    <x-slot name="body">
                        @foreach ($categories as $category)
                        <x-table.row wire:key="row-{{ $category->id }}">
                            <x-table.cell>{{ $category->id }}</x-table.cell>
                            <x-table.cell>{{ $category->name }}</x-table.cell>
                            <x-table.cell>{{ $category->description }}</x-table.cell>
                            <x-table.cell>{{ $category->created_at }}</x-table.cell>
                            <x-table.cell>
                                @can('manage-items', auth()->user())
                                @can('update', $category)
                                <a rel="tooltip" class="btn btn-success btn-link"
                                    href="{{ route('edit-category', $category)}}" data-original-title="" title="">
                                    <i class="material-icons">edit</i>
                                    <div class="ripple-container"></div>
                                </a>
                                @endcan
                                @if ($category->item->isEmpty() && auth()->user()->can('delete',$category))
                                <button type="button" class="btn btn-danger btn-link" data-original-title="" title=""
                                    onclick="confirm('Are you sure you want to delete this category?') || event.stopImmediatePropagation()"
                                    wire:click="destroy({{ $category->id }})">
                                    <i class="material-icons">close</i>
                                    <div class="ripple-container"></div>
                                </button>
                                @endif
                                @endcan
                            </x-table.cell>
                        </x-table.row>
                        @endforeach
                    </x-slot>
                </x-table>
                <div id="datatable-bottom">
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
<script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.min.js"></script>
@endpush
