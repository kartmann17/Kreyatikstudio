<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>{{ __('Reset Password') }} - {{ config('app.name', 'Kréyatik Studio') }}</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 relative">
    <!-- Background Image -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('images/compose.png') }}');">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-900/80 to-indigo-900/80"></div>
    </div>
    
    <!-- Content -->
    <div class="relative z-10 max-w-md w-full space-y-8">
        <div class="text-center">
            <img src="{{ asset('images/Studiosansfond.png') }}" alt="Kréyatik Studio" class="mx-auto h-16 w-auto">
            <h2 class="mt-6 text-3xl font-extrabold text-black">
                Nouveau mot de passe
            </h2>
            <p class="mt-2 text-sm text-gray-800">
                Définissez votre nouveau mot de passe
            </p>
        </div>
        
        <div class="bg-white rounded-xl shadow-2xl p-8">
            <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
                @csrf
                
                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $token }}">
                
                <!-- Email Address -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-envelope mr-2 text-gray-400"></i>
                        {{ __('Email') }}
                    </label>
                    <div class="mt-1">
                        <input id="email" name="email" type="email" autocomplete="username" required 
                               value="{{ old('email', $email) }}"
                               class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:z-10 @error('email') border-red-300 @enderror" 
                               placeholder="votre@email.com">
                    </div>
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-lock mr-2 text-gray-400"></i>
                        {{ __('Password') }}
                    </label>
                    <div class="mt-1">
                        <input id="password" name="password" type="password" autocomplete="new-password" required 
                               class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:z-10 @error('password') border-red-300 @enderror" 
                               placeholder="Nouveau mot de passe">
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                        <i class="fas fa-lock mr-2 text-gray-400"></i>
                        {{ __('Confirm Password') }}
                    </label>
                    <div class="mt-1">
                        <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required 
                               class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent focus:z-10" 
                               placeholder="Confirmez le mot de passe">
                    </div>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-lg text-white bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all duration-200">
                        <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                            <i class="fas fa-key text-blue-200 group-hover:text-blue-100"></i>
                        </span>
                        {{ __('Reset Password') }}
                    </button>
                </div>
            </form>
        </div>
        
        <div class="text-center">
            <p class="text-sm text-gray-800">
                &copy; {{ date('Y') }} Kréyatik Studio. Tous droits réservés.
            </p>
        </div>
    </div>
    </div>
</body>
</html> 