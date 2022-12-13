<?php

namespace App\Http\Livewire\TicketCategories;

use Livewire\Component;
use App\Models\Tickets\TicketCategory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Create extends Component
{   
    use AuthorizesRequests;

    public $name = "";

    protected $rules = [
        'name' => 'required|max:100|unique:ticket_categories,name',
    ];

    public function updated($propertyName) {

        $this->validateOnly($propertyName);

    } 

    public function store() {

        $this->validate();

        TicketCategory::create([
            'name'  => $this->name,
        ]);

        return redirect(route('ticket-category-management'))->with('status','Ticket category successfully created.');
    }

    public function render()
    {
        return view('livewire.ticket-categories.create');
    }
}
