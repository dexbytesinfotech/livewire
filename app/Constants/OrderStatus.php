<?php

namespace App\Constants;

class OrderStatus
{

   const PENDING = 'pending';
   const SCHEDULE = 'schedule';
   const AWAITING_PAYMENT = 'awaiting_payment';
   const AWAITING_FULFILLMENT = 'awaiting_fulfillment';
   const ACCEPTED = 'accepted';
   const AWAITING_SHIPMENT = 'awaiting_shipment';
   const AWAITING_PICKUP = 'awaiting_pickup';
   const PARTIALLY_SHIPPED = 'partially_shipped';
   const COMPLETED = 'completed';
   const SHIPPED = 'shipped';
   const CANCELLED = 'cancelled';
   const DECLINED = 'declined';
   const REFUNDED = 'refunded';
   const DISPUTED = 'disputed';
   const PARTIALLY_REFUNDED = 'partially_refunded';

   public function getConstants()
   {
      $reflectionClass = new \ReflectionClass($this);
      return $reflectionClass->getConstants();
   }

   public function hasConstant($constans)
   {
      $reflectionClass = new \ReflectionClass($this);
      return $reflectionClass->hasConstant($constans);
   }
   
}
