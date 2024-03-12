<?php

namespace App\Http\Livewire\Customer;

use App\Models\Customer;
use Livewire\Component;

class CustomerList extends Component
{
    public $customerId;
    public $search = '';
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'refreshParentCustomer' => '$refresh',
        'deleteCustomer',
        'editCustomer',
        'deleteConfirmCustomer'
    ];

    public function updatingSearch()
    {
        $this->emit('refreshTable');
    }

    public function createCustomer()
    {
        $this->emit('resetInputFields');
        $this->emit('openCustomerModal');
    }

    public function editCustomer($customerId)
    {
        $this->customerId = $customerId;
        $this->emit('customerId', $this->customerId);
        $this->emit('openCustomerModal');
    }

    public function deleteCustomer($customerId)
    {
        Customer::destroy($customerId);

        $action = 'error';
        $message = 'Successfully Deleted';

        $this->emit('flashAction', $action, $message);
        $this->emit('refreshTable');
    }

    public function render()
    {
        if (empty($this->search)) {
            $customers  = Customer::all();
        } else {
            $customers  = Customer::where('description', 'LIKE', '%' . $this->search . '%')->get();
        }

        return view('livewire.customer.customer-list', [
            'customers' => $customers
        ]);
    }
}
