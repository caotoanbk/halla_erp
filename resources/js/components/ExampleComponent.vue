<template>
    <div>
        <div class="col-md-8">
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <h2 style="margin-top: 20px; margin-bottom: 10px;"><i class="fas fa-plus-circle"></i> 새로운 요청/ NEW REQUEST</h2>
                </div>
                <div class="col-md-2 ">
                    <div class="input-group">
                      <select name="apptype" id="" class="form-control" readonly="">
                        <option value="1" selected="">Purchase Request</option>
                        <option value="2">Payment Request</option>
                        <option value="3">Advance Request</option>
                        <option value="5">Tax Request</option>
                        <option value="4">Other</option>
                      </select>
                    </div>          
                </div>
                <div class="col-md-1 " style="padding-right:0px; padding-left:0px">
                  <div class="input-group">
                    <select name="opt" id="" class="form-control">
                      <option value="1">Normal</option>
                      <option value="2">Urgent</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Group</span>
                      </div>
                      <select name="apptype" id="" class="form-control">
                        <option value="1" selected="">Purchase Request</option>
                        <option value="2">Payment Request</option>
                        <option value="3">Advance Request</option>
                        <option value="5">Tax Request</option>
                        <option value="4">Other</option>
                      </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Số lần thanh toán</span>
                      </div>
                       <input type="number" class="form-control">
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <select name="opt" id="" class="form-control">
                          <option value="1">Normal</option>
                          <option value="2">Urgent</option>
                        </select>
                  </div>
                </div>
                <div class="col-md-12">
                    <div class="input-group mb-1">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Title</span>
                      </div>
                       <input type="text" class="form-control" placeholder="Input title request here">
                    </div>
                </div>
                <div class="col-md-2">
                   <strong>Payment date:</strong> 
                   <input type="text" name="paymentdate" class="form-control" id="paymentdate" value="" required="">
                    <script>
                        $('#paymentdate').datepicker({
                          format: 'yyyy-mm-dd',
                          autoclose: true,
                          todayHighlight: true
                      });
                    </script>            
                </div>
                <div class="col-md-2">
                   <strong>Ngày nhận hàng:</strong> <input type="text" name="finishdate" id="finishdate" class="form-control" value="" required="">
                   <script>
                        $('#finishdate').datepicker({
                          format: 'yyyy-mm-dd',
                          autoclose: true,
                          todayHighlight: true
                      });
                    </script>
                </div>
                <div class="col-md-3">
                    <input type="hidden" value="1" name="creatorid">
                    <strong>Total Amount:</strong> <input type="text" name="totalamount" id="totalamount" class="form-control money" required="">
                </div>
                <div class="col-md-2">
                  <strong>Currency:</strong> 
                  <select name="currency" id="" class="form-control">
                    <option value="VND">VND</option>
                    <option value="USD">USD</option>
                    <option value="KRW">KRW</option>
                    <option value="KRW">EUR</option>
                  </select>
                </div>
                <div class="col-md-3">
                    <strong>Files:</strong> 
                    <input type="file" name="files[]" id="" class="form-control" accept=".pdf,.ppt,.pptx,.jpg, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" multiple="" style="line-height: 1.3;">
                </div>
                <div class="col-md-12 mt-2">
                    <div class="input-group mb-1">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">1. 목적/ Purpose</span>
                      </div>
                       <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-12 mt-1">
                    <div class="input-group mb-2">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">2. 업체 및 자세한 내용/ Supplier and item detail:</span>
                      </div>
                      <select name="apptype" id="" class="form-control">
                        <option value="1" selected="">Select supplier</option>
                        <option value="2">Payment Request</option>
                        <option value="3">Advance Request</option>
                        <option value="5">Tax Request</option>
                        <option value="4">Other</option>
                      </select>
                    </div>
                </div>

                <div class="col-md-12">
                    <button class="btn btn-sm btn-primary mb-1">Add new item</button>
                    <table class="tableitems" cellpadding="2" cellspacing="0" style="border-collapse:collapse; width:100%;">
                        <tbody>
                            <tr>
                                <td style="text-align:center;width: 7%;"><strong>품번/ Index </strong></td>
                                <td style="text-align:center; width: 40%;"><strong>세부/ Detail </strong></td>
                                <td style="text-align:center"><strong>단위/ Unit </strong></td>
                                <td style="text-align:center"><strong>수량/ Quantity </strong></td>
                                <td style="text-align:center"><strong>단가/ UNP </strong></td>
                                <td style="text-align:center;width: 15%;"><strong>금액/ Amount</strong></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td><input type="text" name="" style="width: 100%;"></td>
                                <td><input type="text" name="" style="width: 100%;"></td>
                                <td><input type="text" name="" style="width: 100%;"></td>
                                <td><input type="text" name="" style="width: 100%;"></td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="height:15.0pt; text-align:center; white-space:nowrap">&nbsp;</td>
                                <td colspan="2" style="height:15.0pt; text-align:center">총금액/ Total</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="height:15.0pt; text-align:center; white-space:nowrap">&nbsp;</td>
                                <td colspan="4" style="height:15.0pt; text-align:center">총금액 ( VAT전)/ Amount before VAT</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="height:15.0pt; text-align:center; white-space:nowrap">&nbsp;</td>
                                <td colspan="4" style="height:15.0pt; text-align:center">VAT</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="height:15.0pt; text-align:center; white-space:nowrap">&nbsp;</td>
                                <td colspan="4" style="height:15.0pt; text-align:center">총지불/ Total Payment (VND)</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td style="height:15.0pt; text-align:center; white-space:nowrap">&nbsp;</td>
                                <td colspan="4" style="height:15.0pt; text-align:center">KRW</td>
                                <td>&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12 mt-2">
                    <p class="mb-1">3. 지불 정보/ Information to payment:</p>

                </div>
                <div class="col-md-12">
                    <div class="input-group mb-1">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><sup style="color: red;">*</sup>&nbsp;지불 조건/ Terms of Payment:</span>
                      </div>
                       <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="input-group mb-1">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><sup style="color: red;">*</sup>&nbsp;지불 방식/ Payment method:</span>
                      </div>
                       <input type="text" class="form-control">
                    </div>
                </div>

                <div class="col-md-12 mt-4" id="ajax_result">
                  <table class="bankinfo" cellpadding="5" cellspacing="0" style="border-collapse:collapse; width:100%">
                    <tbody>
                      <tr><td colspan="2" style="text-align:center"><strong>공급자 정보 (은행 송금 전용)/ Information of supplier ( Only for Bank Tranfer ) </strong></td></tr>
                      <tr><td><strong>회사 이름/ Company name </strong></td><td></td></tr>
                      <tr><td><strong>은행 계좌/ Bank Account </strong></td><td></td></tr>
                      <tr><td><strong>은행 이름/ Bank name </strong></td><td></td></tr>
                      <tr><td><strong>분기/ Branch </strong></td><td></td></tr>
                    </tbody>
                  </table>
              </div>
            </div>
        </div>


        <div class="col-md-4">
            <h3 style="margin-top: 25px;">
                <i class="fas fa-caret-right"></i>&nbsp;Approval line:
            </h3>
            <div class="lineapp row">
                <div class="col-md-6">
                    <div class="form-group">
                        <select class="form-control">
                            <option value="">line 1:</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control">
                            <option value="">line 2:</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control">
                            <option value="">line 3:</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control">
                            <option value="">line 4:</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <select class="form-control" readonly>
                            <option value="">line 1:</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <select class="form-control" readonly>
                            <option value="">line 2:</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-12">
                    <div id="checkgroup">
                      <h3><i class="fas fa-caret-right"></i>&nbsp;Check Budget:</h3>
                      <table class="table table-bordered">
                        <tbody><tr><th>Group name</th><td>-</td></tr>
                        <tr><th>Budget</th><td>-</td></tr>
                        <tr><th>Current Amount</th><td>-</td></tr>
                        <tr><th>Rate</th><td>-</td></tr>
                      </tbody></table>
                    </div>
                </div>

                <div class="col-md-6">
                    <button class="btn btn-warning btn-block">save</button>
                </div>

                <div class="col-md-6">
                    <button class="btn btn-success btn-block">submit</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
