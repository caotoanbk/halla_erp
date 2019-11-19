@extends('approval.layout')
@section('content')
    <update-purchase-request purchase_id="{{$id}}"></update-purchase-request>
@endsection

@section('js')
<script src="/js/approval/purchase/update-purchase.js"></script>
@endsection