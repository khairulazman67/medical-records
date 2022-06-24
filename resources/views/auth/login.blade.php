<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Login</title>
</head>
<body >
    <div class="container mx-auto">
        <!-- tulisan atas -->
        <div class="mt-16">
            <div class="flex justify-center text-white font-bold text-4xl bg-secondary-900 rounded-3xl mx-28 mb-10 py-4">
                Sistem Pencatatan Rekam Medis Puskesmas Nibong
            </div>
        </div>
        <div class="flex mx-44 relative">
            <div class="mt-20 text-primary-900">
                <h1 class="text-[40px] font-bold mb-5">Login</h1>
                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                        <div>
                            <div class="text-xl">
                                <label for="fname" class="font-semibold  text-xl">Email/Nama :</label><br>
                                <input type="text"  id="login" name="login" class="border-2 rounded-lg border-primary-800 hover:border-primary-900 h-10 w-96 p-5"><br>
                            </div>
                            <div class="mt-4  text-xl">
                                <label for="fname" class="font-semibold ">Password :</label><br>
                                <input type="password" id="password" name="password" class="border-2 rounded-lg border-primary-800 hover:border-primary-900 h-10 w-96 p-5" required autocomplete="current-password"><br>
                            </div>
                            <button class="bg-secondary-900 rounded-xl py-3 mt-4 px-11 text-white font-bold hover:bg-primary-900"  type="submit" >
                                Login
                            </button>
                        </div>

                        <div class="absolute inset-y-0 -right-5">
                            <img src="{{asset('img/ILUS.png') }}" alt="" class="mt-11 ml-8 w-[550px]">
                        </div>
                </form>
            </div>

        </div>
    </div>
</body>
</html>
