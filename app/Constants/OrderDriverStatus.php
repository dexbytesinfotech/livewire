<?php

namespace App\Constants;

class OrderDriverStatus
{

   const PENDING = 'pending';
   const ACCEPTED = 'accepted';
   const CANCELLED = 'cancelled';
   const DECLINED = 'declined';
   const COMPLETED = 'completed';

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
