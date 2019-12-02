@extends('approval.layout')

@section('content')
<div class="col-md-2 mt-3">
  <ul class="list-group">
    <li class="list-group-item" style="padding:5px;"> 
    <strong><a href="{{route('approval.dashboard', ['q' => 'total_receive'])}}">Total receive : {{$total_user_receive->count()}}</a></strong>
      <ul class="list-group" style="margin-bottom:5px;">
        <!-- <li class="list-group-item" style='padding:2px'><a href="index.php?status=2">Done : 12</a></li> -->
          <li class="list-group-item @if($waiting_your_app->count() > 0) bg-warning @endif" style="padding:2px;"><a href="{{route('approval.dashboard', ['q' => 'waiting_your_app'])}}">Waiting Your Approval: {{$waiting_your_app->count()}}</a></li>
        <li class="list-group-item" style="padding:2px"><a href="{{route('approval.dashboard', ['q' => 'waiting_final_app'])}}">Waiting Final Approval : {{$waiting_final_app->count()}}</a></li>
        <li class="list-group-item" style="padding:2px"><a href="{{route('approval.dashboard', ['q' => 'your_rejected_list'])}}">Your Rejected list : {{$your_rejected_list->count()}}</a></li>
      </ul>

    </li>
    <li class="list-group-item" style="padding:5px;"> 
    <strong><a href="paymentlist.php">Payment Plan : 0</a></strong>
      <ul class="list-group" style="margin-bottom:5px;">
                  <li class="list-group-item" style="padding:2px;"><a href="paymentlist.php?o=wait">Waiting Your Approval: 0</a></li>
        <li class="list-group-item" style="padding:2px"><a href="paymentlist.php?o=next">Waiting Final Approval : 0</a></li>
        
        <li class="list-group-item" style="padding:2px"><a href="paymentlist.php?your">Your Payment Plan : 0</a></li>
      </ul>


    </li>
    <li class="list-group-item" style="padding:5px;"> 
    <strong><a href="{{route('approval.dashboard', ['q' => 'app_sent'])}}">Total send request : {{$total_send_request->count()}}</a></strong>
      <ul class="list-group" style="margin-bottom:5px;">
        <li class="list-group-item" style="padding:2px"><a href="{{route('approval.dashboard', ['q' => 'app_sent_done'])}}">Done : {{$total_send_done->count()}}</a></li>
        <li class="list-group-item" style="padding:2px"><a href="{{route('approval.dashboard', ['q' => 'app_sent_waiting'])}}">Waiting : {{$total_send_waiting->count()}}</a></li>
        <li class="list-group-item" style="padding:2px"><a href="{{route('approval.dashboard', ['q' => 'app_sent_reject'])}}">Reject  : {{$total_send_reject->count()}}</a></li>
      </ul>
    </li>
    <li class="list-group-item" style="padding: 5px"><strong><a href="{{route('approval.dashboard', ['q' => 'not_submitted'])}}">Not submitted: {{count($not_submitted_reqs)}}</a></strong></li>
    
    <li class="list-group-item" style="padding:5px;"> 
      <strong><span class="glyphicon glyphicon-search"></span><a href="searchpage.php"> Search</a></strong>
    </li>
    <li class="list-group-item" style="padding:5px;"> 
      <strong><span class="glyphicon glyphicon-list-alt"></span><a href="report.php"> Report</a></strong>
    </li>
    <li class="list-group-item" style="padding:5px;"> 
      <strong><span class="glyphicon glyphicon-list-alt"></span><a href=""> Total: {{Carbon\Carbon::now()->format('d-M-Y H:i')}}</a></strong>

      <ul class="list-group" style="margin-bottom:5px;">
        <li class="list-group-item" style="padding:2px">Done : </li>
        <li class="list-group-item" style="padding:2px">Waiting : </li>
        <li class="list-group-item" style="padding:2px"><a href="?status=4&amp;o=allreject"> Reject  : 542 </a></li>
      </ul>
    </li>
    <li class="list-group-item" style="padding:5px;"> 
        <strong><span class="glyphicon glyphicon-download-alt"></span><a href="download.php"> Download</a></strong>
      </li>
        <li class="list-group-item" style="padding:5px;"> 
        <strong><span class="glyphicon glyphicon-download-alt"></span><a href="sumaryview.php"> Sumary View</a></strong>
      </li>
            
      <li class="list-group-item" style="padding:5px;"> 
      <strong><span class="glyphicon glyphicon-globe"></span><a href="/approval/exrate"> ExRate</a></strong>
    </li>
  </ul>
</div>
<div class="col-md-10 mt-3">
  <table class="table table-striped" id="mytable">
    <thead>
        <tr>
            <th>#</th>
            <th>범주/ Category</th>
            <th>그룹/ Group</th>
            <th>표제/ Title</th>
            <th>문서 번호/ Doc No.</th>
            <th>창조자/ Creator</th>
            <th>날짜/ Date</th>
            <th>승인 된 날짜/ Approved Date</th>
            <th>양/ Amount</th>
            <th>통화/ Currency</th>
            <th>앱/ App</th>
            <th>지위/ Status</th>
        </tr>
    </thead>

    <tbody>
      @if($items->count() > 0)
      @foreach ($items as $index => $item)        
        <tr>
          <td>{{$index+1}}</td>
          <td>Purchase</td>
          <td>{{$item->cashgroup_name}}</td>
          <td style="text-align:left; max-width: 50%;">
            @if($item->isSubmitted)
            <a href="/approval/purchase/show/{{$item->id}}">{{$item->title}}</a>
            @else
            <a href="/approval/purchase/update/{{$item->id}}">{{$item->title}}</a>
            @endif
          </td>
          <td class="text-center">{{$item->docNumber}}</td>
          <td class="text-center">{{$item->user_name}}</td>
          <td class="text-center">{{Carbon\Carbon::parse($item->created_at)->format('d-M')}}</td>
          <td>&nbsp;</td>
          <td class="text-right">{{number_format($item->total_amount, 0)}}</td>
          <td class="text-center">VND</td>
          
          <td class="text-center"><i class="fas fa-check"></i></td>        <td>
          <div class="progress progress-striped" style="margin-bottom:0px;">
              <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%;color:black;">
              7/7            </div>
          </div>
          </td>
        </tr>
      @endforeach
      @else
        <tr>
          <td colspan="12" class="text-center">No items found</td>
        </tr>
      @endif
    </tbody>
  </table>

</div>
@endsection