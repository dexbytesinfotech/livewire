<?php

namespace App\Constants;

class PaymentMessage
{

    const PUSH_TITLE = [
    'pending' =>  'payment pending',
    'hold' =>  'payment is hold',
    'cancelled' =>  'payment cancelled',
    'declined' =>  'payment declined',
    'refunded' =>  'payment refunded',
    'completed' =>  'payment pending',
];

    const PUSH_BODY  =[
    'pending' =>  'payment pending',
    'hold' =>  'payment is hold',
    'cancelled' =>  'payment cancelled',
    'declined' =>  'payment declined',
    'refunded' =>  'payment refunded',
    'completed' =>  'payment completed',
];
}