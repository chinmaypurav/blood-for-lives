@component('mail::message')
# Urgent Requirement of Blood

Hi, We require blood for 
@foreach ($groups as $group)
    {{$group . ', '}}
@endforeach

and the component is {{$component}}

@component('mail::button', ['url' => ''])
Donate
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
