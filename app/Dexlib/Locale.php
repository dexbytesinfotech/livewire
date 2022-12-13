<?php

namespace App\Dexlib;

class Locale
{	

	/**
     * @var array
     */
    public static $_lang = [];

    /**
     * @var array
     */
    public static $_active_lang = [];


    /**
     * @return array|mixed
     */
    public static function getAllLang()
    { 
        if (empty(self::$_lang)) {
            $localeData = file_get_contents(__DIR__.'/Locale/data/locales.json');
            self::$_lang = json_decode($localeData, true);
        }
        return self::$_lang;
    }


    /**
     * @return array|mixed
     */
    public static function getActiveLang()
    {	
        if (empty(self::$_active_lang)) {
            $dir    = '../resources/lang';
            $activeLang = array_diff(scandir($dir), array('..', '.'));
            $allLang = self::getAllLang();        
            foreach ($activeLang as $key => $value) {
            	self::$_active_lang[$value] = $allLang[$value];
            }
        }
        return self::$_active_lang;
    }

	

}

		