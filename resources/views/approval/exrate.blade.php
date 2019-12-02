@extends('approval.layout')

@section('content')
    <div class="col-md-3 mt-4">
        <h4>Ex Cal</h4>
        <div>
            <label for="" class="mr-sm-2">USD:</label>
            <input id="usd_val" type="number" step=".01"  class=" mb-2 mr-sm-2">
        </div>
        <div>
            <label for="" class="mr-sm-2">VND:</label>
            <input type="number" id="vnd_val" step=".01" class=" mb-2 mr-sm-2">
        </div>
        <div>
            <label for="" class="mr-sm-2">KRW:</label>
            <input id="krw_val" type="number" step=".01" class=" mb-2 mr-sm-2">
        </div>
    </div>
    <div class="col-md-6 mt-4">
        <h3>Today Rate</h3>
        <table class="w-100">
            <thead>
                <td class="p-1">#</td>
                <td>Date</td>
                <td>USD/KRW</td>
                <td>VND/KRW</td>
                <td>USD/VND</td>
            </thead>
            <tbody>
                @foreach ($rates as $key => $rate)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{Carbon\Carbon::parse($rate->created_at)->format('Y-m-d')}}</td>
                        <td>{{number_format($rate->usd_krw,2)}}</td>
                        <td>{{number_format($rate->vnd_krw,2)}}</td>
                        <td>{{number_format($rate->usd_vnd,2)}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{$rates->links()}}
    </div>
    <div class="col-md-3 mt-4">
        <h3>ExRate Update</h3>
        <form action="/approval/exrate" method="post">
            @csrf
            <div>
                <label for="">USD/KRW:</label>
                <input type="number" class="ml-2" required step=".01" name="usd_krw">
            </div>
            <div>
                <label for="">VND/KRW:</label>
                <input type="number" class="ml-2" required step=".01" name="vnd_krw">
            </div>
            <div class="pt-1">
                <button class="btn btn-primary" type="submit">Add Today ExRate</button>
            </div>
        </form>
    </div>
@endsection
@section('js')
<script>
    $usd_krw = {{ $rates->first() ? $rates->first()->usd_krw : 1 }};
    $vnd_krw = {{ $rates->first() ? $rates->first()->vnd_krw : 1 }};
    $usd_vnd = {{ $rates->first() ? $rates->first()->usd_vnd : 1 }};
    $('#usd_val').bind('keyup mouseup', function(){
        $vnd = parseFloat($(this).val()) * $usd_vnd;
        $('#vnd_val').val($vnd);
        $krw = parseFloat($(this).val()) * $usd_krw;
        $('#krw_val').val($krw);
    });

    $('#krw_val').bind('keyup mouseup', function(){
        $usd = parseFloat($(this).val()) / $usd_krw;
        $('#usd_val').val($usd);
        $vnd = parseFloat($(this).val()) * 100 /$vnd_krw;
        $('#vnd_val').val($vnd);
    });

    $('#vnd_val').bind('keyup mouseup', function(){
        $usd = parseFloat($(this).val()) / $usd_vnd;
        $('#usd_val').val($usd);
        $krw = parseFloat($(this).val()) * $vnd_krw / 100;
        $('#krw_val').val($krw);
    });


</script>
@endsection