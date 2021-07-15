@extends('layouts.dashboard')
@section('sidebar')
    @include('dashboard.owner.sidebar')
@endsection
@section('hierarchy')
    <x-breadcrumb-item title="داشبورد" route="dashboard.owner.index" />
    <x-breadcrumb-item title="مشاهده شرکت" route="dashboard.owner.companies.show" />
@endsection
@section('content')
    <div class="container">
        <x-session-alerts></x-session-alerts>
        <x-card type="info">
            <x-card-header>شرکت {{ $company->name }}</x-card-header>

            <x-card-footer>
                @if($company->type == 'product')
                    <a href="{{ route('dashboard.owner.products.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> افزودن محصول</a>
                @else
                    <a href="{{ route('dashboard.owner.services.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> افزودن سرویس</a>
                @endif
            </x-card-footer>
        </x-card>
    </div>
@endsection
