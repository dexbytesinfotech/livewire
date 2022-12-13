<?php

namespace App\Constants;

class OrderReviewTypes
{

   const CUSTOMER = 'customer';
   const DRIVER = 'driver';
   const STORE = 'store';

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
