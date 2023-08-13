@props([
    "data" => null,
    "route" => null
]
)
<x-table.cell> 
    @foreach (config('translatable.locales') as $locale)
    <a href="@if(app()->getLocale() != $locale) {{ route($route, ['id' => $data->id,'ref_lang' => $locale]) }}  @else {{ route($route, $data->id) }} @endif" class="" data-original-title="{{ $locale }}" title="{{ $locale }}"> 
        <span class="material-symbols-outlined text-md">
         {{ in_array($locale, array_column($data->translations, 'locale')) ? 'edit' : 'add' }}
       </span>
    </a>  
    @endforeach
</x-table.cell>