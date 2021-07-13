@if(Session::has('success'))
    <x-alert type="success">{{ Session::get('success') }}</x-alert>
@endif
@if(Session::has('error'))
    <x-alert type="danger">{{ Session::get('error') }}</x-alert>
@endif
