<?php

namespace App\Constants;

class OrderPaymentOptions
{

   const PAYFULLAMOUNT = 'pay_full_amount';
   const DEVIDEAMOUNTEVENLY = 'devide_amount_evenly';
   const PAYONDIMAND = 'pay_on_demand';

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
