<?php

namespace App\Livewire\Invoice;

use App\Models\Customer;
use Livewire\Component;

class CustomerLivewire extends Component
{



    public $name,$customer_id;
    protected function rules()
    {
        return [
            'name' => 'required',
        ];
    }



########  save category
    public function saveCustomer()
    {
        $this->validate();
        $category = new Customer();
        $category->name = $this->name;
        $category->save();
        session()->flash('message', 'Customer Added successfully');
        $this->resetInput();
        CustomerLivewire::dispatch('close-modal');
    }
########  update category
public function editCustomer(int $category_id)
{
    $customer = Customer::find($category_id);
    if ($customer) {
        $this->customer_id = $customer->id;
        $this->name = $customer->name;
    } else {
        return redirect()->to('/livewire.customer-livewire');
    }
}

//
public function updateCustomer()
    {
            $validatedData = $this->validate();
            Customer::where('id', $this->customer_id)->update([
                'name' => $validatedData['name'],
            ]);
            session()->flash('message', ' Customer Updated successfully');
            $this->resetInput();
            CustomerLivewire::dispatch('close-modal');
    }
########delete Category
public function deleteCustomer(int $customer_id)
{
    $this->customer_id = $customer_id;
}


    public function destroyCustomer()
    {
        Customer::find($this->customer_id)->delete();
        session()->flash('message', 'Customer Deleted successfully');
        CustomerLivewire::dispatch('close-modal');
    }
########  reset all variables
    public function resetInput()
    {
        $this->name = '';
    }
###### close modal
public function closeModal(){
    CustomerLivewire::dispatch('close-modal');
}

    public function render()
    {
        $customers=Customer::orderBy('id','DESC')->get();
        return view('livewire.invoice.customer-livewire',[
            'customers'=>$customers,
        ]);
    }
}
