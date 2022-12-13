<?php
     
namespace App\Traits;
 
use App\Models\Stores\Store;
use App\Models\User;
 
trait GlobalTrait {
 
    public function getStore() 
    {
        if (session()->has('store')) {
            return (object) session('store');
        }
        return [];
    }


    public function getStoreId() 
    {
        if (session()->has('store_id')) {
            return session('store_id');
        }

        return 0;
    }
}