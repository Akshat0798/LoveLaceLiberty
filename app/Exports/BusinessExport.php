<?php

namespace App\Exports;

use App\Models\Business;
use App\Models\User;
use Carbon\Carbon;
use App\Registration;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class BusinessExport implements FromView, ShouldAutoSize, WithEvents
{
    // private $users;

    public function __construct($users)
    {
        $this->users = $users;
    }

    /**
     * @return View
     */
    public function view(): View
    {
        return view('admin.business.export', ['users' => User::where('role_id',2)->get(),'business'=> $this->users]);
    }

    /**
     * @return array
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $event->sheet->getDelegate()->setRightToLeft(true);
            },
        ];
    }


    // public function collection()
    // {
    //     //returns Data with User data, all user data, not restricted to start/end dates
    //     return User::with('relationship')->get();
    // }
 
    // public function map($datas) : array {
    //     return [
    //         $datas->relationship,
    //     ] ;
 
 
    // }
 
    // public function headings() : array {
    //     return [
    //        'Relationship Status',
    //     ] ;
    // }


    // /**
    // * @return \Illuminate\Support\Collection
    // */
    // public function view(): View
    // {
    //     $datas = User::get();
    //     return view('admin.user.export',compact('datas'));
    // }


}