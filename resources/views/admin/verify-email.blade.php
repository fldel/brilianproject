<x-guest-layout>
    <div class="mb-4 text-lg text-gray-600">
        {{ __('Thanks for signing up as Admin! Please verify your email by clicking the link we sent.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 text-green-600">
            {{ __('A new verification link has been sent to your email.') }}
        </div>
    @endif

    <div class="flex items-center justify-between mt-4">
        <form method="POST" action="{{ route('admin.verification.send') }}">
            @csrf
            <x-pixel-button>{{ __('Resend Verification') }}</x-pixel-button>
        </form>

        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button type="submit" class="text-sm underline">Logout</button>
        </form>
    </div>
</x-guest-layout>
