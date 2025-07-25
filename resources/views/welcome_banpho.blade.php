@extends('layouts.banpho')

@section('title', 'เทศบาลตำบลบ้านโพธิ์')

@section('content')
    <x-header />
    <x-hero-section />
    <x-management-section />
    <x-executive-board :staffs="$staffs" />
    <x-content-sections />
    <x-announcement-section />
    <x-activities-news-section />
    <x-services-facebook-section />
    <x-poll-section />
    <x-footer />
@endsection