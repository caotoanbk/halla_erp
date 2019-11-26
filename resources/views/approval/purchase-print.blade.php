<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>INTERNAL APPROVAL</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <style>
        html, body {
            width: 210mm;
            margin: 0 auto;
            border: 1px solid lightgrey;
        }
        #counter{
           /* counter-reset: headings;
           counter-reset: pages; */
        }
        /* table {
            table-layout: fixed;
        } */
        table td,th{
          border:1px solid black;
        }
      footer {
        font-size: 9px;
        color: #f00;
        text-align: center;
        
        }
      td,th{
        text-align:center; vertical-align:middle;
      }
      td{
        word-wrap: break-word;
      }
      td.last{
        white-space: nowrap;
      }

        @page {
        size: A4;
        /* counter-increment: page; */
        margin: 11mm 10mm 10mm 10mm;
        /* margin-bottom: 40px; */
        /* counter-increment: page; */
        @bottom-right {
          content: counter(page) " of " counter(pages);
        }
        @page :left: header {
        content: "Page " decimal(pageno), , first(chapter);
        font-variant: small-caps
        }
        @page :right :header {
            content: last(section), , "Page " decimal(pageno);
            font-variant: small-caps
        }
        }
        /* @page:first { counter-reset: page 9 } */
        @media print {
        footer {
            position: fixed;
            bottom: 0;
            counter-increment: pages;
        }
        .pagenum:after {
          counter-increment: pages;
        }
        .pagenum:before { 
          counter-increment: headings;
          /* content: "Page " counter(headings) " of " counter(pages);  */
        }
        .content-block, p {
            page-break-inside: avoid;
        }
        html, body {
            width: 210mm;
            height: 297mm;
            border: none;
        }
        #noprint{
          display:none;
        }
        }

        .bg-success{
          background-color: green;
          color: #000;
        }
        .bg-danger{
          background-color: red;
          color: #000;
        }
        .bg-warning{
          background-color: orange;
        }
    </style>
</head>
<body class="bg-white" onload="window.print()">
  <div>
    <div style="height:125px;">
        <div style="width:30%; text-align:center; float:left;" id="counter">
            <p style="text-align:center;">
            <img src="/img/logo.png" alt="" style="width:120px">
            </p>
            <p>HALLA ELECTRONICS VINA</p>
        </div>
        <div style="width:70%; text-align:center;float:left;">
            <div id="approvedstamp" style="text-align:left;">
                <img src="/img/approved.png" alt="" style="height:50px;margin-left:-20px;">
            </div>
            <div id="approvedstamp" style="text-align:right;margin-top:-40px;">
                <img src="/img/hq.png" alt="" style="height:120px;">
            </div>        
        </div>
    </div>
    <div style="width:100%; text-align:center;">
            <h1 style="margin-bottom:0px;">INTERNAL APPROVAL</h1>
            <p style="margin:0px;">No: {{$purchase->docNumber}} / Date : {{Carbon\Carbon::parse($purchase->created_at)->format('Y-M-d h:m:s')}}</p>   
    </div>
    <div class="col-md-12">
        <h3 id="centerprint"><span class="glyphicon glyphicon-play" id="noprint"></span><strong>Title : </strong>{{$purchase->title}}</h3>
    </div>
    <div class="col-md-12">
        <table border="1" bordercolor="#ccc" cellpadding="5" cellspacing="0" style="border-collapse:collapse; width:100%">
            <tbody><tr>
                <td><strong>Cash : </strong>{{$purchase->cashgroup()->first()->CashgroupName}}</td>
            <td><strong>Create : </strong>{{Carbon\Carbon::parse($purchase->created_at)->format('Y-M-d')}}</td>
            <td><strong>Payment : </strong>24 Nov, 2019</td>
            <td><strong>Total Amount : </strong><span class="">{{number_format($purchase->total_amount,0)}} </span> VND</td>
            </tr>
            </tbody>
        </table>
    </div>
    <div id="needprint">
        <p><strong>1. 목적/ Purpose:&nbsp;</strong>{{$purchase->purpose}}</p>
        <p><strong>2. 업체 및 자세한 내용/ Supplier and item detail:</strong></p>
        <table border="1" cellspacing="0" style="border-collapse:collapse; border:0.5pt solid windowtext; width:100%">
            <tbody>
                <tr>
                    <td colspan="3" style="background-color:#d9d9d9; height:40.95pt; text-align:center; vertical-align:middle; white-space:nowrap; width:10%"><span style="font-size:12pt"><span style="color:black"><strong><span style="font-family:&quot;Times New Roman&quot;,serif">업체/Supplier</span></strong></span></span></td>
                    <td colspan="4" style="background-color:#d9d9d9; height:40.95pt; text-align:center; vertical-align:middle; white-space:nowrap; width:38%;"><span style="font-size:12pt"><span style="color:black"><strong><span style="font-family:&quot;Times New Roman&quot;,serif">품명/Item</span></strong></span></span></td>
                    <td colspan="2" style="background-color:#d9d9d9; height:40.95pt; text-align:center; vertical-align:middle; white-space:normal; width:10%"><span style="font-size:12pt"><span style="color:black"><strong><span style="font-family:&quot;Times New Roman&quot;,serif">수량/ Quantity</span></strong></span></span></td>
                    <td style="background-color:#d9d9d9; height:40.95pt; text-align:center; vertical-align:middle; white-space:nowrap; width:10%"><span style="font-size:12pt"><span style="color:black"><strong><span style="font-family:&quot;Times New Roman&quot;,serif">단가/ UNP</span></strong></span></span></td>
                    <td colspan="3" style="background-color:#d9d9d9; height:40.95pt; text-align:center; vertical-align:middle; white-space:nowrap; width:11%"><span style="font-size:12pt"><span style="color:black"><strong><span style="font-family:&quot;Times New Roman&quot;,serif">금액/Amount</span></strong></span></span></td>
                    <td colspan="2" style="background-color:#d9d9d9; height:40.95pt; text-align:center; vertical-align:middle; white-space:nowrap; width:20%"><span style="font-size:12pt"><span style="color:black"><strong><span style="font-family:&quot;Times New Roman&quot;,serif">비고/Mark</span></strong></span></span></td>
                </tr>
                <tr >
                    <td colspan="3" rowspan="{{count($purchase->items()->get())}}" style="background-color:white; height:54pt; text-align:center; vertical-align:middle; white-space:normal;"><span style="font-size:12pt"><span style="color:black"><span style="font-family:&quot;Times New Roman&quot;,serif">{{$supplier->SupplierShortName}}</span></span></span></td>
                    <td colspan="4" style="background-color:white; height:54pt; vertical-align:middle; white-space:normal;"><span style="font-size:12pt"><span style="color:black"><span style="font-family:&quot;Times New Roman&quot;,serif">{{$purchase->items()->first()->MaterialName}}</span></span></span></td>
                    <td colspan="2" style="height:54pt; text-align:center; vertical-align:middle; white-space:nowrap"><span style="font-size:11pt"><span style="font-family:&quot;Times New Roman&quot;,serif">{{$purchase->items()->first()->quantity}}</span></span></td>
                    <td style="height:54pt; vertical-align:middle; white-space:nowrap"><span style="font-size:11pt"><span style="font-family:&quot;Times New Roman&quot;,serif">{{number_format($purchase->items()->first()->unp, 2)}}</span></span></td>
                    <td colspan="3" style="background-color:white; height:54pt; text-align:right; padding-right: 10px; vertical-align:middle; white-space:nowrap"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif"><span style="color:black">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{number_format($purchase->items()->first()->amount, 0)}}</span></span></span></td>
                    <td colspan="2" style="height:54pt; text-align:center; vertical-align:middle; white-space:normal;"><span style="font-size:11pt"><span style="font-family:&quot;Times New Roman&quot;,serif">{{$purchase->items()->first()->mark}}</span></span></td>
                </tr>
                @foreach ($purchase->items()->get() as $index => $item)    
                  @if($index > 0)                
                  <tr>
                      <td colspan="4" style="background-color:white; height:54pt; vertical-align:middle; white-space:normal;"><span style="font-size:12pt"><span style="color:black"><span style="font-family:&quot;Times New Roman&quot;,serif">{{$item->MaterialName}}</span></span></span></td>
                      <td colspan="2" style="height:54pt; text-align:center; vertical-align:middle; white-space:nowrap"><span style="font-size:11pt"><span style="font-family:&quot;Times New Roman&quot;,serif">{{$item->quantity}}</span></span></td>
                      <td style="height:54pt; vertical-align:middle; white-space:nowrap"><span style="font-size:11pt"><span style="font-family:&quot;Times New Roman&quot;,serif">{{$item->unp}}</span></span></td>
                      <td colspan="3" style="background-color:white; height:54pt; text-align:right; padding-right: 10px; vertical-align:middle; white-space:nowrap"><span style="font-size:11pt"><span style="font-family:Calibri,sans-serif"><span style="color:black">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{number_format($item->amount,0)}}</span></span></span></td>
                      <td colspan="2" style="height:54pt; text-align:center; vertical-align:middle; white-space:normal;"><span style="font-size:11pt"><span style="font-family:&quot;Times New Roman&quot;,serif">{{$item->mark}}</span></span></td>
                  </tr>
                  @endif
                @endforeach
                <tr>
                    <td colspan="10" style="background-color:white; height:18pt; text-align:center; vertical-align:middle; white-space:normal; width:403pt"><span style="font-size:12pt"><span style="color:black"><strong><span style="font-family:&quot;Times New Roman&quot;,serif">총금액 ( VAT전)/ Amount before VAT</span></strong></span></span></td>
                    <td colspan="3" style="background-color:white; height:18pt; text-align:right; padding-right: 10px; vertical-align:middle; white-space:nowrap"><span style="font-size:11pt"><span style="color:black"><span style="font-family:Calibri,sans-serif"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{number_format($purchase->total_amount, 0)}}</strong></span></span></span></td>
                    <td colspan="2" style="height:18pt; text-align:center; vertical-align:middle; white-space:normal; width:178pt"><span style="font-size:11pt"><strong><span style="font-family:굴림,monospace">&nbsp;</span></strong></span></td>
                </tr>
                <tr>
                    <td colspan="10" style="background-color:white; height:18.75pt; text-align:center; vertical-align:middle; white-space:normal; width:403pt"><span style="font-size:12pt"><span style="color:black"><strong><span style="font-family:&quot;Times New Roman&quot;,serif">부가세/ VAT</span></strong></span></span></td>
                    <td colspan="3" style="background-color:white; height:18.75pt; text-align:right; padding-right: 10px; vertical-align:middle; white-space:nowrap"><span style="font-size:11pt"><span style="color:black"><span style="font-family:Calibri,sans-serif"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{number_format($purchase->total_amount*0.1, 0)}}</strong></span></span></span></td>
                    <td colspan="2" style="height:18.75pt; text-align:center; vertical-align:middle; white-space:normal; width:178pt"><span style="font-size:11pt"><strong><span style="font-family:굴림,monospace">&nbsp;</span></strong></span></td>
                </tr>
                <tr>
                    <td colspan="10" style="background-color:white; height:18.75pt; text-align:center; vertical-align:middle; white-space:nowrap"><span style="font-size:12pt"><span style="color:black"><strong><span style="font-family:&quot;Times New Roman&quot;,serif">총지불/ Total payment (VND)</span></strong></span></span></td>
                    <td colspan="3" style="background-color:white; height:18.75pt; text-align:right; padding-right: 10px; vertical-align:middle; white-space:nowrap"><span style="font-size:11pt"><span style="color:black"><span style="font-family:Calibri,sans-serif"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{number_format($purchase->total_amount * 1.1, 0)}}</strong></span></span></span></td>
                    <td colspan="2" style="background-color:white; height:18.75pt; text-align:center; vertical-align:middle; white-space:nowrap"><span style="font-size:10pt"><span style="color:black"><strong><span style="font-family:굴림,monospace">&nbsp;</span></strong></span></span></td>
                </tr>
                <tr>
                    <td colspan="9" style="background-color:white; height:18.75pt; text-align:center; vertical-align:middle; white-space:nowrap"><span style="font-size:12pt"><span style="color:black"><strong><span style="font-family:&quot;Times New Roman&quot;,serif">KRW</span></strong></span></span></td>
                    <td style="background-color:white; height:18.75pt; text-align:center; vertical-align:middle; white-space:normal; width:83pt"><span style="font-size:12pt"><span style="color:black"><strong><span style="font-family:&quot;Times New Roman&quot;,serif">4.82</span></strong></span></span></td>
                    <td colspan="3" style="background-color:white; height:18.75pt; text-align:right; padding-right: 10px; vertical-align:middle; white-space:nowrap"><span style="font-size:11pt"><span style="color:black"><span style="font-family:Calibri,sans-serif"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; {{number_format($purchase->total_amount / 482, 2)}}</strong></span></span></span></td>
                    <td colspan="2" style="background-color:white; height:18.75pt; text-align:center; vertical-align:middle; white-space:nowrap"><span style="font-size:10pt"><span style="color:black"><strong><span style="font-family:굴림,monospace">&nbsp;</span></strong></span></span></td>
                </tr>
            </tbody>
        </table>
        <p><strong>3. 지불 정보/ Information to payment:</strong></p>
        <p><strong>*지불 조건: 30일 후/ Terms of Payment: </strong>{{$purchase->termOfPayment}}<br>
        <strong>*지불 방식: 송금/ Payment method: </strong>{{$purchase->paymentMethod}}</p>
        <div class="col-md-12" id="ajax_result">
            <div class="col-md-12" style="padding:5px;"></div>                
            <table border="1" bordercolor="#ccc" cellpadding="5" cellspacing="0" style="border-collapse:collapse; width:100%;padding-top:10px;">
            <tbody>
                <tr>
                <td colspan="2" style="text-align:center"><strong>Information of supplier ( Only for Bank Tranfer ) </strong></td>
                </tr>
                <tr>
                <td style="width:20%"><strong>Company name </strong></td>
                <td>{{$purchase->supplier()->first()->SupplierName}}</td>
                </tr>
                <tr>
                <td><strong>Bank Account </strong></td>
                <td>{{$purchase->supplier()->first()->SupplierBankAccount}}</td>
                </tr>
                <tr>
                <td><strong>Bank name </strong></td>
                <td>{{$purchase->supplier()->first()->SupplierBankName}}</td>
                </tr>
                <tr>
                <td><strong>Branch </strong></td>
                <td>{{$purchase->supplier()->first()->SupplierBankBranch}}</td>
                </tr>
            </tbody>
            </table>
        </div>
    </div>
    <div>
        <p><span class="glyphicon glyphicon-play"></span><strong>LINE APPROVAL STATUS</strong></p>
        <table border="1" bordercolor="#ccc" cellpadding="5" cellspacing="0" style="border-collapse:collapse; width:100%">
            <thead>
              <tr>
                <th>Appr</th>
                <th>PIC </th>
                <th>Position </th>
                <th>Status</th>
                <th style="width: 90px;">Time</th>
                <th>Comment</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td></td>
                <td>{{$purchase->user()->first()->employee()->first()->EmployeeName}}</td>
                <td>{{$purchase->user()->first()->employee()->first()->EmployeeInformation}}</td>
                <td class="bg-success">Created</td>
                <td>{{Carbon\Carbon::parse($purchase->created_at)->format('Y-M-d h:m:s')}}</td>
                <td></td>

              </tr>
              @foreach ($purchase->lines()->get() as $key => $line)
                  
              <tr>
                <td>{{$key + 1}}</td>
                <td>{{$line->employee()->first()->EmployeeName}}</td>
                <td>{{$line->employee()->first()->EmployeeInformation}}</td>
                <td @if($line->status ==1) class="bg-success" @elseif($line->status == 2) class="bg-danger" @elseif($line->status == 3) class="bg-warning" 
                   @endif> @if($line->status == 1) Aprroved @elseif($line->status == 2) Rejected @elseif($line->status == 3) In Progress  @endif</td>
                <td>
                  @if($line->status == 1 || $line->status == 2)
                  {{Carbon\Carbon::parse($line->action_date)->format('Y-M-d h:m:s')}}
                  @endif
                </td>
                <td style="text-align:left;">
                  @if($line->status == 1 || $line->status == 2)
                  {{$line->comment}}
                  @endif
                </td>
              </tr>
              @endforeach
            </tbody>
    </table>
    </div>
</div>
    
    <script src="/js/app.js"></script>
    {{-- <script src="/js/approval/purchase/print-purchase.js"></script> --}}
</body>
</html>
