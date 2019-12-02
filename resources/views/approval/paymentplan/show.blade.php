@extends('approval.layout')

@section('content')
    <show-paymentplan :paymentplan_id="{{$id}}" :current_user_id="{{auth()->id()}}"></show-paymentplan>
@endsection
@section('js')
<script src="/js/approval/paymentplan/show.js"></script>
@endsection