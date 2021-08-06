@component('mail::message')
# New Device Registerd

New Device Registerd With company.

<!-- @component('mail::button', ['url' => ''])
    Button Text
@endcomponent -->

@component('mail::panel')
    
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent