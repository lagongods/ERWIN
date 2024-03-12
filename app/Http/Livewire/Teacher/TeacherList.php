<?php

namespace App\Http\Livewire\Teacher;

use App\Models\Teacher;
use Livewire\Component;

class TeacherList extends Component
{
    public $teacherId;
    public $search = '';
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'refreshParentTeacher' => '$refresh',
        'deleteTeacher',
        'editTeacher',
        'deleteConfirmTeacher'
    ];

    public function updatingSearch()
    {
        $this->emit('refreshTable');
    }

    public function createTeacher()
    {
        $this->emit('resetInputFields');
        $this->emit('openTeacherModal');
    }

    public function editTeacher($teacherId)
    {
        $this->teacherId = $teacherId;
        $this->emit('teacherId', $this->teacherId);
        $this->emit('openTeacherModal');
    }

    public function deleteTeacher($teacherId)
    {
        Teacher::destroy($teacherId);

        $action = 'error';
        $message = 'Successfully Deleted';

        $this->emit('flashAction', $action, $message);
        $this->emit('refreshTable');
    }

    public function render()
    {
        if (empty($this->search)) {
            $teachers  = Teacher::all();
        } else {
            $teachers  = Teacher::where('first_name', 'LIKE', '%' . $this->search . '%')->get();
        }

        return view('livewire.teacher.teacher-list', [
            'teachers' => $teachers
        ]);
    }
}
