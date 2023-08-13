<?php

namespace App\Http\Livewire\World\State;

use App\Models\Worlds\Country;
use App\Models\Worlds\State;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Edit extends Component
{
    use AuthorizesRequests;

    public State $state;
    public $country = '';

    protected function rules(){
        return [
            'state.name' => 'required|max:50|unique:App\Models\Worlds\State,name,'.$this->state->id,
            'state.country_id' =>'required',
            'state.is_default'=> 'nullable|between:0,1',
            'state.status' => 'nullable|between:0,1'
        ];
    }

    public function mount($id) {

        $this->state = State::find($id);
        $this->country = Country::all();
    }

    public function updated($propertyName){

        $this->validateOnly($propertyName);
    }

    public function edit(){
         
        $this->validate();
        
        if($this->state->is_default){
            State::where('is_default', 1)->where('country_id', $this->state->country_id )->update(['is_default' => 0]);
        }

        $this->state->update();

        return redirect(route('state-management'))->with('status', __('world.State successfully updated.'));
    }



    public function render()
    {
        return view('livewire.world.state.edit');
    }
}
