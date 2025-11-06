<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Menampilkan daftar semua produk.
     */
    public function index()
    {
        $produks = Produk::with('category')->latest()->get(); // ambil produk + relasi kategori
        $categories = Category::orderBy('nama')->get(); // ambil kategori untuk dropdown di modal

        return view('admin.produk.index', compact('produks', 'categories'));
    }

    /**
     * Menampilkan form detail produk (jika dibutuhkan).
     */
    public function show(Produk $produk)
    {
        return view('admin.produk.show', compact('produk'));
    }

    /**
     * Menampilkan form untuk membuat produk baru.
     */
    public function create()
    {
        $categories = Category::orderBy('nama')->get(); // ambil semua kategori untuk dropdown
        return view('admin.produk.create', compact('categories'));
    }

    /**
     * Simpan produk baru ke database.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kuantitas'   => 'required|integer|min:1',
            'harga'       => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id', // wajib ada kategori
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        Produk::create($validated);

        return redirect()
            ->route('admin.produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit produk.
     */
    public function edit(Produk $produk)
    {
        $categories = Category::orderBy('nama')->get();
        return view('admin.produk.edit', compact('produk', 'categories'));
    }

    /**
     * Update data produk di database.
     */
    public function update(Request $request, Produk $produk)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kuantitas'   => 'required|integer|min:1',
            'harga'       => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'gambar'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        $produk->update($validated);

        return redirect()
            ->route('admin.produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Hapus produk dari database dan storage.
     */
    public function destroy(Produk $produk)
    {
        if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        return redirect()
            ->route('admin.produk.index')
            ->with('success', 'Produk berhasil dihapus.');
    }
}
