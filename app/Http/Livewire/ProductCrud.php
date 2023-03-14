<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;

class ProductCrud extends Component
{
    public $data, $category, $category_id, $name, $stock, $price, $productId;

    protected $rules = [
        'name' => 'required',
        'category_id' => 'required',
        'stock' => 'required',
        'price' => 'required',
    ];

    public function resetFields(){
        $this->name = '';
        $this->category_id = null;
        $this->stock = '';
        $this->price = '';
    }

    public function render()
    {
        $this->category = Category::all();
        $this->data = Product::all();
        return view('livewire.product-crud');
    }

    public function storeProduct()
    {
        $this->validate();
        try {
            Product::create([
                'name' => $this->name,
                'category_id' => $this->category_id,
                'stock' => $this->stock,
                'price' => $this->price
            ]);
            session()->flash('success','Post Created Successfully!!');
            $this->resetFields();
        } catch (\Exception $ex) {
            dd($ex->getMessage());
            session()->flash('error','Something goes wrong!!');
        }
    }

    public function editProduct($id){
        try {
            $data = Product::findOrFail($id);
            if( !$data) {
                session()->flash('error','Post not found');
            } else {
                $this->productId = $data->id;
                $this->name = $data->name;
                $this->category_id = $data->category_id;
                $this->stock = $data->stock;
                $this->price = $data->price;
            }
        } catch (\Exception $ex) {
            session()->flash('error','Something goes wrong!!');
        }

    }

    public function updateProduct()
    {
        $this->validate();
        try {
            Product::whereId($this->productId)->update([
                'name' => $this->name,
                'category_id' => $this->category_id,
                'stock' => $this->stock,
                'price' => $this->price
            ]);
            session()->flash('success','Post Updated Successfully!!');
            $this->resetFields();
        } catch (\Exception $ex) {
            session()->flash('success','Something goes wrong!!');
        }
    }

    public function cancelProduct()
    {
        $this->resetFields();
    }

    public function deleteProduct($id)
    {
        try{
            Product::find($id)->delete();
            session()->flash('success',"Post Deleted Successfully!!");
        }catch(\Exception $e){
            session()->flash('error',"Something goes wrong!!");
        }
    }
}
