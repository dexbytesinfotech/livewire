<?php

namespace App\Http\Livewire\Messages;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use App\Models\Messages\UserMessage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Order\Order;
use App\Events\InstantPushNotification;

class Index extends Component
{   
    use AuthorizesRequests;
    use WithPagination;

    public $search = '';
    public $sortField = 'id';
    public $sortDirection = 'desc';
    public $perPage = 10;
    public $conversationOrderId = 0;
    public $conversationRole;
    public $conversationMessages = [];
    public $conversationOrderNumber;
    public $textMessage = '';
    public $deleteOrderId;
    public $deleteRole;
    public $order_number = '';
    public $role = '';
    public $order_id = '';

    protected $queryString = ['sortField', 'sortDirection', 'order_id', 'role' , 'order_number'];
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['remove', 'confirm'];

    public function sortBy($field) {
        if($this->sortField === $field) {
            $this->sortDirection = $this->sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            $this->sortDirection = 'asc';
        }
        $this->sortField = $field;
    }

    public function mount() {
        $this->conversation($this->order_id, $this->role, $this->order_number);
    }


    public function render()
    {   
        $userId = auth()->user()->id;
        $message =  UserMessage::with(['sender', 'order', 'order.OrderDriver'])->Where( function($query) use($userId){
            $query->orwhere('sender_id', $userId);
            $query->orwhere('receiver_id', $userId);
        });
        
        $message->select('user_messages.*')->join(DB::raw('(select order_id,role, max(created_at) as latest from user_messages group by order_id,role) r'),
        function($join)
        {
           $join->on('user_messages.created_at', '=', 'r.latest');
           $join->on('user_messages.order_id', '=', 'r.order_id');
           $join->on('user_messages.role', '=', 'r.role');
        });
      
        return view('livewire.messages.index',[
            'messages' => $message->searchMultipleMessage(trim(strtolower($this->search)))->orderBy($this->sortField, $this->sortDirection)->paginate($this->perPage)
        ]);
    }


    public function conversation($order_id, $role, $order_number = ''){   
        
        if(empty($order_id) && empty($role)) return;

        $messageUpdate = UserMessage::where('receiver_id', auth()->user()->id)->where('order_id', $order_id)->where('role', $role);
        $messageUpdate->update(['is_read' => true]);

        if($this->conversationOrderId ==  $order_id &&  $this->conversationRole == $role){
            $this->conversationOrderId = 0;
            $this->conversationRole = '';
        }else{
            $this->conversationOrderId = $order_id;
            $this->conversationRole = $role;
            $this->conversationOrderNumber = $order_number;
            $this->_messages();
        }  
        
        $this->order_id =  $this->conversationOrderId;
        $this->role = $this->conversationRole;
        $this->order_number = $order_number;
    } 


    public function _messages(){
         // Messages
         $message = UserMessage::with(['sender','receiver']);
         $message->where('order_id', $this->conversationOrderId);
         $message->where('role', $this->conversationRole);
         $message->orderby('id','ASC');
         $this->conversationMessages = $message->get();
    }


    public function send() {
       
        if ($this->textMessage) {
            $order = Order::with(['storeOwner', 'OrderDriver'])->where('id', $this->conversationOrderId)->first();
            $senderId = auth()->user()->id;
            $receiverId = 0;
            $title =  'You have a new message - #' .$this->conversationOrderNumber;

            switch($this->conversationRole) {
                case 'Driver':  
                        if($order->OrderDriver) {
                            $receiverId = $order->OrderDriver->assing_to_id;
                        }else{
                            return false;
                        }
                        break;
                case 'Provider':
                        $receiverId = $order->storeOwner->user_id ;
                        break;
                case 'Customer':
                        $receiverId = $order->user_id;
                        break;
            }

            UserMessage::create([
                'sender_id' => $senderId,
                'receiver_id' => $receiverId ? $receiverId : $order->user_id,
                'order_number' => $this->conversationOrderNumber,
                'order_id' => $this->conversationOrderId,
                'title'   => $title,
                'message' => $this->textMessage,
                'role'   => $this->conversationRole,
            ]);

            $this->_messages();
        
            //Push Notifications send
            event(new InstantPushNotification($receiverId, [
                "title" => $title,
                "body" => $this->textMessage,
                "data" => [
                    'order_id' => $this->conversationOrderId,
                    'type' => 'message'
                ]
            ]));

            $this->textMessage = '';
        } 

        return false;
    }


       /**
     * Write code on Method
     *
     * @return response()
     */
    public function destroyConversationConfirm($order_id, $role)
    {
        $this->deleteOrderId  = $order_id;
        $this->deleteRole = $role;
        $this->dispatchBrowserEvent('swal:confirm', [
                'action' => 'remove',
                'type' => 'warning',  
                'confirmButtonText' => 'Yes, delete it!',
                'cancelButtonText' => 'No, cancel!',
                'message' => 'Are you sure?', 
                'text' => 'If deleted, you will not be able to recover this Conversation!'
            ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function remove()
    {
        UserMessage::where('order_id', $this->deleteOrderId)->where('role', $this->deleteRole)->delete();
        $this->conversationOrderId = 0;
        $this->conversationRole = '';
        $this->order_id = '';
        $this->role = '';
        $this->order_number = '';

        $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',  
                'message' => 'Conversation Delete Successfully!', 
                'text' => 'It will not list on Conversation table soon.'
            ]);
    }



}
