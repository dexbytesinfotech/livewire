<?php
namespace App\Http\DataTable;
use Illuminate\Support\Str;
use Closure;

trait  Column
{

    public $columns = array();
    protected $fields = [];
    public static function field(array $array)
    {
        $column = array();
        $column['field'] = $array['field'];
        $column['sortable'] = isset($array['sortable']) ? true : false;
        $column['direction'] = isset($array['direction']) ? $array['direction'] : false;
        $column['cellClasses'] = isset($array['cellClasses']) ? $array['cellClasses'] : false;
        $column['hidden'] = isset($array['hidden']) ? $array['hidden'] : false;
        $column['label'] = (string) Str::of($array['label'])->after('.')->ucfirst()->replace('_', ' ');
        $column['translate'] = isset($array['translate']) ? $array['translate'] : false;
        $column['viewColumns'] = isset($array['viewColumns']) ? $array['viewColumns'] : true;
        return $column;
    }
    public function mountColumn(){
        if(method_exists($this, 'columns')){
            $this->columns = empty($this->columns()) ? : $this->columns();
            foreach ($this->columns as $key => $column) {
                    if (!$column['hidden']) {
                        $this->fields[] = $column['field'] ;
                    }
            }
        }
        $this->selectedColumns = $this->fields;
    }
    public function aggregate()
    {
        return $this->type === 'string'
            ? 'group_concat'
            : 'count';
    }
}