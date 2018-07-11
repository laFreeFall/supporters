@extends('layouts.app')

@section('content')
<div class="columns is-centered">
    <div class="column is-4">
        <h1 class="title has-text-centered">Setting up your profile data</h1>

            @component('profile._form', ['profile' => $blankProfile])
                @slot('form')
                    <form method="POST" action="{{ route('profile.store') }}" enctype="multipart/form-data">
                @endslot
                @slot('submit')
                    <div class="control">
                        <button type="submit" class="button is-link">Save profile</button>
                    </div>
                @endslot
            @endcomponent
    </div>
</div>
{{-- Just don't want to use Vue here just for the displaying chosen file name --}}
{{--@push('scripts')--}}
    {{--<script>--}}
        {{--const avatar = document.getElementById('avatar')--}}
        {{--avatar.onchange = () => {--}}
            {{--if(avatar.files.length) {--}}
                {{--document.getElementById('avatar-name').innerHTML = avatar.files[0].name--}}
            {{--}--}}
        {{--}--}}
    {{--</script>--}}
{{--@endpush--}}
@endsection
