@extends('approval.layout')

@section('content')
<div class="row" style="padding:20px;">
  <div class="col-md-2">
    <ul class="list-group">
     <li class="list-group-item" style="padding:5px;"> 
      <strong><a href="index.php">Total receive : 136</a></strong>
        <ul class="list-group" style="margin-bottom:5px;">
          <!-- <li class="list-group-item" style='padding:2px'><a href="index.php?status=2">Done : 12</a></li> -->
            <li class="list-group-item" style="padding:2px; <br />
<b>Notice</b>:  Undefined variable: style in <b>D:\XAMPP\htdocs\approval\views\sideinfor.php</b> on line <b>61</b><br />
"><a href="index.php?status=1&amp;o=wait">Waiting Your Approval: 0</a></li>
          <li class="list-group-item" style="padding:2px"><a href="index.php?yourq">Your Question : 1</a></li>
          <li class="list-group-item" style="padding:2px"><a href="index.php?status=1&amp;o=next">Waiting Final Approval : 12</a></li>
          <li class="list-group-item" style="padding:2px"><a href="index.php?status=4&amp;o=reject">Your Rejected list</a></li>
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
      <strong><a href="yrq.php">Total send request : 10</a></strong>
        <ul class="list-group" style="margin-bottom:5px;">
          <li class="list-group-item" style="padding:2px"><a href="yrq.php?status=2">Done : 7</a></li>
          <li class="list-group-item" style="padding:2px"><a href="yrq.php?status=1">Waiting : 0</a></li>
          <li class="list-group-item" style="padding:2px"><a href="yrq.php?status=4">Reject  : 3</a></li>
        </ul>
      </li>
      
      <li class="list-group-item" style="padding:5px;"> 
        <strong><span class="glyphicon glyphicon-search"></span><a href="searchpage.php"> Search</a></strong>
      </li>
      <li class="list-group-item" style="padding:5px;"> 
        <strong><span class="glyphicon glyphicon-list-alt"></span><a href="report.php"> Report</a></strong>
      </li>
      <li class="list-group-item" style="padding:5px;"> 
        <strong><span class="glyphicon glyphicon-list-alt"></span><a href=""> Total: 08-Nov 13:25</a></strong>

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
        <strong><span class="glyphicon glyphicon-globe"></span><a href="ExRate.php"> ExRate</a></strong>
      </li>
    </ul>
  </div>
<div class="col-md-10">
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
        <tr>
        <td>1</td>
        <td>Purchase</td>
        <td>Consumable - Manufacturing</td>
        <td style="text-align:left;"><a href="view.php?appid=1629">Purchase Repuest Push-botton for electric box &amp; DC machine, Sensor for Tapping machine &amp; DC machine, Air cylinder replace  for door of CNC machine</a></td>
        <td>HEV-1808-0158</td>
        <td>Hue NT</td>
        <td>22-Aug</td>
                <td>31 Aug 08:16</td>
        <td>53,502,790</td>
        <td style="color:red">VND</td>
        
        <td><span class="glyphicon glyphicon-check"></span></td>        <td>
        <div class="progress progress-striped" style="margin-bottom:0px;">
            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 100%;color:black;">
            7/7            </div>
        </div>
        </td>
        </tr>
    </tbody>
</table>

  <!-- Seting Page -->
  <div class="col-md-12">
    <ul class="pagination">
      <li><a href="">Page</a></li>
      <li class="active"><a href="index.php?page=1">1</a></li>
      <li class=""><a href="index.php?page=2">2</a></li>
      <li class=""><a href="index.php?page=3">3</a></li>
      <li class=""><a href="index.php?page=4">4</a></li>
      <li class=""><a href="index.php?page=5">5</a></li>
      <li class=""><a href="index.php?page=6">6</a></li>
      <li class=""><a href="index.php?page=7">7</a></li>
      <li class=""><a href="index.php?page=8">8</a></li>
      <li class=""><a href="index.php?page=9">9</a></li>
      <li class=""><a href="index.php?page=10">10</a></li>
    </ul>
  </div>
</div>
</div>
@endsection