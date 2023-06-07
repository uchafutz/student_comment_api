<?php

namespace App\Http\Livewire\Faculty;

use Livewire\Component;

class Faculty extends Component
{

    public $name, $description, $department_id;



    public function render()
    {
        return view('livewire.faculty.faculty');
    }
}
