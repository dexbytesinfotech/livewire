<?php

namespace App\Http\Livewire\TicketCategories;

use Livewire\Component;
use App\Models\Tickets\TicketCategory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Edit extends Component
{  
    use AuthorizesRequests;
    
    public TicketCategory $ticketCategory;

    protected function rules(){
        return [
            'ticketCategory.name'  => 'required|max:100|unique:ticket_categories,name,'.$this->ticketCategory->id,
        ];
    }

    public function mount($id) {

        $this->ticketCategory = TicketCategory::find($id);
    }

    public function updated($propertyName){

        $this->validateOnly($propertyName);
    }

    public function edit() {
        $this->validate();
        $this->ticketCategory->update();

        return redirect(route('ticket-category-management'))->with('status', 'Ticket category successfully updated.');
    }

    public function render()
    {
        return view('livewire.ticket-categories.edit');
    }
}
