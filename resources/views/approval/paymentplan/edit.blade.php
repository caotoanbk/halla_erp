@extends('approval.layout')

@section('content')
    <edit-paymentplan :paymentplan_id="{{$id}}"></edit-paymentplan>
@endsection
@section('js')
<script src="/js/approval/paymentplan/edit.js"></script>
@endsection