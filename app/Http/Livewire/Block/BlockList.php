<?php

namespace App\Http\Livewire\Block;

use App\Models\Block;
use Livewire\Component;

class BlockList extends Component
{
    public $blockId;
    public $search = '';
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'refreshParentBlock' => '$refresh',
        'deleteBlock',
        'editBlock',
        'deleteConfirmBlock'
    ];

    public function updatingSearch()
    {
        $this->emit('refreshTable');
    }

    public function createBlock()
    {
        $this->emit('resetInputFields');
        $this->emit('openBlockModal');
    }

    public function editBlock($blockId)
    {
        $this->blockId = $blockId;
        $this->emit('blockId', $this->blockId);
        $this->emit('openBlockModal');
    }

    public function deleteBlock($blockId)
    {
        Block::destroy($blockId);

        $action = 'error';
        $message = 'Successfully Deleted';

        $this->emit('flashAction', $action, $message);
        $this->emit('refreshTable');
    }

    public function render()
    {
        if (empty($this->search)) {
            $blocks  = Block::all();
        } else {
            $blocks  = Block::where('description', 'LIKE', '%' . $this->search . '%')->get();
        }

        return view('livewire.block.block-list', [
            'blocks' => $blocks
        ]);
    }
}
