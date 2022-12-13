<?php

namespace App\Http\Livewire\Messages;

use Route;
use Livewire\Component;
use App\Models\Order\Order;
use App\Models\Messages\UserMessage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Show extends Component
{   
    use AuthorizesRequests;

    public $messages;
    public $message;
    public $orderId;
    public $senderId;
    public $receiverId;
    public $role;
    public $title;
    public $orderNumber;

    protected $listeners = ['refreshComponent' => 'getMessages'];

    public function mount($orderId) {

        $userId = auth()->user()->id;
        $this->orderId = $orderId;
        $this->role = request()->route()->parameter('role');
        // Update Unread
        $messageUpdate = UserMessage::where('receiver_id', $userId);
        $messageUpdate->update(['is_read' => true]);

        // Return Messages
        $message = UserMessage::with(['sender','receiver'])->Where( function($query) use($userId){
                 $query->orwhere('sender_id', $userId);
                 $query->orwhere('receiver_id', $userId);
         });

        $message->where('order_id', $this->orderId);
        $message->where('role', $this->role);
        $message->orderby('id','ASC');
        $this->messages = $message->get();
    }

    public function getMessages() {

        $userId = auth()->user()->id;

        // Update Unread
        $messageUpdate = UserMessage::where('receiver_id', $userId);
        $messageUpdate->update(['is_read' => true]);

        // Return Messages
        $message = UserMessage::with(['sender','receiver'])->Where( function($query) use($userId){
                 $query->orwhere('sender_id', $userId);
                 $query->orwhere('receiver_id', $userId);
         });

        $message->where('order_id', $this->orderId);
        $message->where('role', $this->role);
        $message->orderby('id','ASC');

        $this->messages = $message->get();

    }

    public function resetFields() {
        $this->message = '';
    }

    public function store() {
       
        if ($this->message) {
            $order = Order::with(['storeOwner', 'OrderDriver'])->where('id', $this->orderId)->first();
            $this->role = $this->role;
            $this->senderId = auth()->user()->id;
            $this->orderNumber = $order->order_number;
            $this->title =  'You have a new message - #' . $order->order_number;

            switch($this->role) {
                case 'Driver':  
                        if($order->OrderDriver) {
                            $this->receiverId = $order->OrderDriver->assing_to_id;
                        }else{
                            return false;
                        }
                        break;
                case 'Provider':
                        $this->receiverId = $order->storeOwner->user_id ;
                        break;
                case 'Customer':
                        $this->receiverId = $order->user_id;
                        break;
            }

            UserMessage::create([
                'sender_id' => $this->senderId,
                'receiver_id' => $this->receiverId ? $this->receiverId : $order->user_id,
                'order_number' => $this->orderNumber,
                'order_id' => $this->orderId,
                'title'   => $this->title,
                'message' => $this->message,
                'role'   => $this->role,
            ]);
          
           $this->emit('refreshComponent');
           $this->resetFields();
           //return redirect(request()->header('Referer'));
        } 

        return false;
    }

    public function render() {
        return view('livewire.messages.show');
    }
}
