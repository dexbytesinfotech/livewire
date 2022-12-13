<?php

namespace App\Constants;

class TicketsStatus
{

   const OPEN = 'open';
   const DRAFT = 'draft';
   const INPROGRESS = 'inprogress';
   const COMPLETED = 'completed';
   const CLOSED = 'closed';
   const REJECTED = 'rejected';
   const HOLD = 'hold';
 
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
