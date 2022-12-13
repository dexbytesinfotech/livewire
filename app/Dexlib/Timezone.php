<?php

namespace App\Dexlib;
use Arr;

class Timezone
{	

	/**
     * @var array
     */
    public static $_timezone = [];

    /**
     * @return array|mixed
     */
    public static function getAllTimezone()
    { 
        if (empty(self::$_timezone)) {
            $timezoneJson = file_get_contents(__DIR__.'/Locale/data/timezone.json');
            $timezoneList = json_decode($timezoneJson, true);
            $timezone = [];
            foreach ($timezoneList as $key => $value) {
               $timezone[$value['value']] = $value;
            }
           // $timezone =  Arr::sort($timezone);
            self::$_timezone = $timezone;
        }

        return self::$_timezone;
    }



 
}

		