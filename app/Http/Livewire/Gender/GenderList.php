<?php

namespace App\Http\Livewire\Gender;

use App\Models\Gender;
use Livewire\Component;

class GenderList extends Component
{
    public $genderId;
    public $search = '';
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'refreshParentGender' => '$refresh',
        'deleteGender',
        'editGender',
        'deleteConfirmGender'
    ];

    public function updatingSearch()
    {
        $this->emit('refreshTable');
    }

    public function createGender()
    {
        $this->emit('resetInputFields');
        $this->emit('openGenderModal');
    }

    public function editGender($genderId)
    {
        $this->genderId = $genderId;
        $this->emit('genderId', $this->genderId);
        $this->emit('openGenderModal');
    }

    public function deleteGender($genderId)
    {
        Gender::destroy($genderId);

        $action = 'error';
        $message = 'Successfully Deleted';

        $this->emit('flashAction', $action, $message);
        $this->emit('refreshTable');
    }

    public function render()
    {
        if (empty($this->search)) {
            $genders  = Gender::all();
        } else {
            $genders  = Gender::where('description', 'LIKE', '%' . $this->search . '%')->get();
        }

        return view('livewire.gender.gender-list', [
            'genders' => $genders
        ]);
    }
}
