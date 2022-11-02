@component('mail::message')
# Status change

Hey, your suggestion '{{$post->title}}' has been put into development. This means that your suggestion will be implemented soon.

@component('mail::button', ['url' => "http://127.0.0.1:8000/posts/$post->id"])
Go to the suggestion
@endcomponent

Thank you, <br>

@endcomponent

