@extends('layouts.appl')

@section('title', 'Data Users - FUNILOKA Admin')

@section('content')

@include('components.alert')

<div class="flex flex-col md:flex-row md:items-center justify-between mb-4 md:mb-6 gap-3 px-1">
    <h1 class="text-xl md:text-2xl font-bold text-gray-800">Data Users</h1>
</div>


<div class="bg-white p-3 md:p-6 rounded-2xl shadow border border-gray-200">

   
    <div class="hidden md:block overflow-x-auto">
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
                @foreach ($users as $user)
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
                            <span class="{{ $user->role === 'admin' ? 'bg-sky-100 text-sky-700' : 'bg-gray-100 text-gray-700' }} 
                                px-2 py-1 rounded-lg text-xs font-semibold capitalize">
                                {{ $user->role }}
                            </span>
                        </td>

                        <td class="py-3 px-2 text-gray-500">
                            {{ $user->created_at->format('d M Y') }}
                        </td>

                        <td class="py-3 px-2 text-center flex justify-center gap-2">
                            @if ($user->role !== 'admin')
                                <button onclick="openEditUserModal('{{ $user->id }}','{{ $user->name }}','{{ $user->email }}','{{ $user->role }}')"
                                    class="bg-yellow-100 hover:bg-yellow-200 text-yellow-700 px-3 py-1 rounded-lg text-xs font-medium flex items-center gap-1">
                                    <i class="ri-edit-line"></i>Edit
                                </button>

                                <button onclick="openDeleteUserModal('{{ $user->id }}','{{ $user->name }}')"
                                    class="bg-red-100 hover:bg-red-200 text-red-700 px-3 py-1 rounded-lg text-xs font-medium flex items-center gap-1">
                                    <i class="ri-delete-bin-line"></i>Hapus
                                </button>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>



    <div class="md:hidden space-y-3">
        @foreach ($users as $user)
            <div class="border rounded-xl p-3 bg-gray-50 shadow-sm">

                <div class="flex justify-between items-center">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-sky-100 flex items-center justify-center text-sky-700 font-bold">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">{{ $user->name }}</p>
                            <p class="text-xs text-gray-500">{{ $user->email }}</p>
                        </div>
                    </div>

                    <span class="{{ $user->role === 'admin' ? 'bg-sky-100 text-sky-700' : 'bg-gray-100 text-gray-700' }}
                        px-2 py-1 text-xs rounded-lg">
                        {{ ucfirst($user->role) }}
                    </span>
                </div>

                <div class="text-xs text-gray-500 mt-2">
                    Dibuat: {{ $user->created_at->format('d M Y') }}
                </div>

                @if ($user->role !== 'admin')
                    <div class="mt-3 grid grid-cols-2 gap-2">
                        <button
                            onclick="openEditUserModal('{{ $user->id }}','{{ $user->name }}','{{ $user->email }}','{{ $user->role }}')"
                            class="w-full py-2 bg-yellow-100 hover:bg-yellow-200 text-yellow-700 rounded-lg text-xs font-medium flex items-center justify-center gap-1">
                            <i class="ri-edit-line text-sm"></i>Edit
                        </button>

                        <button
                            onclick="openDeleteUserModal('{{ $user->id }}','{{ $user->name }}')"
                            class="w-full py-2 bg-red-100 hover:bg-red-200 text-red-700 rounded-lg text-xs font-medium flex items-center justify-center gap-1">
                            <i class="ri-delete-bin-line text-sm"></i>Hapus
                        </button>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>


<div id="editUserModal"
    class="fixed inset-0 hidden items-end md:items-center justify-center bg-black/50 z-50">

    <div class="bg-white w-full md:max-w-lg rounded-t-2xl md:rounded-2xl shadow-xl p-6 relative animate-fadeup">

        <button onclick="closeEditUserModal()" class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
            <i class="ri-close-line text-2xl"></i>
        </button>

        <h2 class="text-lg font-semibold text-gray-800 mb-4">Edit User</h2>

        <form id="editUserForm" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="text-sm font-medium text-gray-700">Nama</label>
                <input id="editName" name="name"
                    class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-sky-500">
            </div>

            <div class="mb-4">
                <label class="text-sm font-medium text-gray-700">Email</label>
                <input id="editEmail" name="email"
                    class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-sky-500">
            </div>

            <div class="mb-6">
                <label class="text-sm font-medium text-gray-700">Role</label>
                <select id="editRole" name="role"
                    class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-sky-500">
                    <option value="admin">Admin</option>
                    <option value="user">User</option>
                </select>
            </div>

            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeEditUserModal()"
                    class="px-4 py-2 bg-gray-100 rounded-lg">Batal</button>
                <button type="submit"
                    class="px-4 py-2 bg-sky-700 text-white rounded-lg">Simpan</button>
            </div>

        </form>
    </div>
</div>


<div id="confirmDeleteUserModal"
    class="fixed inset-0 hidden items-end md:items-center justify-center bg-black/50 z-50">

    <div class="bg-white w-full md:max-w-md rounded-t-2xl md:rounded-2xl shadow-xl p-6 relative animate-fadeup">

        <button onclick="closeDeleteUserModal()"
            class="absolute top-3 right-3 text-gray-500 hover:text-gray-700">
            <i class="ri-close-line text-2xl"></i>
        </button>

        <div class="flex items-start gap-3">
            <i class="ri-alert-line text-red-600 text-3xl"></i>

            <div>
                <h2 class="text-lg font-semibold text-gray-800">Konfirmasi Hapus</h2>
                <p class="text-sm text-gray-600 mt-1">
                    Yakin ingin menghapus user:
                    <span id="deleteUserName" class="font-semibold text-gray-800"></span>?
                </p>
            </div>
        </div>

        <form id="deleteUserForm" method="POST" class="mt-6">
            @csrf @method('DELETE')

            <div class="flex justify-end gap-3">
                <button type="button" onclick="closeDeleteUserModal()"
                    class="px-4 py-2 bg-gray-100 rounded-lg">Batal</button>
                <button type="submit"
                    class="px-4 py-2 bg-red-600 text-white rounded-lg">Hapus</button>
            </div>
        </form>
    </div>

</div>




<script>
    function openEditUserModal(id, name, email, role) {
        document.getElementById('editName').value = name;
        document.getElementById('editEmail').value = email;
        document.getElementById('editRole').value = role;
        document.getElementById('editUserForm').action = `/admin/users/${id}`;
        document.getElementById('editUserModal').classList.remove('hidden');
    }

    function closeEditUserModal() {
        document.getElementById('editUserModal').classList.add('hidden');
    }

    function openDeleteUserModal(id, name) {
        document.getElementById('deleteUserName').innerText = name;
        document.getElementById('deleteUserForm').action = `/admin/users/${id}`;
        document.getElementById('confirmDeleteUserModal').classList.remove('hidden');
    }

    function closeDeleteUserModal() {
        document.getElementById('confirmDeleteUserModal').classList.add('hidden');
    }
</script>

@endsection
