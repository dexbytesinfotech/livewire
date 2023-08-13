<?php

namespace App\Http\DataTable;

trait WithSorting
{
    public $sorts = [];
    public $translate = [];

    public function sortBy($field, $is_translate = false)
    {
       $this->translate = $is_translate;
       if (! isset($this->sorts[$field])) return $this->sorts[$field] = 'asc';

       if ($this->sorts[$field] === 'asc') return $this->sorts[$field] = 'desc';
        unset($this->sorts[$field]);
    }

    public function applySorting($query)
    {
        foreach ($this->sorts as $field => $direction) {
            if ($this->translate) {
                $query->orderByTranslation($field, $direction);
            }else{
                $query->orderBy($field, $direction);
            }
        }

        return $query;
    }
}
