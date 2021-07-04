@component('mail::message')
# Registration Invitation

Hi, {{$bank->name}} We invite yout to 


and the component is 

@component('mail::button', ['url' => $url])
Complete Registration
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
