<?php

namespace App\Constants;

class DevicesStatus
{

   const AVAILABLE = 'available';
   const NOTAVAILABLE = 'notavailable';
   const ASSIGNED = 'assigned';
   // const NOTASSIGNED = 'notassigned';
   const INSTALLED = 'installed';
   const UNINSTALLED = 'uninstalled';
   const OCCUPIED = 'occupied';
   const DEFECTED = 'defected';
   const ONHOLD = 'onhold';
   
   public function getConstants()
   {
      $reflectionClass = new \ReflectionClass($this);
      return $reflectionClass->getConstants();
   }

   public function getConstantsMessages()
   {
       $messages = [
         'available' => "Available",
         'notavailable' => "Not Available",
         'assigned' => "Assigned",
         // 'notassigned' => "Not Assigned",
         'installed' => "Installed",
         'uninstalled' => "Uninstalled",
         'occupied' => "Occupied",
         'defected' => "Defected",
         'onhold' => "On Hold",
      ];
      return $messages;
   }


   
}
