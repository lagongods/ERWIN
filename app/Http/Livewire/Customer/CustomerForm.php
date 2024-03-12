<?php

namespace App\Http\Livewire\Customer;

use App\Models\Gender;
use Livewire\Component;
use App\Models\Customer;

class CustomerForm extends Component
{
    public $customerId, $first_name, $middle_name, $last_name, $gender_id;
    public $action = '';  //flash
    public $message = '';  //flash

    protected $listeners = [
        'customerId',
        'resetInputFields'
    ];

    public function resetInputFields()
    {
        $this->reset();
        $this->resetValidation();
        $this->resetErrorBag();
    }

    //edit
    public function customerId($customerId)
    {
        $this->customerId = $customerId;
        $customer = Customer::whereId($customerId)->first();
        $this->first_name = $customer->first_name;
        $this->middle_name = $customer->middle_name;
        $this->last_name = $customer->last_name;
        $this->gender_id = $customer->gender_id;
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

        if ($this->customerId) {
            Customer::whereId($this->customerId)->first()->update($data);
            $action = 'edit';
            $message = 'Successfully Updated';
        } else {
            Customer::create($data);
            $action = 'store';
            $message = 'Successfully Created';
        }

        $this->emit('flashAction', $action, $message);
        $this->resetInputFields();
        $this->emit('closeCustomerModal');
        $this->emit('refreshParentCustomer');
        $this->emit('refreshTable');
    }

    public function render()
    {
        $genders  = Gender::all();
        return view('livewire.customer.customer-form', [
            'genders' => $genders,
        ]);
    }
}
