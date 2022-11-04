@extends('admin.layout.master')
@section('HomeName','الرئيسية')
@section('contentheder','الرئيسية')
@section('contentheaderlink')
<a href="{{ route('admin.dashboard') }}">الرئيسية</a>
@endsection
@section('contenthedareactirv','عرض')

@section('content')

    <div class="row" style="background-image: url({{ asset('public_asset/images/dash.jpg') }});background-size:cover;background-repeate:no-repeate;min-height:600px"></div>

@endsection

