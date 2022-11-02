@component('mail::message')
# Status change

Hey, your suggestion has been put into development. This means that your suggestion will be implemented soon.

@component('mail::button', ['url' => "http://127.0.0.1:8000/posts/$post->id"])
Suggestion
@endcomponent

Thanks,<br>
{{ 'Mana' }}
@endcomponent

