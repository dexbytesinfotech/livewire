<?php

namespace App\Http\Livewire\Order;

use App\Constants\OrderProviderMessages;
use App\Models\Order\Order; 
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use App\Models\User;
use App\Constants\OrderStatus;
use App\Constants\OrderMessages;
use App\Constants\OrderPaymentStatus;
use App\Constants\OrderPaymentStatusLabel;
use App\Constants\OrderStatusLabel;
use App\Constants\PaymentMessage;
use App\Events\InstantPushNotification;
use App\Models\Order\Transaction;

class Details extends Component
{
    use AuthorizesRequests;
    public $order;
    public $driver;
    public $allStatus;
    public $order_id;
    public $statusLabels;
    public $orderPaymentStatus;
    public $orderPaymentStatusLabel;
    protected $listeners = ['statusUpdate','paymentStatusUpdate'];
   
    public function mount($id) {
        $this->order_id = $id;
        $this->order = Order::with('store', 'orderProducts', 'TransactionHistory', 'OrderDriver', 'orderUpdateHistory', 'user', 'store.storeAddress')->find($this->order_id);
        $this->driver = $this->order->OrderDriver ? User::find($this->order->OrderDriver->assing_to_id) : '';
        
        $orderStatusConstant = new OrderStatus();
        $this->allStatus = $orderStatusConstant->getConstants(); 
        
        $orderStatusLabelConstant = new OrderStatusLabel();
        $this->statusLabels = $orderStatusLabelConstant->getConstants(); 

     
        $PaymentStatus = new OrderPaymentStatus();
        $this->orderPaymentStatus = $PaymentStatus->getConstants();
       // dd( $this->orderPaymentStatus);
        $StatusLabelConstant = new OrderPaymentStatusLabel();
        $this->orderPaymentStatusLabel =   $StatusLabelConstant->getConstants();
        // dd( $this->orderPaymentStatus);
    }

    public function render()
    {
        return view('livewire.order.details');
    }


    /**
     * update order status
     *
     * @return response()
     */
    public function statusUpdate($status)
    {   
        Order::where('id', '=' , $this->order_id )->update(['order_status' => $status]); 
        $this->order = Order::with('store', 'orderProducts', 'TransactionHistory', 'OrderDriver', 'orderUpdateHistory', 'user', 'store.storeAddress')->find($this->order_id);     
       
        $message = $this->_getMessages($status);  
        event(new InstantPushNotification($this->order->user_id, [
            "title" =>  $message['title'],
            "body" =>   $message['body'],
            "data" => [
                'order_id' => $this->order->id,
                'type' => 'order',
                'status' => $status,
            ]
        ]));
   
    }

    public function paymentStatusUpdate($TxnStatus ,$id){
      $transaction = Transaction::findOrFail($id);
      $transaction->whereId($id)->update(['status'=>$TxnStatus]);
      $this->order = Order::with('store', 'orderProducts', 'TransactionHistory', 'OrderDriver', 'orderUpdateHistory', 'user', 'store.storeAddress')->find($this->order_id);  
      $message = $this->_getTxnMessage($TxnStatus);  
      event(new InstantPushNotification($transaction->user_id, [
          "title" =>  $message['title'],
          "body" =>   $message['body'],
          "data" => [
              'order_id' => $this->order->id,
              'type' => 'order',
              'status' => $TxnStatus,
          ]
      ]));
        
    }


    public function _getMessages($status){
        $title = '';
        $body = '';

        switch ($status) {
            case OrderStatus::PENDING:
                $title =  __('order/customer_message.push_title.'.OrderMessages::PUSH_TITLE[OrderStatus::PENDING]);
                $body = __('order/customer_message.push_body.'.OrderMessages::PUSH_BODY[OrderStatus::PENDING]);
            break;
            case OrderStatus::SCHEDULE:
                $title =  __('order/customer_message.push_title.'.OrderMessages::PUSH_TITLE[OrderStatus::SCHEDULE]);
                $body = __('order/customer_message.push_body.'.OrderMessages::PUSH_BODY[OrderStatus::SCHEDULE]);
            break;

            case OrderStatus::ACCEPTED:
                $title =  __('order/customer_message.push_title.'.OrderMessages::PUSH_TITLE[OrderStatus::ACCEPTED]);
                $body = __('order/customer_message.push_body.'.OrderMessages::PUSH_BODY[OrderStatus::ACCEPTED]);
            break;

            case OrderStatus::DECLINED:
                $title =  __('order/customer_message.push_title.'.OrderMessages::PUSH_TITLE[OrderStatus::DECLINED]);
                $body = __('order/customer_message.push_body.'.OrderMessages::PUSH_BODY[OrderStatus::DECLINED]);
            break;

            case OrderStatus::COMPLETED:
                $title =  __('order/customer_message.push_title.'.OrderMessages::PUSH_TITLE[OrderStatus::COMPLETED]);
                $body = __('order/customer_message.push_body.'.OrderMessages::PUSH_BODY[OrderStatus::COMPLETED]);
            break;

            case OrderStatus::AWAITING_PAYMENT:
                $title =  __('order/customer_message.push_title.'.OrderMessages::PUSH_TITLE[OrderStatus::AWAITING_PAYMENT]);
                $body = __('order/customer_message.push_body.'.OrderMessages::PUSH_BODY[OrderStatus::AWAITING_PAYMENT]);
            break;

            case OrderStatus::AWAITING_FULFILLMENT:
                $title =  __('order/customer_message.push_title.'.OrderMessages::PUSH_TITLE[OrderStatus::AWAITING_FULFILLMENT]);
                $body = __('order/customer_message.push_body.'.OrderMessages::PUSH_BODY[OrderStatus::AWAITING_FULFILLMENT]);
            break;

            case OrderStatus::AWAITING_SHIPMENT:
                $title =  __('order/customer_message.push_title.'.OrderMessages::PUSH_TITLE[OrderStatus::AWAITING_SHIPMENT]);
                $body = __('order/customer_message.push_body.'.OrderMessages::PUSH_BODY[OrderStatus::AWAITING_SHIPMENT]);
            break;

            case OrderStatus::AWAITING_PICKUP:
                $title =  __('order/customer_message.push_title.'.OrderMessages::PUSH_TITLE[OrderStatus::AWAITING_PICKUP]);
                $body = __('order/customer_message.push_body.'.OrderMessages::PUSH_BODY[OrderStatus::AWAITING_PICKUP]);
            break;

            case OrderStatus::PARTIALLY_SHIPPED:
                $title =  __('order/customer_message.push_title.'.OrderMessages::PUSH_TITLE[OrderStatus::PARTIALLY_SHIPPED]);
                $body = __('order/customer_message.push_body.'.OrderMessages::PUSH_BODY[OrderStatus::PARTIALLY_SHIPPED]);
            break;

            case OrderStatus::SHIPPED:
                $title =  __('order/customer_message.push_title.'.OrderMessages::PUSH_TITLE[OrderStatus::SHIPPED]);
                $body = __('order/customer_message.push_body.'.OrderMessages::PUSH_BODY[OrderStatus::SHIPPED],['duration' => ""]);
            break;

            case OrderStatus::CANCELLED:
                $title =  __('order/customer_message.push_title.'.OrderMessages::PUSH_TITLE[OrderStatus::CANCELLED]);
                $body = __('order/customer_message.push_body.'.OrderMessages::PUSH_BODY[OrderStatus::CANCELLED]);
            break;

            case OrderStatus::REFUNDED:
                $title =  __('order/customer_message.push_title.'.OrderMessages::PUSH_TITLE[OrderStatus::REFUNDED]);
                $body = __('order/customer_message.push_body.'.OrderMessages::PUSH_BODY[OrderStatus::REFUNDED]);
            break;

            case OrderStatus::PARTIALLY_REFUNDED:
                $title =  __('order/customer_message.push_title.'.OrderMessages::PUSH_TITLE[OrderStatus::PARTIALLY_REFUNDED]);
                $body = __('order/customer_message.push_body.'.OrderMessages::PUSH_BODY[OrderStatus::PARTIALLY_REFUNDED]);
            break;
        }

        return ['title' => $title, 'body' => $body];

    }

    public function _getTxnMessage($TxnStatus){
        $title = '';
        $body = '';

        switch ($TxnStatus) {
            case OrderPaymentStatus::PENDING:
                $title =  __('order/payment_message.push_title.'.PaymentMessage::PUSH_TITLE[OrderPaymentStatus::PENDING]);
                $body = __('order/payment_message.push_body.'.PaymentMessage::PUSH_BODY[OrderPaymentStatus::PENDING]);
            break;
            case OrderPaymentStatus::HOLD:
                $title =  __('order/payment_message.push_title.'.PaymentMessage::PUSH_TITLE[OrderPaymentStatus::HOLD]);
                $body = __('order/payment_message.push_body.'.PaymentMessage::PUSH_BODY[OrderPaymentStatus::HOLD]);
            break;

            case OrderStatus::CANCELLED:
                $title =  __('order/payment_message.push_title.'.PaymentMessage::PUSH_TITLE[OrderPaymentStatus::CANCELLED]);
                $body = __('order/payment_message.push_body.'.PaymentMessage::PUSH_BODY[OrderPaymentStatus::CANCELLED]);
            break;

            case OrderStatus::DECLINED:
                $title =  __('order/payment_message.push_title.'.PaymentMessage::PUSH_TITLE[OrderPaymentStatus::DECLINED]);
                $body = __('order/payment_message.push_body.'.PaymentMessage::PUSH_BODY[OrderPaymentStatus::DECLINED]);
            break;

            case OrderStatus::COMPLETED:
                $title =  __('order/payment_message.push_title.'.PaymentMessage::PUSH_TITLE[OrderPaymentStatus::COMPLETED]);
                $body = __('order/payment_message.push_body.'.PaymentMessage::PUSH_BODY[OrderPaymentStatus::COMPLETED]);
            break;

            case OrderStatus::REFUNDED:
                $title =  __('order/payment_message.push_title.'.PaymentMessage::PUSH_TITLE[OrderPaymentStatus::REFUNDED]);
                $body = __('order/payment_message.push_body.'.PaymentMessage::PUSH_BODY[OrderPaymentStatus::REFUNDED]);
            break;

        }

        return ['title' => $title, 'body' => $body];


    }

}
