<?php

namespace App\Constants;

class MailsVarables
{

   const HEADER = 'header';
   const FOOTER = 'footer';
   const SITE_URL = 'site_url';
   const SITE_LOGO = 'site_logo';
   const SITE_NAME = 'site_title';
   const SITE_ADMIN_EMAIL = 'site_admin_email';
   const NAME = 'name';
   const EMAIL = 'email';
   const NUMBER = 'number';
   const STORE_NAME = "store_name";
   const STORE_ADDRESS = "store_address";
   const LINK = 'link';
   const MSG_TITLE = 'msg_title';
   const MSG_BODY = 'msg_body';
   const STATUS = 'status';

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
