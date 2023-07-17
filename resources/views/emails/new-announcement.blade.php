@component("mail::message")
    # {{ $announcement->title }}

    {{ $announcement->content }}

    @component('mail::button', ['url' => route('announcements.show', $announcement)])
        Click here to view the announcement
    @endcomponent

    Thanks,
    
    {{ config("app.name") }}
@endcomponent
