@extends('layouts.user')

@section('content')
    <livewire:user.pagedetailaction :id="$id" :locale="$locale" />
@endsection
