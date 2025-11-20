<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daftar - FinLoka</title>

    <!-- TAILWIND & FONT AWESOME -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        /* Animation for fading in */
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

        /* Animation for button */
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
            <!-- Content can stay empty or add additional text here if needed -->
        </div>

        <!-- RIGHT PANEL -->
        <div class="w-1/2 p-12 flex flex-col justify-center animate-fadeInUp">

            <!-- Logo -->
            <div class="flex items-center justify-center space-x-3 select-none pb-4">
                <img src="{{ asset('img/Logo1.png') }}" alt="FinLoka Logo" class="h-12 w-auto object-contain drop-shadow">
            </div>
            <h2 class="text-3xl font-bold mb-2 text-center">Create a New Account</h2>
            <p class="text-gray-500 mb-6 text-center">Please sign up to create a new account</p>

            <!-- FORM -->
            <form action="{{ route('register.post') }}" method="POST" class="space-y-4">
                @csrf <!-- CSRF Token -->

                <div>
                    <input type="text" name="name" placeholder="Full Name"
                        class="w-full p-3 border border-gray-300 rounded-xl focus:ring-[#1D4ED8]" required>
                </div>

                <div>
                    <input type="email" name="email" placeholder="Email address"
                        class="w-full p-3 border border-gray-300 rounded-xl focus:ring-[#1D4ED8]" required>
                </div>

                <div class="relative">
                    <input type="password" name="password" id="password" placeholder="Password"
                        class="w-full p-3 border border-gray-300 rounded-xl focus:ring-[#1D4ED8]" required>

                    <!-- Eye Icon -->
                    <span id="togglePassword" class="absolute right-3 top-3 text-gray-400 cursor-pointer">
                        <i class="fas fa-eye"></i> <!-- Eye icon for showing password -->
                    </span>
                </div>

                <div class="relative">
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm Password"
                        class="w-full p-3 border border-gray-300 rounded-xl focus:ring-[#1D4ED8]" required>
                </div>

                <button type="submit"
                    class="w-full bg-[#1D4ED8] hover:bg-[#2563EB] text-white py-3 rounded-xl font-semibold transition transform hover:scale-105 animate-bounceIn">
                    Sign Up Now
                </button>
            </form>

            <div class="mt-6 text-center text-gray-600">Already have an account?
                <a href="{{ route('login') }}" class="text-[#1D4ED8] font-semibold">Login </a>
            </div>

        </div>
    </div>

    <!-- JavaScript for Show/Hide Password -->
    <script>
        const togglePassword = document.getElementById("togglePassword");
        const passwordField = document.getElementById("password");

        togglePassword.addEventListener("click", function () {
            // Toggle the type attribute
            const type = passwordField.type === "password" ? "text" : "password";
            passwordField.type = type;

            // Toggle the eye icon (show/hide password)
            const icon = type === "password" ? "fa-eye" : "fa-eye-slash";
            this.innerHTML = `<i class="fas ${icon}"></i>`;
        });
    </script>

</body>

</html>
