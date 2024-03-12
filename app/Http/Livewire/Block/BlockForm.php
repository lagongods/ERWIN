<?php

namespace App\Http\Livewire\Block;

use App\Models\Block;
use Livewire\Component;

class BlockForm extends Component
{
    public $blockId, $name;
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'blockId',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    //edit
    public function blockId($blockId)
    {
        $this->blockId = $blockId;
        $block = Block::whereId($blockId)->first();
        $this->name = $block->name;
    }

    //store
    public function store()
    {
        $data = $this->validate([
            'name' => 'required',
        ]);

        if ($this->blockId) {
            Block::whereId($this->blockId)->first()->update($data);
            $action = 'edit';
            $message = 'Successfully Updated';
        } else {
            Block::create($data);
            $action = 'store';
            $message = 'Successfully Created';
        }

        $this->emit('flashAction', $action, $message);
        $this->resetInputFields();
        $this->emit('closeBlockModal');
        $this->emit('refreshParentBlock');
        $this->emit('refreshTable');
    }

    public function render()
    {
        return view('livewire.block.block-form');
    }
}
