<?php

namespace App\Providers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        Validator::extend('price', function($attribute, $value, $parameters, $validator) {
            $min_field = $parameters[0];
            $data = $validator->getData();
            $min_value = $data[$min_field];
            return $value > $min_value;
          });   
      
          Validator::replacer('price ', function($message, $attribute, $rule, $parameters) {
            return __('product.Sales price is greater than product price');
          });

          Validator::extend('phone', function($attribute, $value, $parameters, $validator) {
            $data = $validator->getData();
            if(isset($data['user']['country_code'])) {
                $value = $data['user']['country_code'].$value;
                $exists  = User::where('phone',$value)->whereNotIn("id",[ $data["user"]["id"]])->exists();
            }else {
                $value = $data['country_code'].$value;
                $exists  = User::where('phone',$value)->exists();
            }
            return ($exists) ?  false : true;
          });   
      
          Validator::replacer('phone', function($message, $attribute, $rule, $parameters) {
            return __('user.The phone has already been taken.');
          });
        
        Builder::macro('getRoleId', function ($name){
            $roles = Role::all();
            for($i = 0; $i < count($roles); $i++) {
                if(strtolower($name) === strtolower($roles[$i]->name)) {
                    return $roles[$i]->id;
                }
            }
        });

        Builder::macro('getCategoryId', function ($name){
            $categories = Category::all();
            for($i = 0; $i < count($categories); $i++) {
                if(strtolower($name) === strtolower($categories[$i]->name)) {
                    return $categories[$i]->id;
                }
            }
        });

        Builder::macro('search', function ($field, $string) {
            return $string ? $this->where($field, 'like', '%'.$string.'%') : $this;
        });

        Builder::macro('searchMultipleUsers', function ($string, $filter = []) {
            
            $this->whereHas('roles', function ($query) use ($filter) {
                if(array_key_exists('role', $filter) && !empty($filter['role'])){
                    $query->where('name' , '=' ,  ucfirst($filter['role']));
                }                                
            });

            if(array_key_exists('status', $filter) && is_numeric($filter['status'])){ 
                $this->where('status' , '=' ,  $filter['status']);
            }   


            if($string) { 
                return $this->where(function($query) use ($string) {
                            $query->where(DB::raw('lower(name)'), 'like', '%'.$string.'%')
                            ->orWhere(DB::raw('lower(email)'), 'like', '%'.$string.'%')
                            ->orWhere('phone', 'like', '%'.$string.'%');
                     });                     
                           
            } else {

                return  $this;
            }
        });

        // Store Filter
        Builder::macro('searchMultipleStore', function ($filters) {

            $query = $this;
            $search = trim(strtolower($filters['search']));
            $query->when(
                $search,
                fn($query, $search) => 
                $query->Where(DB::raw('lower(email)'),  'like','%'.$search.'%')
                ->orWhere('stores.phone', 'like', '%'.$search.'%')
                ->orWhere('stores.created_at', 'like','%'.$search.'%')
                ->orWhereTranslationLike('name', '%'.$search.'%')
            )
            ->when(
                $filters["from_date"],
                fn($query, $date) => $query->whereDate(
                    "created_at",
                    ">=",
                    Carbon::parse($date)
                )
            )
            ->when(
                $filters["to_date"],
                fn($query, $date) => $query->whereDate(
                    "created_at",
                    "<=",
                    Carbon::parse($date)
                )
            )
            ->when(
                $filters["application_status"],
                fn($query, $application_status) => 
                    $query->where("application_status", ucfirst($application_status))
               )
            ->when(
                $filters["store_type"],
                fn($query, $store_type) => 
                    $query->WhereTranslation("store_type", \Str::lower($store_type))
                )
            ->when(
                $filters["application_status"] != 'waiting',
                fn($query, $store_type) => 
                    $query->whereNot("application_status", 'waiting')
                );

            if(array_key_exists('status', $filters) && is_numeric($filters['status'])){ 
                $query->where('status' , '=' ,  $filters['status']);
            }
            return $query;
        });


        
        Builder::macro('searchStoreOwner', function ($string) {
            if($string) {               
                return $this->where(function($query) use ($string) {
                            $query->where('store_id', 'like', '%'.$string.'%');
                            $query->where('user_id', 'like', '%'.$string.'%');
                        });
            } else {
                return $this;
            }
        });


        Builder::macro('searchMultipleOrder', function ($string, $filter) {
            if(array_key_exists('is_provider', $filter) || $filter['store_id']){
                $this->where('store_id' , '=' ,  $filter['store_id']);
            } 


            
            if(array_key_exists('from_date', $filter) && !empty($filter['from_date']) && array_key_exists('to_date', $filter) && !empty($filter['to_date']) ) {
                $this->whereDate('created_at','>=', Carbon::create($filter['from_date']));
                $this->whereDate('created_at','<=',  Carbon::create($filter['to_date']));
            }

            if(array_key_exists('order_status', $filter) && !empty($filter['order_status'])){
                $this->where('order_status' , '=' ,  $filter['order_status']);
            } 
            
           
            if(array_key_exists('orderStatus', $filter) && !empty($filter['orderStatus'])) {
                switch ($filter['orderStatus']) {
                    case 'completed':
                        $this->where('order_status' , '=' , 'completed');
                      break;
                    case 'pending':
                        $this->whereNotIn('order_status' , ['completed', 'cancelled', 'declined', 'refunded', 'disputed', 'partially_refunded', 'schedule', 'awaiting_payment', 'awaiting_fulfillment']);
                      break;
                    case 'cancelled':
                        $this->where('order_status' , '=' , 'cancelled');
                      break;
                    case 'schedule':
                        $this->where('order_status' , '=' , 'schedule');
                      break;
                    case 'awaiting_payment':
                        $this->where('order_status' , '=' , 'awaiting_payment');
                      break;
                    case 'awaiting_fulfillment':
                        $this->where('order_status' , '=' , 'awaiting_fulfillment');
                      break;
                    case 'accepted':
                        $this->where('order_status' , '=' , 'accepted');
                      break;
                    case 'awaiting_shipment':
                        $this->where('order_status' , '=' , 'awaiting_shipment');
                      break;
                    case 'awaiting_pickup':
                        $this->where('order_status' , '=' , 'awaiting_pickup');
                      break;
                    case 'partially_shipped':
                        $this->where('order_status' , '=' , 'partially_shipped');
                      break;
                    case 'shipped':
                        $this->where('order_status' , '=' , 'shipped');
                      break;
                    case 'declined':
                        $this->where('order_status' , '=' , 'declined');
                      break;
                    case 'refunded':
                        $this->where('order_status' , '=' , 'refunded');
                      break;
                    case 'disputed':
                        $this->where('order_status' , '=' , 'disputed');
                      break;
                    case 'partially_refunded':
                        $this->where('order_status' , '=' , 'partially_refunded');
                      break;
                }
            } 

            if($string) {               
                return $this->where(function($query) use ($string) {
                        $query->where(DB::raw('order_number'), 'like', '%'.$string.'%')
                            ->orWhere(DB::raw('lower(order_status)'), 'like', '%'.$string.'%')
                            ->orWhere(DB::raw('lower(comments)'), 'like', '%'.$string.'%');
                        });                      
                           
            } else {
                return $this;
            }
        });

        
        Builder::macro('searchMultiplePage', function ($string) {
            if($string) {               
                return $this->WhereTranslationLike('title', '%'.$string.'%');
            } else {
                return $this;
            }
        });

        Builder::macro('searchMultipleTax', function ($string) {
            if($string) {               
                return $this->where(function($query) use ($string) {
                            $query->where(DB::raw('lower(name)'),'like', '%'.$string.'%');
                        });
            } else {
                return $this;
            }
        });

        Builder::macro('searchMultiple', function ($string) {
            if($string) {
                return $this->where('id', '=', intval($string))
                             ->orWhere('name', 'like', '%'.$string.'%')
                             ->orWhere('description', 'like', '%'.$string.'%')
                             ->orWhere('created_at', 'like', '%'.$string.'%');
            } else {
                return $this;
            }
        });

        Builder::macro('searchMultipleRole', function ($string) {
            if($string) {
                return $this->where('id', '=', intval($string))
                             ->orWhere(DB::raw('lower(name)'), 'like', '%'.$string.'%')
                             ->orWhere('created_at', 'like', '%'.$string.'%');
            } else {
                return $this;
            }
        });

        Builder::macro('searchMultipleTag', function ($string) {
            if($string) {
                return $this->WhereTranslationLike('title', '%'.$string.'%');
            } else {
                return $this;
            }
        });

        Builder::macro('searchMultipleFaqs', function ($string) {
            if($string) {
                return $this->WhereTranslationLike('title', '%'.$string.'%')
                             ->orWhereHas('category', function ($query) use ($string) {
                                $query->WhereTranslationLike('name','%'.$string.'%');                                                     
                            });
            } else {
                return $this;
            }
        });


        Builder::macro('searchMultipleSliders', function ($string) {
            if($string) {
                return $this->where('sliders.id', '=', intval($string))
                             ->orWhereTranslationLike('name', '%'.$string.'%')
                             ->orWhere('start_date_time', 'like', '%'.$string.'%')
                             ->orWhere('end_date_time', 'like', '%'.$string.'%')
                             ->where('deleted_at', NULL);
                             
            } else {    
                return $this->where('deleted_at', NULL);
            }
        });

        Builder::macro('searchMultipleSlidersImage', function ($string) {
            if($string) {
                return $this->where('id', '=', intval($string))
                             ->orWhere('created_at', 'like', '%'.$string.'%')
                             ->where('deleted_at', NULL);
                             
            } else {    
                return $this->where('deleted_at', NULL)
                             ;
            }
        });

       Builder::macro('searchMultipleCategory', function ($string, $filter = []) {

            if(array_key_exists('is_provider', $filter) && $filter['store_id']){
                $this->where('store_id' , '=' ,  $filter['store_id'])->orWhereNull('store_id');
            } 

            if($string) {  
            
                return $this->where(function ($query) use ($string, $filter) {
                    $query->WhereTranslationLike('name', "%" . $string . "%");
                    $query->orWhereHas('store', function ($query2) use ($string, $filter) {
                        if(array_key_exists('is_provider', $filter) && !$filter['is_provider']){
                            $query2->TranslationLike('name','%'.$string.'%');  
                        }                                                                      
                    });
                });      
  
            } else {
                return $this;
            }
        });

        Builder::macro('searchMultipleCoutry', function ($string) {
            if($string) {
                return $this->Where('id', '=', intval($string))
                             ->orWhere(DB::raw('lower(name)'), 'like', '%'.$string.'%');
                             
            } else {
                return $this;
            }
        });
 
 
        Builder::macro('searchMultipleState', function ($string) {
            if($string) {
                return $this->Where('id', '=', intval($string))
                             ->orWhere(DB::raw('lower(name)'), 'like', '%'.$string.'%');
                             
            } else {
                return $this;
            }
        });

        Builder::macro('searchMultipleCity', function ($string) {
            if($string) {
                return $this->Where('id', '=', intval($string))
                             ->orWhere(DB::raw('lower(name)'), 'like', '%'.$string.'%');
             } else {
                return $this;
            }
        });
        
        
        Builder::macro('searchMultipleAddOnOption', function ($string, $filter = []) {

            if(array_key_exists('is_provider', $filter)){
                $this->where('store_id' , '=' ,  $filter['store_id']);
            } 

            if($string) {

                return $this->where(function ($query) use ($string, $filter) {
                    $query->WhereTranslationLike('name', "%" . $string . "%");
                
                });    
             } else {
                return $this;
            }
        });

        Builder::macro('searchMultipleProduct', function ($string, $filter = []) {
            
            if(array_key_exists('store_id', $filter) && !empty($filter['store_id'])){
                $this->where('store_id' , '=' ,  $filter['store_id']);
            }  

            if(array_key_exists('category_id', $filter) && !empty($filter['category_id'])){
                $this->where('categories_ids' , '=' ,  $filter['category_id']);
            }                           
     
            if($string) {
                return $this->where(function ($query) use ($string) {
                            $query->whereTranslationLike('name', "%" . $string . "%");
                            $query->orWhere('sku', "like", "%" . $string . "%");
                            $query->orWhereHas('productCategories', function ($query2) use ($string) {
                                $query2->whereTranslationLike('name', '%'.$string.'%');                                                     
                            });
                        });                          
                     
            } else {
                return $this;
            }

        });

        Builder::macro('searchMultipleStoreType', function ($string) {
            
            if($string) {
                return $this->where(function($query) use ($string) {
                    $query->WhereTranslationLike('name', '%'.$string.'%');
                });
            } else {
                return $this;
            }
        });

 
        Builder::macro('searchMultipleTicketCategory', function ($string, $filter = []) {
          
            if($string) {
                return $this->where(function($query) use ($string) {
                    $query->where('name', 'like', '%'.$string.'%');
                });
            } else {
                return $this;
            }
        });

        Builder::macro('searchMultipleTicket', function ($string, $filter = []) {
              
            if(array_key_exists('status', $filter) && $filter['status']){
                $this->where('status' , '=' ,  $filter['status']);
            }              
            
            if($string) {                
                return $this->where(function($query) use ($string) {
                    $query->where(DB::raw('lower(title)'), 'like', '%'.$string.'%');
                    $query->orWhereHas('user', function ($query2) use ($string) {
                        $query2->where(DB::raw('lower(name)'), 'like', '%'.$string.'%');                                                     
                    });
                    $query->orWhereHas('category', function ($query3) use ($string) {
                        $query3->where(DB::raw('lower(name)'), 'like', '%'.$string.'%');                                                     
                    });
                });

            } else {
                return $this;
            }
        });

        Builder::macro('searchMultipleMessage', function ($string) {
            if($string) {
                return $this->where(function($query) use ($string) {
                    $query->where( DB::raw('order_number'), 'like', '%'.$string.'%');
                });
            } else {
                return $this;
            }
        });


        Builder::macro('searchMultiplePromotions', function ($string) {
            if($string) {
                return $this->where(function($query) use ($string) {
                             $query->orWhere('title', 'like', '%'.$string.'%');
                             $query->orWhere('start_date', 'like', '%'.$string.'%');
                             $query->orWhere('end_date', 'like', '%'.$string.'%');
                             $query->orWhere('created_at', 'like', '%'.$string.'%');
                });
            } else {
                return $this;
            }
        });
 
        Builder::macro('searchMultiplePromotionsStore', function ($string ) {
            if($string) {
                return $this->where(function($query) use ($string) {
                    $query->orWhere(DB::raw('lower(promotions.title)'), 'like', '%'.$string.'%');
                    $query->orWhere('promotions.start_date', 'like', '%'.$string.'%');
                    $query->orWhere('promotions.end_date', 'like', '%'.$string.'%');
                     
                });
            }
            else {
                return $this;
            }
        });

 

        Builder::macro('searchMultipleTransaction', function ($string , $filter = [] ) {

            $this->whereHas('order', function ($query) use ($filter) {        
           
                if(array_key_exists('is_provider', $filter)) {
                    $this->where('store_id' , '=' ,  $filter['store_id']);
                } 
            });
        
            

            if(array_key_exists('from_date', $filter) && !empty($filter['from_date']) && array_key_exists('to_date', $filter) && !empty($filter['to_date']) ) {
                $this->whereDate('created_at','>=', Carbon::create($filter['from_date']));
                $this->whereDate('created_at','<=',  Carbon::create($filter['to_date']));
            }

            if(array_key_exists('status', $filter) && !empty($filter['status'])){
                $this->where('status' , '=' ,  $filter['status']);
            }  

            if(array_key_exists('store_id', $filter) && !empty($filter['store_id'])){
                $this->where('store_id' , '=' ,  $filter['store_id']);
            } 

            if($string) {
                return $this->whereHas('order', function($query) use ($string) {
                    $query->where(DB::raw('order_number'), 'like', '%'.$string.'%');
                })->orWhereHas('user', function($query2) use ($string) {
                    $query2->where(DB::raw('lower(name)'), 'like', '%'.$string.'%');
                });      
            } else {    
                return $this;
            }
        });



    }
}

