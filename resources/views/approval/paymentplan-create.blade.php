@extends('approval.layout')
@section('content')
    <div class="col-md-8 offset-md-2 pt-4">
        @if (session('status'))
            <div class="alert alert-success">{{session('status')}}</div>
        @endif
        <form method="post" action="/approval/paymentplan"><h3><a href="#" onclick="$(this).closest('form').submit();"><i class="fas fa-plus"></i>&nbsp; Create new payment plan</a></h3><form>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date create</th>
                    <th>Date Payment</th>
                    <th>Creator</th>
                    <th>Docno</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $index => $p)
                    <tr>
                        <td>{{$index + 1}}</td>
                        <td>{{Carbon\Carbon::parse($p->created_at)->format('Y-m-d')}}</td>
                        <td>{{$p->date_payment}}</td>
                        <td>{{$p->user_name}}</td>
                        <td><a href="/approval/paymentplan/edit/{{$p->id}}">{{$p->docno}}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$payments->links()}}
    </div>
@endsection
@section('js')
<script>
    $('.alert-success').delay(2000).slideUp();
</script>
@endsection