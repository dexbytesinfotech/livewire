<?php

namespace App\View\Components\Menu;

use Illuminate\View\Component;

class SideMenu extends Component
{
    public $sideBarMenu = array();
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->sideBarMenu = \Storage::disk('local')->exists('menus/sidebar.json') ? json_decode(\Storage::disk('local')->get('menus/sidebar.json')) : [];
        $this->sideBarMenu = collect($this->sideBarMenu)->map(function ($val,$key)
        {
            if($val->type == 'divider'){
                return $val;
            }
            $val->type = $val->type;
            $val->name = trim($val->name);
            $val->href = (!empty(trim($val->href)) && !empty(trim($val->route)) ? false : $val->href);
            $val->route = trim($val->route);
            $val->icon = trim($val->icon);
            $val->key = $val->key;
            $val->noCollapse = (boolean) $val->noCollapse;
            $val->sectionTitle = (isset($val->sectionTitle) && !empty($val->sectionTitle) ? $val->sectionTitle : false);
            $val->id = (empty($this->key) ? \Str::camel($val->name) : \Str::camel($this->key));
            $val->collapse = collect((isset($val->collapse) && !empty($val->collapse) ? $val->collapse : null));
            $val->routeKeys = isset($val->routeKeys) ? json_decode($val->routeKeys) : [];

            if ($val->noCollapse || $val->collapse->isEmpty()){
                if (empty($val->href) && empty($val->route)) {
                    $link = 'javascript::void(0);';
                }else{
                    $href  =  (!empty($val->href)  ? $val->href : null);
                    $route =  (!empty($val->route) && \Route::has($val->route) ? route($val->route,$val->routeKeys) : 'javascript::void(0);');    
                    $link = ($href ? 'javascript::void(0);' : $route);
                }
            }else {
                $link = '#'.$val->id;
            }
            $val->link = $link;
            // Collapse handling with object 
            $val->collapse->map(function ($val,$key)
            {    
                $val->href = (!empty(trim($val->href)) && !empty(trim($val->route)) ? false : $val->href);
                if (empty($val->href) && empty($val->route)) {
                    $link = 'javascript::void(0);';
                }else{
                    $val->routeKeys = isset($val->routeKeys) ? (array) $val->routeKeys : [];
                    $href  =  (!empty($val->href)  ? $val->href : null);
                    $route =  (!empty($val->route) && \Route::has($val->route) ? route($val->route,$val->routeKeys) : 'javascript::void(0);');    
                    $link = ($href ? 'javascript::void(0);' : $route);
                }
                $val->link = $link;
                return $val;
            });
            (array) $val->routes = $val->collapse->pluck('route'); 
            return $val;
        })
        ->where(function ($val,$key)
        {
            if($val->type == 'divider'){
                return $val->type == $val->type;
            }
            if(!empty($val->permission) && \Gate::check($val->permission) == true){
                return $val->permission == $val->permission;
            }else{
                return $val->permission == (empty($val->permission) ? $val->permission : false);
            }
        });
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.menu.side-menu',[
            'sideBarMenu' => $this->sideBarMenu, 
        ]);
    }
}
