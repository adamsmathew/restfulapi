
    <x-mail::message>
Hello {{ $user->name }},

You changed your email, so we need to verify this new address. Please use the buton below:

<x-mail::button :url="route('verify', $user->verification_token)">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
