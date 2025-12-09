<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fadeInUp {
            animation: fadeInUp .8s ease-out;
        }

        @keyframes bounceIn {
            0% {
                transform: scale(.5);
                opacity: 0;
            }

            50% {
                transform: scale(1.1);
                opacity: 1;
            }

            100% {
                transform: scale(1);
            }
        }

        .animate-bounceIn {
            animation: bounceIn .7s ease-out;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex justify-center items-center">

    <div class="bg-white shadow-xl rounded-3xl w-[900px] flex overflow-hidden">

        <!-- LEFT PANEL (GAMBAR UTUH - TIDAK DIUBAH) -->
        <div class="w-1/2 p-0 animate-fadeInUp"
            style="
                background-image: url('{{ asset('img/1.jpeg') }}');
                background-size: cover;
                background-position: center;
            ">
        </div>

        <!-- RIGHT PANEL (PUTIH) -->
        <div class="w-1/2 p-12 flex flex-col justify-center bg-white animate-fadeInUp">

            <!-- Logo -->
            <div class="flex items-center justify-center pb-5">
                <img src="{{ asset('img/Logooo.png') }}" class="h-14 w-auto object-contain">
            </div>

            <h2 class="text-3xl font-bold mb-1 text-center text-[#4A2C16]">
                Welcome Back
            </h2>
            <p class="text-gray-600 mb-6 text-center">Please login to your account</p>

            {{-- ERROR --}}
            @if (session('error'))
                <div class="bg-red-100 text-red-700 border border-red-300 rounded-xl p-3 mb-4 text-sm">
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="bg-red-100 text-red-700 border border-red-300 rounded-xl p-3 mb-4 text-sm">
                    @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <!-- FORM -->
            <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <input type="email" name="email" placeholder="Email address"
                        class="w-full p-3 border border-gray-300 rounded-xl bg-gray-50 
                               focus:ring-[#8A5A32] focus:border-[#8A5A32] outline-none"
                        required>
                </div>

                <div class="relative">
                    <input type="password" name="password" id="password" placeholder="Password"
                        class="w-full p-3 border border-gray-300 rounded-xl bg-gray-50
                               focus:ring-[#8A5A32] focus:border-[#8A5A32] outline-none"
                        required>

                    <span id="togglePassword" class="absolute right-3 top-3 text-gray-500 cursor-pointer">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>

                <div class="text-right">
                    <a href="#" class="text-sm text-gray-500 hover:text-[#8A5A32] transition">Forgot password?</a>
                </div>

                <button type="submit"
                    class="w-full bg-[#8A5A32] hover:bg-[#6C4327] text-white py-3 rounded-xl font-semibold 
                           transition-all shadow-md animate-bounceIn">
                    Login
                </button>
            </form>

            <!-- SOCIAL -->
            <div class="mt-6 text-center text-gray-600">Or login with</div>

            <div class="flex justify-center gap-4 mt-3">
                <a href="{{ route('login.google') }}"
                    class="flex items-center gap-2 px-4 py-2 border rounded-xl bg-gray-50 hover:bg-gray-100 transition">
                    <img src="https://cdn-icons-png.flaticon.com/512/2991/2991148.png" class="w-5">
                    Login dengan Google
                </a>
            </div>


            <div class="text-center mt-6 text-gray-700">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-[#8A5A32] font-semibold">Signup</a>
            </div>
        </div>

    </div>

    <script>
        const togglePassword = document.getElementById("togglePassword");
        const passwordField = document.getElementById("password");

        togglePassword.addEventListener("click", function() {
            const type = passwordField.type === "password" ? "text" : "password";
            passwordField.type = type;
            this.innerHTML = `<i class="fas ${type === "password" ? "fa-eye" : "fa-eye-slash"}"></i>`;
        });
    </script>

</body>

</html>
