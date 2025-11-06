<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|unique:categories,nama',
        ]);

        Category::create(['nama' => $request->nama]);
        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|unique:categories,nama,'.$id,
        ]);

        $category = Category::findOrFail($id);
        $category->update(['nama' => $request->nama]);
        return redirect()->back()->with('success', 'Kategori berhasil diupdate.');
    }

    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('success', 'Kategori berhasil dihapus.');
    }
}
