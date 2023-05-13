<?php

namespace App\Exports;

use App\Models\Comment\Comment;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportComment implements FromCollection
{

    private $lecture_id;
    private $module_id;

    function __construct($lecture_id, $module_id)
    {
        $this->module_id = $module_id;
        $this->lecture_id = $lecture_id;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        return Comment::where(["lecture_id" => $this->lecture_id, "module_id" => $this->module_id])->get();
    }
}
