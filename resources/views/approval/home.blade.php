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
    <strong><a href="{{route('approval.payment_dashboard', ['q' => 'total_payment_receive'])}}">Payment Plan Receive: {{$total_payment_receive->count()}}</a></strong>
      <ul class="list-group" style="margin-bottom:5px;">
                  <li class="list-group-item @if($payment_waiting_your_app->count() > 0) bg-warning @endif" style="padding:2px;"><a href="{{route('approval.payment_dashboard', ['q' => 'waiting_your_app'])}}">Waiting Your Approval: {{$payment_waiting_your_app->count()}}</a></li>
        <li class="list-group-item" style="padding:2px"><a href="{{route('approval.payment_dashboard', ['q' => 'waiting_final_app'])}}">Waiting Final Approval : {{$payment_waiting_final_app->count()}}</a></li>
        
        <li class="list-group-item" style="padding:2px"><a href="{{route('approval.payment_dashboard', ['q' => 'your_payments'])}}">Your Payment Plan : {{$your_payments->count()}}</a></li>
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
      <strong><i class="fas fa-search"></i><a href="/approval/search"> Search</a></strong>
    </li>
    <li class="list-group-item" style="padding:5px;"> 
      <strong><span class="glyphicon glyphicon-list-alt"></span><a href="#"> Report</a></strong>
    </li>
    <li class="list-group-item" style="padding:5px;"> 
      <strong><span class="glyphicon glyphicon-list-alt"></span><a href=""> Total: {{Carbon\Carbon::now()->format('d-M-Y H:i')}}</a></strong>

      <ul class="list-group" style="margin-bottom:5px;">
        <li class="list-group-item" style="padding:2px">Done : {{$total_done}}</li>
        <li class="list-group-item" style="padding:2px">Waiting : {{$total_waiting}}</li>
        <li class="list-group-item" style="padding:2px"><a href="?status=4&amp;o=allreject"> Reject  : {{$total_reject}}</a></li>
      </ul>
    </li>
    <li class="list-group-item" style="padding:5px;"> 
        <strong><i class="fas fa-download"></i><a href="download.php"> Download</a></strong>
      </li>
        <li class="list-group-item" style="padding:5px;"> 
        <strong><i class="fas fa-download"></i><a href="sumaryview.php"> Sumary View</a></strong>
      </li>
            
      <li class="list-group-item" style="padding:5px;"> 
      <strong><i class="fas fa-globe"></i><a href="/approval/exrate"> ExRate</a></strong>
    </li>
  </ul>
</div>
<div class="col-md-10 mt-3">
  <h4 class="bg-primary p-1 mb-0 text-center">Purchase Request</h4>
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
          
          @if($item->isSubmitted)
          <td class="text-center @if($item->isRejected()) bg-danger @elseif($item->getNumberOfLinePassed() == 1) bg-warning @endif">@if($item->isRejected())<i class="fas fa-times"></i> @elseif($item->getNumberOfLinePassed() == 1) <i class="fas fa-sync-alt"></i>@else<i class="fas fa-check"></i>@endif</td>
          <td>
          <?php
            $currentValue = $item->getNumberOfLinePassed()/$item->lines()->count() * 100;
          ?>
          <div class="progress">
              <div class="progress-bar progress-bar-striped @if($item->isApproved()) bg-success @elseif($item->isRejected()) bg-danger @else bg-orange @endif" role="progressbar" style="width: {{$currentValue}}%" aria-valuenow="{{$currentValue}}" aria-valuemin="0" aria-valuemax="100">{{$item->getNumberOfLinePassed()}}/{{$item->lines()->count()}}</div>
            </div>
          </td>
          @else
          <td></td>
          <td></td>
          @endif
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