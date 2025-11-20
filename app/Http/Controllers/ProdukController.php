<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Menampilkan daftar produk untuk admin (CRUD).
     */
    public function indexAdmin()
    {
        $produks = Produk::with('category')->latest()->paginate(8);
        $categories = Category::orderBy('nama')->get();

        return view('admin.produk.index', compact('produks', 'categories'));
    }

    /**
     * Menampilkan produk untuk user (Katalog Produk).
     */
    public function index(Request $request)
    {
        $kategori = $request->input('kategori'); // ambil kategori dari query

        // Ambil produk dengan filter kategori jika ada
        $produks = Produk::with('category')
            ->when($kategori, function ($query, $kategori) {
                return $query->whereHas('category', function ($query) use ($kategori) {
                    $query->where('nama', $kategori);
                });
            })
            ->latest()
            ->paginate(8);

        $categories = Category::orderBy('nama')->get();

        // **Cek role user**
        if (auth()->check() && auth()->user()->role === 'admin') {
            return view('admin.produk.index', compact('produks', 'categories'));
        }

        return view('Katalog.index', compact('produks', 'categories'));
    }

    /**
     * Menampilkan katalog produk atau detail produk
     */
public function show($id)
{
    // Ambil produk utama
    $produk = Produk::findOrFail($id);

    // Ambil produk rekomendasi berdasarkan kategori yang sama
    $rekomendasi = Produk::where('category_id', $produk->category_id)
        ->where('id', '!=', $produk->id)
        ->limit(4)
        ->get();

    return view('produks.show', compact('produk', 'rekomendasi'));
}



    /**
     * Simpan produk baru ke database untuk admin.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kuantitas' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            $validated['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        Produk::create($validated);

        // Redirect berdasarkan role user (admin atau user)
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil ditambahkan.');
        } else {
            return redirect()->route('katalog.index')->with('success', 'Produk berhasil ditambahkan.');
        }
    }

    /**
     * Update produk di database untuk admin.
     */
    public function update(Request $request, Produk $produk)
    {
        $validated = $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kuantitas' => 'required|integer|min:1',
            'harga' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
                Storage::disk('public')->delete($produk->gambar);
            }
            $validated['gambar'] = $request->file('gambar')->store('produk', 'public');
        }

        $produk->update($validated);

        // Redirect berdasarkan role user (admin atau user)
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil diperbarui.');
        } else {
            return redirect()->route('katalog.index')->with('success', 'Produk berhasil diperbarui.');
        }
    }

    /**
     * Hapus produk dari database dan storage untuk admin.
     */
    public function destroy(Produk $produk)
    {
        if ($produk->gambar && Storage::disk('public')->exists($produk->gambar)) {
            Storage::disk('public')->delete($produk->gambar);
        }

        $produk->delete();

        // Redirect berdasarkan role user (admin atau user)
        if (auth()->user()->role === 'admin') {
            return redirect()->route('admin.produk.index')->with('success', 'Produk berhasil dihapus.');
        } else {
            return redirect()->route('katalog.index')->with('success', 'Produk berhasil dihapus.');
        }
    }
}
