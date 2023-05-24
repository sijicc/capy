@if($errors->any())
    <x-alert type="error">
        <ul class="list-disc ml-4">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </x-alert>
@endif

@if(session()->has('success'))
    <x-alert type="success">
        {{ session()->get('success') }}
    </x-alert>
@endif

@if(session()->has('error'))
    <x-alert type="error">
        {{ session()->get('error') }}
    </x-alert>
@endif

@if(session()->has('warning'))
    <x-alert type="warning">
        {{ session()->get('warning') }}
    </x-alert>
@endif

@if(session()->has('info'))
    <x-alert type="info">
        {{ session()->get('info') }}
    </x-alert>
@endif


