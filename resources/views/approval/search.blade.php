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
        <strong><i class="fas fa-list-alt"></i><a href="#"> Report</a></strong>
      </li>
      <li class="list-group-item" style="padding:5px;"> 
        <strong><i class="fas fa-list-alt"></i><a href=""> Total: {{Carbon\Carbon::now()->format('d-M-Y H:i')}}</a></strong>
  
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
    <table class="mytable w-100 table-striped" id="mytable">
      <thead>
          <tr>
              <th>#</th>
              <th>범주/ Category</th>
              <th>그룹/ Group</th>
              <th style="width: 37%;">표제/ Title</th>
              <th style="width: 8%;">문서 번호/ Doc No.</th>
              <th>창조자/ Creator</th>
              <th>날짜/ Date</th>
              <th style="width: 6%;">승인 된 날짜/ Approved Date</th>
              <th>양/ Amount</th>
              <th>통화/ Currency</th>
              <th>앱/ App</th>
              <th>지위/ Status</th>
          </tr>
      </thead>
  
      <tbody>

      </tbody>
    </table>
  
  </div>
@endsection

@section('js')
    <script>
    $(function() {

        $('#mytable').DataTable({
            "processing": true,
            "serverSide": true,
            "method": 'get',
            "paging": true,
            "pageLength": 10,
            "ajax": '{!! route('approval.purchase.data') !!}',
            "columns": [
                {data: 'id', name: 'id'},
                {data: 'category', name: 'category'},
                {data: 'group_name', name: 'group_name'},
                {data: 'title', name: 'title'},
                {data: 'docNumber', name: 'docNumber'},
                {data: 'user_name', name: 'user_name'},
                {data: 'created_at', name: 'created_at'},
                {data: 'approved_date', name: 'approved_date'},
                {data: 'total_amount', name: 'total_amount'},
                {data: 'currency', name: 'currency'},
                {data: 'app', name: 'app'},
                {data: 'status', name: 'status'}
            ]
        });
    });
    </script>
@endsection