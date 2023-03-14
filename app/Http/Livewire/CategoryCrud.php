<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;

class CategoryCrud extends Component
{
    public $data, $category, $description, $categoryId;

    protected $rules = [
        'category' => 'required',
    ];

    public function resetFields(){
        $this->category = '';
        $this->description = '';
    }

    public function render()
    {
        $this->data = Category::all();
        return view('livewire.category-crud');
    }

    public function storeCategory()
    {
        $this->validate();
        try {
            Category::create([
                'category' => $this->category,
                'description' => $this->description
            ]);
            session()->flash('success','Post Created Successfully!!');
            $this->resetFields();
        } catch (\Exception $ex) {
            dd($ex->getMessage());
            session()->flash('error','Something goes wrong!!');
        }
    }

    public function editCategory($id){
        try {
            $data = Category::findOrFail($id);
            if( !$data) {
                session()->flash('error','Post not found');
            } else {
                $this->category = $data->category;
                $this->categoryId = $data->id;
                $this->description = $data->description;
            }
        } catch (\Exception $ex) {
            session()->flash('error','Something goes wrong!!');
        }

    }

    public function updateCategory()
    {
        $this->validate();
        try {
            Category::whereId($this->categoryId)->update([
                'category' => $this->category,
                'description' => $this->description
            ]);
            session()->flash('success','Post Updated Successfully!!');
            $this->resetFields();
        } catch (\Exception $ex) {
            session()->flash('success','Something goes wrong!!');
        }
    }

    public function cancelCategory()
    {
        $this->resetFields();
    }

    public function deleteCategory($id)
    {
        try{
            Category::find($id)->delete();
            session()->flash('success',"Post Deleted Successfully!!");
        }catch(\Exception $e){
            session()->flash('error',"Something goes wrong!!");
        }
    }
}
