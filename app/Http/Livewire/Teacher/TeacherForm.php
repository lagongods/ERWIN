<?php

namespace App\Http\Livewire\Teacher;

use Livewire\Component;
use App\Models\Teacher;

class TeacherForm extends Component
{
    public $teacherId, $first_name, $middle_name, $last_name, $gender_id;
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'teacherId',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    //edit
    public function teacherId($teacherId)
    {
        $this->teacherId = $teacherId;
        $teacher = Teacher::whereId($teacherId)->first();
        $this->first_name = $teacher->first_name;
        $this->middle_name = $teacher->middle_name;
        $this->last_name = $teacher->last_name;
        $this->gender_id = $teacher->gender_id;
    }

    //store
    public function store()
    {
        $data = $this->validate([
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'gender_id' => 'nullable',
        ]);

        if ($this->teacherId) {
            Teacher::whereId($this->teacherId)->first()->update($data);
            $action = 'edit';
            $message = 'Successfully Updated';
        } else {
            Teacher::create($data);
            $action = 'store';
            $message = 'Successfully Created';
        }

        $this->emit('flashAction', $action, $message);
        $this->resetInputFields();
        $this->emit('closeTeacherModal');
        $this->emit('refreshParentTeacher');
        $this->emit('refreshTable');
    }

    public function render()
    {
        $teachers  = Teacher::all();
        return view('livewire.teacher.teacher-form', [
            'teachers' => $teachers,
        ]);
    }
}
