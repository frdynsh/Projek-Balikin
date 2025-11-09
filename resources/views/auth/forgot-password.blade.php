@extends('layouts.guest')

@section('title', 'Forgot Password')

@section('content')
<div class="glass-card w-full max-w-md p-8 rounded-3xl shadow-2xl text-white backdrop-blur-xl">

    <h2 class="text-3xl font-bold text-center mb-6">Forgot Password</h2>

    <div class="mb-4 text-sm text-gray-300">
        Forgot your password? No problem. Just let us know your email address and we’ll email you a password reset link.
    </div>

    @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-400">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        <div class="mb-5 relative">
            <input id="email" type="email" name="email" placeholder="Email" required autofocus
                class="w-full p-4 rounded-xl bg-white/10 border border-white/20 text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-purple-400">
                @error('email')
                    <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                @enderror
        </div>

        <button type="submit"
            class="w-full py-3 rounded-full bg-purple-600 hover:bg-purple-700 font-semibold transition">
            Send Password Reset Link
        </button>
    </form>
</div>
@endsection
