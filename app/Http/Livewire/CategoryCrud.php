<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class CategoryCrud extends Component
{
    use LivewireAlert;

    public $data;

    public $category;

    public $description;

    public $categoryId;

    protected $rules = [
        'category' => 'required',
    ];

    public function resetFields()
    {
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
                'description' => $this->description,
            ]);
            $this->alert('success', 'Kategori berhasil dibuat');
            $this->resetFields();
        } catch (\Exception $ex) {
            $this->alert('error', 'ada kesalahan!.');
        }
    }

    public function editCategory($id)
    {
        try {
            $data = Category::findOrFail($id);
            if (! $data) {
                $this->alert('error', 'Data tidak ditemukan!.');
            } else {
                $this->category = $data->category;
                $this->categoryId = $data->id;
                $this->description = $data->description;
            }
        } catch (\Exception $ex) {
            $this->alert('error', 'ada kesalahan!.');
        }
    }

    public function updateCategory()
    {
        $this->validate();
        try {
            Category::whereId($this->categoryId)->update([
                'category' => $this->category,
                'description' => $this->description,
            ]);
            $this->alert('success', 'Kategori berhasil diupdate');
            $this->resetFields();
        } catch (\Exception $ex) {
            $this->alert('error', 'ada kesalahan!.');
        }
    }

    public function cancelCategory()
    {
        $this->resetFields();
    }

    public function deleteCategory($id)
    {
        try {
            $data = Category::find($id);
            if (count($data->products) > 0) {
                $this->alert('error', 'Kategori ini tidak bisa di hapus, karena ada barang di kategori ini !.');
            } else {
                $data->delete();
                $this->alert('success', 'Kategori berhasil dihapus');
            }
        } catch(\Exception $e) {
            $this->alert('error', 'ada kesalahan!.');
        }
    }
}
