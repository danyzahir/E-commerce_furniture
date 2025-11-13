<!DOCTYPE html>
<html lang="id" x-data="{ sidebarOpen: false }" x-cloak>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Users - FUNILOKA Admin</title>
  @vite('resources/css/app.css')
  <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
  <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-gray-50 text-gray-800">

  <div class="flex min-h-screen">
    <!-- SIDEBAR -->
    <aside class="w-64 bg-gradient-to-b from-sky-700 to-sky-900 text-white hidden md:flex flex-col shadow-lg">
      <div class="px-6 py-5 text-center font-bold text-2xl border-b border-white/10">
        Funiloka<span class="text-sky-300">Admin</span>
      </div>

      <nav class="flex-1 px-4 py-6 space-y-2 text-sm">
        <a href="{{ route('admin.dashboard') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors duration-200 
                  @if(request()->routeIs('admin.dashboard')) bg-sky-700 @else hover:bg-sky-600 @endif">
          <i class="ri-dashboard-line"></i> Dashboard
        </a>

        <a href="{{ route('admin.produk.index') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors duration-200
                  @if(request()->routeIs('admin.produk.*')) bg-sky-700 @else hover:bg-sky-600 @endif">
          <i class="ri-box-3-line"></i> Produk
        </a>

        <a href="{{ route('admin.categories.index') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors duration-200
                  @if(request()->routeIs('admin.categories.*')) bg-sky-700 @else hover:bg-sky-600 @endif">
          <i class="ri-folder-3-line"></i> Kategori
        </a>

        <a href="{{ route('admin.users.index') }}" 
          class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors duration-200 bg-sky-700">
          <i class="ri-user-line"></i>
          <span>Users</span>
        </a>

        <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors duration-200 hover:bg-sky-600">
          <i class="ri-shopping-bag-3-line"></i> Pesanan
        </a>

        <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors duration-200 hover:bg-sky-600">
          <i class="ri-user-line"></i> Pelanggan
        </a>

        <a href="#" class="flex items-center gap-3 px-3 py-2 rounded-lg transition-colors duration-200 hover:bg-sky-600">
          <i class="ri-bar-chart-2-line"></i> Laporan
        </a>
      </nav>

      <div class="px-6 py-4 border-t border-white/10 flex items-center justify-between">
        <div class="flex items-center gap-2">
          <i class="ri-user-3-line text-lg text-sky-300"></i>
          <span class="text-sm font-medium">{{ Auth::user()->name ?? 'User' }}</span>
        </div>
        <form action="{{ route('logout') }}" method="POST">
          @csrf
          <button type="submit" class="flex items-center gap-1 py-2 px-3 bg-sky-800 hover:bg-sky-700 rounded-lg text-sm font-medium">
            <i class="ri-logout-box-line text-lg"></i>
          </button>
        </form>
      </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-6 md:p-10 transition-all duration-200">
      @include('components.alert')

      <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-3">
        <h1 class="text-2xl font-bold text-gray-800">Data Users</h1>
      </div>

      <!-- TABLE USERS -->
      <div class="bg-white p-6 rounded-2xl shadow border border-gray-200 overflow-x-auto">
        <table class="w-full text-sm text-gray-700 border-collapse">
          <thead class="border-b bg-gray-50 text-gray-600">
            <tr>
              <th class="py-3 px-2 text-left">No</th>
              <th class="py-3 px-2 text-left">Nama</th>
              <th class="py-3 px-2 text-left">Email</th>
              <th class="py-3 px-2 text-left">Role</th>
              <th class="py-3 px-2 text-left">Tanggal Dibuat</th>
              <th class="py-3 px-2 text-center">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($users as $user)
            <tr class="border-b hover:bg-gray-50">
              <td class="py-3 px-2">{{ $loop->iteration }}</td>
              <td class="py-3 px-2 font-medium text-gray-800 flex items-center gap-2">
                <div class="w-8 h-8 flex items-center justify-center rounded-full bg-sky-100 text-sky-700 font-semibold">
                  {{ strtoupper(substr($user->name, 0, 2)) }}
                </div>
                {{ $user->name }}
              </td>
              <td class="py-3 px-2">{{ $user->email }}</td>
              <td class="py-3 px-2">
                @if($user->role === 'admin')
                  <span class="bg-sky-100 text-sky-700 px-2 py-1 rounded-lg text-xs font-semibold">Admin</span>
                @else
                  <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded-lg text-xs font-medium capitalize">{{ $user->role }}</span>
                @endif
              </td>
              <td class="py-3 px-2 text-gray-500">{{ $user->created_at->format('d M Y') }}</td>
              <td class="py-3 px-2 text-center flex justify-center gap-2">
                @if($user->role !== 'admin')
                  <button 
                    onclick="openEditUserModal('{{ $user->id }}', '{{ $user->name }}', '{{ $user->email }}', '{{ $user->role }}')" 
                    class="bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-3 py-1 rounded-lg text-xs font-medium flex items-center gap-1">
                    <i class="ri-edit-line"></i> Edit
                  </button>

                  <button 
                    onclick="openDeleteUserModal('{{ $user->id }}', '{{ $user->name }}')" 
                    class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1 rounded-lg text-xs font-medium flex items-center gap-1">
                    <i class="ri-delete-bin-line"></i> Hapus
                  </button>
                @endif
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="6" class="text-center py-5 text-gray-500">Belum ada pengguna.</td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      {{-- ===== MODAL EDIT USER ===== --}}
      <div id="editUserModal" class="fixed inset-0 hidden items-center justify-center bg-black/50 z-50">
        <div class="bg-white w-full max-w-lg rounded-2xl shadow-xl p-6">
          <h2 class="text-lg font-semibold text-gray-800 mb-4">Edit User</h2>

          <form id="editUserForm" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
              <input type="text" name="name" id="editName"
                     class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
            </div>

            <div class="mb-4">
              <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
              <input type="email" name="email" id="editEmail"
                     class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
            </div>

            <div class="mb-6">
              <label class="block text-sm font-medium text-gray-700 mb-1">Role</label>
              <select name="role" id="editRole"
                      class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
                <option value="admin">Admin</option>
                <option value="user">User</option>
              </select>
            </div>

            <div class="flex justify-end gap-3">
              <button type="button" onclick="closeEditUserModal()"
                      class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-gray-700 font-medium">
                Batal
              </button>
              <button type="submit"
                      class="px-4 py-2 bg-sky-700 hover:bg-sky-800 rounded-lg text-white font-medium">
                Simpan Perubahan
              </button>
            </div>
          </form>
        </div>
      </div>

      {{-- ===== MODAL KONFIRMASI HAPUS USER ===== --}}
      <div id="confirmDeleteUserModal" class="fixed inset-0 hidden items-center justify-center bg-black/50 z-50">
        <div class="bg-white w-full max-w-md rounded-2xl shadow-xl p-6">
          <div class="flex items-start gap-3">

            <i class="ri-alert-line text-red-600 text-3xl mt-1"></i>  
            <div>
              <h2 class="text-lg font-semibold text-gray-800 mb-1">Konfirmasi Hapus</h2>
              <p class="text-sm text-gray-600">
                Apakah kamu yakin ingin menghapus user <span id="deleteUserName" class="font-semibold text-gray-800"></span>?<br>
              </p>
            </div>
          </div>

          <form id="deleteUserForm" method="POST" class="mt-6">
            @csrf
            @method('DELETE')
            <div class="flex justify-end gap-3">
              <button type="button" onclick="closeDeleteUserModal()"
                      class="px-4 py-2 bg-gray-100 hover:bg-gray-200 rounded-lg text-gray-700 font-medium">
                Batal
              </button>
              <button type="submit"
                      class="px-4 py-2 bg-red-600 hover:bg-red-700 rounded-lg text-white font-medium">
                Hapus
              </button>
            </div>
          </form>
        </div>
      </div>

      <script>
        function openEditUserModal(id, name, email, role) {
          const modal = document.getElementById('editUserModal');
          document.getElementById('editName').value = name;
          document.getElementById('editEmail').value = email;
          document.getElementById('editRole').value = role;
          document.getElementById('editUserForm').action = `/admin/users/${id}`;
          modal.classList.remove('hidden');
          modal.classList.add('flex');
        }

        function closeEditUserModal() {
          const modal = document.getElementById('editUserModal');
          modal.classList.add('hidden');
          modal.classList.remove('flex');
        }

        function openDeleteUserModal(id, name) {
          const modal = document.getElementById('confirmDeleteUserModal');
          document.getElementById('deleteUserName').innerText = name;
          document.getElementById('deleteUserForm').action = `/admin/users/${id}`;
          modal.classList.remove('hidden');
          modal.classList.add('flex');
        }

        function closeDeleteUserModal() {
          const modal = document.getElementById('confirmDeleteUserModal');
          modal.classList.add('hidden');
          modal.classList.remove('flex');
        }
      </script>
    </main>
  </div>
</body>
</html>
