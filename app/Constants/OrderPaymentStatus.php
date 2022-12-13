<?php

namespace App\Constants;

class OrderPaymentStatus
{

   const PENDING = 'pending';
   const HOLD = 'hold';
   const CANCELLED = 'cancelled';
   const DECLINED = 'declined';
   const COMPLETED = 'completed';
   const REFUNDED = 'refunded';

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
