{{-- resources/views/components/alert.blade.php --}}

{{-- TOAST NOTIFIKASI --}}
@if (session('success') || session('error'))
    <div 
        id="toast"
        class="fixed top-6 right-6 z-50 flex items-center gap-3 px-6 py-4 rounded-xl shadow-lg border transition-all duration-300 ease-out opacity-0 -translate-y-10
        {{ session('success') ? 'border-sky-200 bg-sky-50 text-sky-800' : 'border-red-200 bg-red-50 text-red-800' }}">
        
        @if (session('success'))
            <i class="ri-checkbox-circle-line text-2xl text-sky-600"></i>
            <div>
                <p class="font-semibold">Sukses!</p>
                <p class="text-sm">{{ session('success') }}</p>
            </div>
        @else
            <i class="ri-error-warning-line text-2xl text-red-600"></i>
            <div>
                <p class="font-semibold">Gagal!</p>
                <p class="text-sm">{{ session('error') }}</p>
            </div>
        @endif

        <button 
            type="button" 
            onclick="closeToast()" 
            class="ml-4 text-gray-400 hover:text-gray-700 transition">
            <i class="ri-close-line text-lg"></i>
        </button>
    </div>
@endif

{{-- TOAST KONFIRMASI DELETE --}}
<div 
    id="confirm-delete-toast" 
    class="fixed inset-0 z-50 hidden bg-black/30 flex items-center justify-center px-4">
    <div class="bg-white rounded-xl shadow-lg border border-red-200 p-6 w-full max-w-md">
        <div class="flex items-center gap-3">
            <i class="ri-alert-line text-3xl text-red-600"></i>
            <div>
                <p class="font-semibold text-lg">Konfirmasi Hapus</p>
                <p class="text-sm mt-1" id="confirm-delete-message"></p>
            </div>
        </div>
        <div class="flex justify-end gap-3 mt-6">
            <button onclick="cancelDelete()" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300 transition">Batal</button>
            <button onclick="submitDelete()" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">Hapus</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Animasi toast sukses/gagal
    const toast = document.getElementById('toast');
    if (toast) {
        setTimeout(() => {
            toast.classList.remove('opacity-0', '-translate-y-10');
            toast.classList.add('opacity-100', 'translate-y-0');
        }, 100);
        setTimeout(() => closeToast(), 4000);
    }

    // Konfirmasi delete untuk semua form dengan class .delete-form
    let formToDelete = null;
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            formToDelete = this;
            const produkName = this.dataset.produk || "produk ini";
            document.getElementById('confirm-delete-message').textContent = `Apakah kamu yakin ingin menghapus "${produkName}"?`;
            document.getElementById('confirm-delete-toast').classList.remove('hidden');
        });
    });

    window.cancelDelete = () => {
        document.getElementById('confirm-delete-toast').classList.add('hidden');
        formToDelete = null;
    };

    window.submitDelete = () => {
        if(formToDelete) formToDelete.submit();
    };
});

function closeToast() {
    const toast = document.getElementById('toast');
    if (toast) {
        toast.classList.add('opacity-0', '-translate-y-10');
        setTimeout(() => toast.remove(), 300);
    }
}
</script>
