<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daftar - FinLoka</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        .no-bullets ul { list-style-type: none; padding-left: 0; margin: 0; }
        .no-bullets li { list-style: none; padding-left: 0; margin-left: 0; }

        @keyframes fadeInUp {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        .animate-fadeInUp { animation: fadeInUp .8s ease-out; }

        @keyframes bounceIn {
            0% { transform: scale(.5); opacity: 0; }
            50% { transform: scale(1.1); opacity: 1; }
            100% { transform: scale(1); }
        }
        .animate-bounceIn { animation: bounceIn .7s ease-out; }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex justify-center items-center">

    <div class="bg-white shadow-xl rounded-3xl w-[900px] flex overflow-hidden">

        <!-- LEFT (GAMBAR UTUH - TIDAK DIUBAH) -->
        <div class="w-1/2 animate-fadeInUp"
            style="
                background-image: url('{{ asset('img/1.jpeg') }}');
                background-size: cover;
                background-position: center;
            ">
        </div>

        <!-- RIGHT PANEL (PUTIH + COKELAT THEME) -->
        <div class="w-1/2 p-12 flex flex-col justify-center bg-white animate-fadeInUp">

            <div class="flex items-center justify-center pb-4">
                <img src="{{ asset('img/Logooo.png') }}" class="h-14 w-auto object-contain">
            </div>

            <h2 class="text-3xl font-bold mb-1 text-center text-[#4A2C16]">
                Create a New Account
            </h2>
            <p class="text-gray-600 mb-6 text-center">Please sign up to continue</p>

            @if ($errors->any())
                <div class="no-bullets bg-red-100 text-red-700 border border-red-300 rounded-xl p-3 text-sm mb-4">
                    <ul class="space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- FORM -->
            <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Full Name"
                        class="w-full p-3 border border-gray-300 rounded-xl bg-gray-50
                               focus:ring-[#8A5A32] focus:border-[#8A5A32] outline-none" required>
                </div>

                <div>
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Email address"
                        class="w-full p-3 border border-gray-300 rounded-xl bg-gray-50
                               focus:ring-[#8A5A32] focus:border-[#8A5A32] outline-none" required>
                </div>

                <div class="relative">
                    <input type="password" name="password" id="password"
                        placeholder="Password"
                        class="w-full p-3 border border-gray-300 rounded-xl bg-gray-50
                               focus:ring-[#8A5A32] focus:border-[#8A5A32] outline-none" required>

                    <span id="togglePassword"
                        class="absolute right-3 top-3 text-gray-500 cursor-pointer">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>

                <div class="relative">
                    <input type="password" name="password_confirmation"
                        id="password_confirmation"
                        placeholder="Confirm Password"
                        class="w-full p-3 border border-gray-300 rounded-xl bg-gray-50
                               focus:ring-[#8A5A32] focus:border-[#8A5A32] outline-none" required>

                    <span id="togglePasswordConfirm"
                        class="absolute right-3 top-3 text-gray-500 cursor-pointer">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>

                <button type="submit"
                    class="w-full bg-[#8A5A32] hover:bg-[#6F4628] text-white py-3 rounded-xl
                           font-semibold transition animate-bounceIn shadow">
                    Sign Up Now
                </button>
            </form>

            <div class="mt-6 text-center text-gray-700">
                Already have an account?
                <a href="{{ route('login') }}" class="text-[#8A5A32] font-semibold">Login</a>
            </div>

        </div>
    </div>

    <script>
        const togglePassword = document.getElementById("togglePassword");
        const passwordField = document.getElementById("password");

        togglePassword.addEventListener("click", () => {
            const type = passwordField.type === "password" ? "text" : "password";
            passwordField.type = type;
            togglePassword.innerHTML =
                `<i class="fas ${type === "password" ? "fa-eye" : "fa-eye-slash"}"></i>`;
        });

        const togglePasswordConfirm = document.getElementById("togglePasswordConfirm");
        const passwordConfirmField = document.getElementById("password_confirmation");

        togglePasswordConfirm.addEventListener("click", () => {
            const type = passwordConfirmField.type === "password" ? "text" : "password";
            passwordConfirmField.type = type;
            togglePasswordConfirm.innerHTML =
                `<i class="fas ${type === "password" ? "fa-eye" : "fa-eye-slash"}"></i>`;
        });
    </script>

</body>

</html>
