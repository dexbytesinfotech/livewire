<?php

namespace App\Constants;

class Strings
{

   const FREE_SHIPING = 'Free Shiping';
   const OFF = 'Off';
   const OFFLINE = 'offline';
   const ONLINE = 'online';
   const PAYMENT_URL = '';

   const PAYMENT_FAILURE = 'payment_failure';
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
