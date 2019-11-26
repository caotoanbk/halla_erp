@extends('approval.layout')
@section('content')
    <show-purchase-request purchase_id="{{$id}}" current_user_id = "{{Auth::user()->id}}"></show-purchase-request>
@endsection

@section('js')
<script src="/js/approval/purchase/show-purchase.js"></script>
@endsection