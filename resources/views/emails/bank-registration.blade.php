@component('mail::message')
# Registration Invitation

Hi, {{$bank->name}} We invite yout to join the blood for lives network. <br>
<br>
Click the following button to complete the registration

@component('mail::button', ['url' => $url])
Complete Registration
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
