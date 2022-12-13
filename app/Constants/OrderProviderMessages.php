<?php

namespace App\Constants;

class OrderProviderMessages
{

    const STATUS = [
        'pending' => 'The request is pending',
        'schedule' => 'The scheduled request is pending',
        'accepted' => 'Order Accepted',
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
        'pending' =>  'New order',
        'schedule' => 'The scheduled request is pending',
        'accepted' => 'Order Accepted',
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

        'remaind_first' => 'Please execute the scheduled order',
        'remaind_second' => 'Please execute the scheduled order',
        'remaind_third' => 'Please execute the scheduled order.',
        'remaind_admin' => 'Order has been not accepted from :restaurant_name',
    ];


    const PUSH_BODY = [
        'pending' =>  'Please accept the order,Order no ',
        'schedule' => 'There is a scheduled order that must be executed after 15 minutes.',
        'accepted' => 'Order under preparation',
        'shipped' => 'In the way to customer',
        'completed' => 'Order no "#order no" ,delivered successfully',
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

        'remaind_first' => 'Reminder, there is a scheduled order that must be executed after 10
        minutes',
        'remaind_second' => 'Please execute the scheduled order',
        'remaind_third' => 'Please execute the scheduled order.',
        'remaind_admin' => 'Order has been not accepted from :restaurant_name',
    ];




}
