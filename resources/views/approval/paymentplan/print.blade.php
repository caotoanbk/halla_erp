@extends('approval.layout')

@section('content')
    <print-paymentplan :paymentplan_id="{{$id}}" :current_user_id="{{auth()->id()}}"></print-paymentplan>
@endsection
@section('js')
<script src="/js/approval/paymentplan/print.js"></script>
<script>
    setTimeout(function(){
        window.print()
    }, 2000)
</script>
@endsection