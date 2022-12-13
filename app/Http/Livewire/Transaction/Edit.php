<?php

namespace App\Http\Livewire\Transaction;

use App\Constants\OrderPaymentStatus;
use App\Constants\OrderStatus;
use App\Models\Order\Transaction;
use Livewire\Component;

class Edit extends Component
{
    public Transaction $transaction;
    public OrderPaymentStatus $orderPaymentstatus;
    public $updatedId ='';
    public $transactionId = '';
    public $status= '';
    
     
    protected $listeners = ['statusUpdateChange','Update'];
    
    protected function rules(){

        return [
             
            'transaction.status' => 'string',
        ];
    }
    
    public function mount($id){
         $this->updatedId = $id;

         $this->transaction = Transaction::with('user','order','store')->find($id);
         $orderPaymentStatus = new OrderPaymentStatus;
         $this->orderPaymentStatus = $orderPaymentStatus->getConstants();
        
   
    }

    

      /**
     * Write code on Method
     *
     * @return response()
     */
    public function Update($id , $status )
    {
        $this->updatedId = $id;
        $this->status = $status;
        $this->dispatchBrowserEvent('swal:Update', [
                'action' => 'statusUpdateChange',
                'type' => 'warning',  
                'confirmButtonText' => 'Yes, Update it!',
                'cancelButtonText' => 'No, cancel!',
                'message' => 'Are you sure?', 
                'text' => 'Do You Want To Update Status',
            ]);
    }   

/**
     * Write code on Method
     *
     * @return response()
     */
    public function statusUpdateChange()
    {       
        
      
        Transaction::where('id', '=' ,  $this->updatedId)->update(['status' => $this->status ]);  
        
          $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'Status Update Successfully!', 
                'text' => 'It will Change Status on Transaction table soon.'
            ]);
    }

   


    public function updated($propertyName){

        $this->validateOnly($propertyName);
    }


    public function render()
    {
        return view('livewire.transaction.edit');
    }
}
