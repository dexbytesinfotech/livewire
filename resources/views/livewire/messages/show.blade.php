<div class="container-fluid py-4 bg-gray-200">
    <div class="row mb-5">
        <div class="col-lg-9 col-12 mx-auto position-relative">
            @if (session('status'))
            <div class="row">
                <div class="col-sm-12">
                    <div class="alert alert-success alert-dismissible text-white mt-3" role="alert">
                        <span class="text-sm">{{ Session::get('status') }}</span>
                        <button type="button" class="btn-close text-lg py-3 opacity-10" data-bs-dismiss="alert"
                            aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
            @endif
           
            <!-- Card Basic Info -->
            <div class="card mt-4" id="basic-info">
                <div class="card-body pt-0">
                    <div class="mb-1">
                        @foreach ($messages as  $msg)
                        <div class="d-flex">
                            <div class="flex-shrink-0">
                                @if ($msg["sender"]->profile_photo)
                                <img src="/storage/{{ $msg["sender"]->profile_photo }} " alt="avatar"
                                    class="avatar rounded-circle">
                                @else
                                <img src="{{ asset('assets') }}/img/default-avatar.png" alt="avatar"
                                    class="avatar rounded-circle">
                                @endif
                            </div>
                                <div class="flex-grow-1 ms-3">
                                    <h6 class="h5 mt-0">{{ ($msg->sender_id == Auth::user()->id)? 'You' : $msg["sender"]->name }}</h6>
                                    <p class="text-sm">{{ $msg->message }}</p>
                                </div>
                        </div>
                        @endforeach
                        <div class="d-flex mt-4">
                            <div class="flex-shrink-0">
                                <img alt="Image placeholder" class="avatar rounded-circle me-3"
                                    src="{{ asset('assets') }}/img/default-avatar.png">
                            </div>
                            <form wire:submit.prevent="store" class="d-flex w-100">
                                <div class="flex-grow-1 my-auto">
                                    <div class="input-group input-group-static">
                                        <textarea wire:model="message" class="form-control" placeholder="Write your comment"
                                            spellcheck="false"></textarea>
                                    </div>
                                    <input wire:model="orderId" type="hidden" class="form-control">
                                </div>
                                <div>
                                {{-- <span class="material-symbols-outlined mt-4">
                                    attach_file
                                </span> --}}
                                </div>
                                <button wire:click="$emit('refreshComponent')" class="btn bg-gradient-primary btn-sm mt-auto mb-0 ms-2"
                                    type="submit" name="submit"><i
                                        class="material-icons text-sm">send</i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
 
        </div>
    </div>
</div>
@push('js')
<script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.min.js"></script>
@endpush
