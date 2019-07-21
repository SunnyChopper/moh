@component('mail::message')
# Introduction

Welcome to the Mind of Habit community!

By signing up, you're getting the following services for free:

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
