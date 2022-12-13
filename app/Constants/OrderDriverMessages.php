<?php

namespace App\Constants;

class OrderDriverMessages
{

    const STATUS = [
        'accepted' => 'Order under preparation',
        'shipped' => 'In the way to customer',
        'completed' => 'Order delivered successfully',
        'cancelled' => 'Order cancelled',
        'refunded' => 'Order refunded',
        'disputed' => 'Disputed Order',
        'awaiting_payment' => 'Awaiting Payment',
        'awaiting_fulfillment' => 'Awaiting Fulfillment',
        'awaiting_shipment' => 'Awaiting Shipment',
        'awaiting_pickup' => 'Awaiting Pickup',
        'partially_shipped' => 'Partially Shipped',
        'declined' => 'Rejected',
        'partially_refunded' => 'Partially Refunded',
        'duration_extend' => 'Duration timeout',
    ];


    const PUSH_TITLE  = [
        'accepted' => 'The order has been accepted from the "name of the driver',
        'pending' => 'New order request',
        'cancelled' => 'Order cancelled',
        'admin_request' => 'Order no "#order number" has  not found any driver.',
    ];


    const PUSH_BODY = [
        'accepted' => 'The order has been accepted from the restaurant , you will be contacted by the restaurant to prepare for the event.',
        'pending' => 'Please accept order request',
        'cancelled' => 'Order accepted to another driver',
        'admin_request' => 'Please update order status, not accept this order',
    ];




}
