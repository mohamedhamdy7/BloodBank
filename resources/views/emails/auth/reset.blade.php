@component('mail::message')
# Introduction

ResetPassword

@component('mail::button', ['url' => 'http://youtube.com','color'=>'success'])
    youtube
@endcomponent
<p>your reset password:{{$client->pin_code}}</p>
Thanks,{{$client->name}}}<br>
{{ config('app.name') }}
@endcomponent
