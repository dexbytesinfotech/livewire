<?php

namespace App\Constants;

class OrderMessages
{

    const STATUS = [
        'pending' => 'The request is in progress',
        'schedule' => 'The order request is scheduled',
        'accepted' => 'Order under preparation',
        'shipped' => 'In the way to customer',
        'completed' => 'Order delivered successfully',
        'cancelled' => 'Order cancelled',
        'refunded' => 'Order refunded',
        'disputed' => 'Disputed Order',
        'awaiting_payment' => 'Awaiting Payment',
        'awaiting_fulfillment' => 'Awaiting Fulfillment',
        'awaiting_shipment' => 'Awaiting Shipment',
        'awaiting_pickup' => 'Order under preparation',
        'partially_shipped' => 'Partially Shipped',
        'declined' => 'Rejected',
        'partially_refunded' => 'Partially Refunded',
        'duration_extend' => 'Duration timeout',
    ];


// order_scheduled is for notification before schedule
    const PUSH_TITLE = [
        'pending' =>  'The request is in progress',
        'schedule' => 'The scheduled request is pending',
        'accepted' => 'The order has been accepted from the restaurant',
        'shipped' => 'Your order on the way',
        'completed' => 'Your order have been delivered successfully',
        'cancelled' => 'Order cancelled',
        'refunded' => 'Order refunded',
        'disputed' => 'Disputed Order',
        'awaiting_payment' => 'Awaiting Payment',
        'awaiting_fulfillment' => 'Awaiting Fulfillment',
        'awaiting_shipment' => 'Awaiting Shipment',
        'awaiting_pickup' => 'Your order delivery partner is assigned',
        'partially_shipped' => 'Partially Shipped',
        'declined' => 'Order Rejected',
        'partially_refunded' => 'Partially Refunded',
        'duration_extend' => 'Duration timeout',
    ];


    const PUSH_BODY  =[
        'pending' =>  'The request is in progress',
        'schedule' => 'The scheduled request is pending',
        'accepted' => 'Restaurant has started preparing your order ',
        'shipped' => 'Your order will be delivered in ({duration}) minutes as per the details',
        'completed' => 'We hope you enjoy your meal',
        'cancelled' => 'Your Order no "#order number" has been cancelled at our restaurant.We apologies for inconvenience caused.',
        'refunded' => 'Your Order no "#order number" has been refunded',
        'disputed' => 'Disputed Order',
        'awaiting_payment' => 'Awaiting Payment',
        'awaiting_fulfillment' => 'Awaiting Fulfillment',
        'awaiting_shipment' => 'Awaiting Shipment',
        'awaiting_pickup' => 'They are on their way to the restaurant',
        'partially_shipped' => 'Partially Shipped',
        'declined' => 'Order has been rejected since not all items are available',
        'partially_refunded' => 'Partially Refunded',
        'duration_extend' => 'Duration timeout',
    ];
}
