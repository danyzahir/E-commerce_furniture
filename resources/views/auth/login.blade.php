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
            animation: fadeInUp 1s ease-out;
        }

    
        @keyframes bounceIn {
            0% {
                transform: scale(0.5);
                opacity: 0;
            }
            50% {
                transform: scale(1.2);
                opacity: 1;
            }
            100% {
                transform: scale(1);
            }
        }

        .animate-bounceIn {
            animation: bounceIn 0.8s ease-out;
        }

        /* Subtle hover effect for buttons */
        .cta-button:hover {
            background-color: #FF4A1A;
            transform: translateY(-5px);
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex justify-center items-center">

    <div class="bg-white shadow-xl rounded-3xl w-[900px] flex overflow-hidden">

        <!-- LEFT PANEL -->
        <div class="w-1/2 bg-[#1D4ED8] text-white p-12 flex flex-col justify-center relative animate-fadeInUp"
            style="background-image: url('{{ asset('img/login.jpg') }}'); background-size: cover; background-position: center;">
            <!-- Left panel content can remain empty or add content if needed -->
        </div>

        <!-- RIGHT PANEL -->
        <div class="w-1/2 p-12 flex flex-col justify-center animate-fadeInUp">

            <!-- Logo -->
            <div class="flex items-center justify-center space-x-3 select-none pb-4">
                <img src="{{ asset('img/Logo1.png') }}" alt="FinLoka Logo" class="h-12 w-auto object-contain drop-shadow">
            </div>

            <h2 class="text-3xl font-bold mb-2 text-center">Welcome Back</h2>
            <p class="text-gray-500 mb-6 text-center">Please login to your account</p>

            <!-- FORM -->
            <form action="{{ route('login.post') }}" method="POST" class="space-y-4">
                @csrf <!-- CSRF Token -->

                <div>
                    <input type="email" name="email" placeholder="Email address"
                        class="w-full p-3 border border-gray-300 rounded-xl focus:ring-[#1D4ED8]" required>
                </div>

                <div class="relative">
                    <input type="password" name="password" id="password" placeholder="Password"
                        class="w-full p-3 border border-gray-300 rounded-xl focus:ring-[#1D4ED8]" required>

                    <!-- Eye Icon for password visibility toggle -->
                    <span id="togglePassword" class="absolute right-3 top-3 text-gray-400 cursor-pointer">
                        <i class="fas fa-eye"></i>
                    </span>
                </div>

                <div class="text-right">
                    <a href="#" class="text-sm text-gray-500 hover:underline">Forgot password?</a>
                </div>

                <button type="submit"
                    class="w-full bg-[#1D4ED8] hover:bg-[#2563EB] text-white py-3 rounded-xl font-semibold transition-all animate-bounceIn">
                    Login
                </button>
            </form>

            <div class="mt-6 text-center text-gray-600">Or Login with</div>

            <!-- SOCIAL BUTTONS -->
            <div class="flex justify-center gap-4 mt-3">
                <button class="flex items-center gap-2 px-4 py-2 border rounded-xl">
                    <img src="https://cdn-icons-png.flaticon.com/512/2991/2991148.png" class="w-5">
                    Google
                </button>
            </div>

            <div class="text-center mt-6 text-gray-500">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-[#1D4ED8] font-semibold">Signup</a>
            </div>

        </div>
    </div>

    <!-- Show/Hide Password JS -->
    <script>
        const togglePassword = document.getElementById("togglePassword");
        const passwordField = document.getElementById("password");

        togglePassword.addEventListener("click", function () {
            // Toggle the password visibility
            const type = passwordField.type === "password" ? "text" : "password";
            passwordField.type = type;

            // Toggle the eye icon
            const icon = type === "password" ? "fa-eye" : "fa-eye-slash";
            this.innerHTML = `<i class="fas ${icon}"></i>`;
        });
    </script>

</body>

</html>
