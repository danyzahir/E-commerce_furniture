<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - FinLoka</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-sky-100 flex items-center justify-center min-h-screen">

  <div class="bg-white p-8 rounded-2xl shadow-md w-full max-w-md">
    <h1 class="text-3xl font-bold text-center text-sky-700 mb-6">Masuk</h1>

    <!-- Alert sukses -->
    @if(session('success'))
      <div class="bg-green-100 text-green-700 p-3 mb-4 rounded">
        {{ session('success') }}
      </div>
    @endif

    <!-- Alert error -->
    @if(session('error'))
      <div class="bg-red-100 text-red-700 p-3 mb-4 rounded">
        {{ session('error') }}
      </div>
    @endif

    <form action="{{ route('login.post') }}" method="POST" class="space-y-5">
      @csrf

      <div>
        <label class="block text-gray-700 mb-2">Email</label>
        <input type="email" name="email" value="{{ old('email') }}" class="w-full border rounded-lg px-4 py-3 @error('email') border-red-500 @enderror" required>
        @error('email')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div>
        <label class="block text-gray-700 mb-2">Password</label>
        <input type="password" name="password" class="w-full border rounded-lg px-4 py-3 @error('password') border-red-500 @enderror" required>
        @error('password')
          <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
        @enderror
      </div>

      <button type="submit" class="w-full bg-sky-700 hover:bg-sky-800 text-white py-3 rounded-lg">
        Masuk
      </button>
    </form>

    <p class="text-center text-gray-600 mt-4">
      Belum punya akun? <a href="{{ route('register') }}" class="text-sky-700 font-semibold">Daftar</a>
    </p>
  </div>

</body>
</html>
