<?php

namespace App\Exports;

use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class UsersExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithColumnFormatting
{
    use Exportable;

    private $usersData;

    /**
     * Write code on Method
     *
     * @return response()
     */

    public function __construct($usersData)
    {
        $this->usersData = $usersData;
    }
   
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect($this->usersData);
    }

     /**
     * Here you select the row that you want in the file
     *
     * @return response()
     */

    public function map($user): array
    {   
        $userStatus = $user->status == 1 ? 'Active' : 'In Active';
        $photo =!empty($user->profile_photo) ? storage::disk(config('app_settings.filesystem_disk.value'))->url($user->profile_photo) : "";
       
        return [
            $user->name,
            $user->email,
            $user->phone,
            $user->getRoleNames()->implode(','),
            $userStatus,
            $photo,
            $user->created_at,
        ];
    }

    /**
     * Here you select the header that you want in the file
     *
     * @return response()
     */

    public function headings(): array
    {
        return [
            'Name',
            'Email',
            'Phone Number',
            'Role',
            'Status',
            'Photo',
            'Creation Date',
        ];
    }

    /**
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'C' => NumberFormat::FORMAT_NUMBER,
        ];
    }

}
