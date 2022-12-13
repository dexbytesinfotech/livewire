<?php

namespace App\Constants;

class OrderStatusLabel
{

   const pending = 'primary';
   const schedule = 'primary';
   const awaiting_payment = 'info';
   const awaiting_fulfillment = 'info';
   const accepted = 'info';
   const awaiting_shipment = 'info';
   const awaiting_pickup = 'info';
   const partially_shipped = 'info';
   const completed = 'success';
   const shipped = 'info';
   const cancelled = 'danger';
   const declined = 'secondary';
   const refunded = 'secondary';
   const disputed = 'secondary';
   const partially_refunded = 'warning';

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
