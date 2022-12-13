<div class="container-fluid py-4">
    <div class="row mt-4">
        <div class="col-12">
            <div class="card">
                <!-- Card header -->
                <div class="card-header">
                    <h5 class="mb-0">Items</h5>
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
                @can('create', App\Models\Faq::class)
                <div class="col-12 text-end">
                    <a class="btn bg-gradient-dark mb-0 me-4" href="{{ route('add-item') }}"><i
                            class="material-icons text-sm">add</i>&nbsp;&nbsp;Add Item</a>
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
                        <x-table.heading sortable wire:click="sortBy('items.id')"
                            :direction="$sortField === 'items.id' ? $sortDirection : null">ID
                        </x-table.heading>
                        <x-table.heading sortable wire:click="sortBy('items.name')"
                            :direction="$sortField === 'items.name' ? $sortDirection : null">Name
                        </x-table.heading>
                        <x-table.heading>Photo</x-table.heading>
                        <x-table.heading sortable wire:click="sortBy('items.category_id')"
                            :direction="$sortField === 'items.category_id' ? $sortDirection : null">
                            Category
                        </x-table.heading>
                        <x-table.heading sortable wire:click="sortBy('TagsName')"
                            :direction="$sortField === 'TagsName' ? $sortDirection : null">Tags
                        </x-table.heading>
                        <x-table.heading sortable wire:click="sortBy('items.created_at')"
                            :direction="$sortField === 'items.created_at' ? $sortDirection : null">
                            Creation Date
                        </x-table.heading>
                        @can('manage-items', App\User::class)
                        <x-table.heading>Actions</x-table.heading>
                        @endcan
                    </x-slot>

                    <x-slot name="body">
                        @foreach ($items as $item)
                        <x-table.row wire:key="row-{{ $item->id }}">
                            <x-table.cell>{{ $item->id }}</x-table.cell>
                            <x-table.cell>{{ $item->name }}</x-table.cell>
                            <x-table.cell>
                                <img src="/storage/{{($item->picture)}}" alt="picture"
                                    class="avatar avatar-xl me-2 rounded-3" style="object-fit: cover">
                            </x-table.cell>
                            <x-table.cell>{{ $item->category->name }}</x-table.cell>
                            <x-table.cell>
                                @foreach ($item->tag as $tag)
                                <span class="badge text-white"
                                    style="background-color: {{ $tag->color }};">{{ $tag->name }}</span>
                                @endforeach
                            </x-table.cell>
                            <x-table.cell>{{ $item->created_at }}</x-table.cell>
                            <x-table.cell>
                                @can('manage-items', auth()->user())
                                @can('update', $item)
                                <a rel="tooltip" class="btn btn-success btn-link" href="{{ route('edit-item', $item)}}"
                                    data-original-title="" title="">
                                    <i class="material-icons">edit</i>
                                    <div class="ripple-container"></div>
                                </a>
                                @endcan
                                @can('delete', $item)
                                <button type="button" class="btn btn-danger btn-link" data-original-title="" title=""
                                    onclick="confirm('Are you sure you want to delete this item?') || event.stopImmediatePropagation()"
                                    wire:click="destroy({{ $item->id }})">
                                    <i class="material-icons">close</i>
                                    <div class="ripple-container"></div>
                                </button>
                                @endcan
                                @endcan
                            </x-table.cell>
                        </x-table.row>
                        @endforeach
                    </x-slot>
                </x-table>
                <div id="datatable-bottom">
                    {{ $items->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
<script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.min.js"></script>
@endpush
