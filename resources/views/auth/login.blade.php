<x-auth.auth-layout title="Sign In" subtitle="Welcome back! Please enter your details.">
    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <x-auth.input
            type="email"
            name="email"
            label="Email Address"
            placeholder="developer@example.com"
            autocomplete="username"
            :required="true"
            :autofocus="true"
        />

        <x-auth.password-input
            name="password"
            label="Password"
            autocomplete="current-password"
            :required="true"
        />

        <div class="flex items-center justify-between">
            <x-auth.checkbox
                name="remember"
                label="Remember me"
                :checked="old('remember', false)"
            />

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-xs font-medium text-emerald-400 hover:text-emerald-300 font-mono focus:outline-none focus:underline">
                    Forgot password?
                </a>
            @endif
        </div>

        <x-auth.button>
            Sign In
        </x-auth.button>

        @if (Route::has('register'))
            <p class="text-center text-xs text-emerald-400/60 font-mono text-xs pt-2">
                Don't have an account?
                <a href="{{ route('register') }}" class="font-medium text-emerald-400 hover:text-emerald-300 font-mono underline underline-offset-4 focus:outline-none">
                    Create an account
                </a>
            </p>
        @endif
    </form>
</x-auth.auth-layout>
