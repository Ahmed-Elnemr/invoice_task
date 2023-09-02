<?php

namespace App\Livewire\Invoice;

use App\Models\Category;
use Livewire\Component;

class CategoryLivewire extends Component
{

    public $name, $unit_price,$category_id;
    protected function rules()
    {
        return [
            'name' => 'required',
            'unit_price' => 'required|integer',
        ];
    }

########  save category
    public function saveCat()
    {
        $this->validate();
        $category = new Category();
        $category->name = $this->name;
        $category->unit_price = $this->unit_price;
        $category->save();
        session()->flash('message', 'The Category was added successfully');
        $this->resetInput();
        CategoryLivewire::dispatch('close-modal');
    }
########  update category
public function editCat(int $category_id)
{
    $category = Category::find($category_id);
    if ($category) {
        $this->category_id = $category->id;
        $this->name = $category->name;
        $this->unit_price = $category->unit_price;
    } else {
        return redirect()->to('/livewire.category-livewire');
    }
}

//
public function updateCat()
    {
            $validatedData = $this->validate();
            Category::where('id', $this->category_id)->update([
                'name' => $validatedData['name'],
                'unit_price' => $validatedData['unit_price'],
            ]);
            session()->flash('message', 'The item was updated successfully');
            $this->resetInput();
            CategoryLivewire::dispatch('close-modal');
    }
########delete Category
public function deleteCat(int $category_id)
{
    $this->category_id = $category_id;
}


    public function destroyCat()
    {
        Category::find($this->category_id)->delete();
        session()->flash('message', 'The item was deleted successfully');
        CategoryLivewire::dispatch('close-modal');
    }
########  reset all variables
    public function resetInput()
    {
        $this->name = '';
        $this->unit_price = '';
    }
###### close modal
public function closeModal(){
    CategoryLivewire::dispatch('close-modal');
}

    public function render()
    {
        $categories = Category::orderBy('id','DESC')->get();
        return view('livewire.invoice.category-livewire', [
            'categories' => $categories,
        ]);
    }
}