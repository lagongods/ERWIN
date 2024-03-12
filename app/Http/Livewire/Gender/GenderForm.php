<?php

namespace App\Http\Livewire\Gender;

use App\Models\Gender;
use Livewire\Component;

class GenderForm extends Component
{
    public $genderId, $name;
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'genderId',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    //edit
    public function genderId($genderId)
    {
        $this->genderId = $genderId;
        $gender = Gender::whereId($genderId)->first();
        $this->name = $gender->name;
    }

    //store
    public function store()
    {
        $data = $this->validate([
            'name' => 'required',
        ]);

        if ($this->genderId) {
            Gender::whereId($this->genderId)->first()->update($data);
            $action = 'edit';
            $message = 'Successfully Updated';
        } else {
            Gender::create($data);
            $action = 'store';
            $message = 'Successfully Created';
        }

        $this->emit('flashAction', $action, $message);
        $this->resetInputFields();
        $this->emit('closeGenderModal');
        $this->emit('refreshParentGender');
        $this->emit('refreshTable');
    }

    public function render()
    {
        return view('livewire.gender.gender-form');
    }
}
