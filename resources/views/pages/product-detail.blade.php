@extends('layouts.app')

@section('title', 'Trang chủ')

@section('content')
@livewireScripts
@livewire('components.product-detail', ['id' => $id])

@endsection