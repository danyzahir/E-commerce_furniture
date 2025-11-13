<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar - FinLoka</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-sky-100 to-white min-h-screen flex items-center justify-center p-4">

  <div class="bg-white shadow-xl rounded-2xl w-full max-w-md p-8 border border-gray-100">
    <h1 class="text-3xl font-bold text-center text-sky-700 mb-8">Buat Akun Baru</h1>

    <!-- ALERT AREA -->
    <div id="alertBox" class="hidden mb-4 text-white text-center font-semibold rounded-lg px-4 py-3 transition-all duration-300"></div>

    <form id="registerForm" action="{{ route('register.post') }}" method="POST" class="space-y-6">
      @csrf
      <div>
        <label class="block text-gray-700 mb-2">Nama Lengkap</label>
        <input type="text" name="name" class="w-full border rounded-lg px-4 py-3" required>
      </div>
      <div>
        <label class="block text-gray-700 mb-2">Email</label>
        <input type="email" name="email" class="w-full border rounded-lg px-4 py-3" required>
      </div>
      <div>
        <label class="block text-gray-700 mb-2">Password</label>
        <input type="password" id="password" name="password" class="w-full border rounded-lg px-4 py-3" required>
      </div>
      <div>
        <label class="block text-gray-700 mb-2">Konfirmasi Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" class="w-full border rounded-lg px-4 py-3" required>
      </div>
      <button type="submit" class="w-full bg-sky-700 hover:bg-sky-800 text-white py-3 rounded-lg transition">
        Daftar Sekarang
      </button>
    </form>

    <p class="text-center text-gray-600 mt-6">
      Sudah punya akun?
      <a href="{{ route('login') }}" class="text-sky-700 font-semibold">Masuk di sini</a>
    </p>
  </div>

  <script>
    const form = document.getElementById('registerForm');
    const alertBox = document.getElementById('alertBox');

    form.addEventListener('submit', function(e) {
      const password = document.getElementById('password').value.trim();
      const confirm = document.getElementById('password_confirmation').value.trim();

      // Reset alert
      alertBox.classList.add('hidden');
      alertBox.textContent = '';

      if (password.length < 8) {
        e.preventDefault();
        showAlert(' Password harus minimal 8 karakter!');
        return;
      }

      if (password !== confirm) {
        e.preventDefault();
        showAlert(' Konfirmasi password tidak sama!');
        return;
      }
    });

    function showAlert(message) {
      alertBox.textContent = message;
      alertBox.classList.remove('hidden');
      alertBox.classList.add('bg-red-500', 'shadow-md', 'opacity-100');
      
      // Hilang otomatis setelah 3 detik
      setTimeout(() => {
        alertBox.classList.add('opacity-0');
        setTimeout(() => {
          alertBox.classList.add('hidden');
          alertBox.classList.remove('bg-red-500', 'shadow-md', 'opacity-0');
        }, 500);
      }, 3000);
    }
  </script>

</body>
</html>
