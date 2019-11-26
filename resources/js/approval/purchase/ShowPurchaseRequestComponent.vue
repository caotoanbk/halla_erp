<template>
    <div class="row m-0 pb-4">
        <div class="col-md-7">
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <h5 style="margin-top: 10px; margin-bottom: 10px; font-size: 14px;"><i class="fas fa-play"></i>&nbsp;{{this.form.title}}</h5>
                    <template v-if="usersOptions.length > 0">
                    <p style="margin-bottom: 8px"><i class="fas fa-user"></i>&nbsp;
                    <strong>{{findUser(30).employee ? findUser(30).employee.EmployeeName : ''}} | some comment thing</strong></p>
                    </template>
                    <table class="mytable w-100">
                        <tr>
                            <td><strong class="ml-1">Cash : &nbsp;</strong>{{currentSelectCashgroup.CashgroupName}}</td>
                            <td><strong class="ml-1">Created : &nbsp;</strong>{{form.created_at | myDate}}</td>
                            <td><strong class="ml-1">Payment : &nbsp;</strong>16-11-2019</td>
                            <td><strong class="ml-1">Final Approval : &nbsp;</strong>17-11-2019</td>
                            <td><strong class="ml-1">Total Amount : &nbsp;</strong>{{(amountBeforeVAT + 0.1*amountBeforeVAT).toLocaleString('es-ES')}}</td>
                        </tr>
                    </table>
                    <p class="my-2"><strong>1. 목적/ Purpose&nbsp;:&nbsp;</strong>{{form.purpose}}</p>
                    <p class="my-2"><strong>2. 업체 및 자세한 내용/ Supplier and item detail:</strong></p>
                    <table class="tableitems-show" cellpadding="2" cellspacing="0" style="border-collapse:collapse; width:100%;">
                        <tbody>
                            <tr class="bg-secondary py-3">
                                <td style="text-align:center;width: 15%;" class="py-2"><strong>업체/Supplier</strong></td>
                                <td style="text-align:center; width: 40%;"><strong>세부/ Detail </strong></td>
                                <td style="text-align:center; width: 10%;"><strong>단위/ Unit </strong></td>
                                <td style="text-align:center"><strong>수량/ Quantity </strong></td>
                                <td style="text-align:center"><strong>단가/ UNP </strong></td>
                                <td style="text-align:center;width: 17%;"><strong>비고/ Mark</strong></td>
                                <td style="text-align:center;width: 13%;"><strong>금액/ Amount</strong></td>

                            </tr>
                            <template v-if="form.items.length > 0">
                            <tr>
                                <td class="text-center" :rowspan="this.form.items.length">{{currentSelectSupplier.SupplierShortName}}</td>
                                <td>{{this.form.items[0].MaterialName}}</td>
                                <td class="text-center">{{this.form.items[0].unit}}</td>
                                <td class="text-center">{{this.form.items[0].quantity}}</td>
                                <td class="text-center">{{parseInt(this.form.items[0].unp).toLocaleString('es-ES')}}</td>
                                <td class="text-center">{{this.form.items[0].mark}}</td>
                                <td class="text-right pr-3">{{parseInt(this.form.items[0].amount).toLocaleString('es-ES')}}</td>
                            </tr>
                            </template>
                            <tr v-for="(item,index) in this.form.items.slice(1)" :key="index">
                                <td>
                                   {{item.MaterialName}}
                                </td>
                                <td class="text-center">{{item.unit}}</td>
                                <td class="text-center">{{item.quantity}}</td>
                                <td class="text-center">{{parseInt(item.unp).toLocaleString('es-ES')}}</td>
                                <td class="text-center">{{item.mark}}</td>
                                <td class="text-right pr-3">{{parseInt(item.amount).toLocaleString('es-ES')}}</td>
                                
                            </tr>
                            <tr style="font-weight: bold">
                                <td colspan="6" style="height:15.0pt; text-align:center">총금액 ( VAT전)/ Amount before VAT</td>
                                <td class="text-right pr-3">{{amountBeforeVAT.toLocaleString('es-ES')}}</td>
                            </tr>
                            <tr style="font-weight: bold">
                                <td colspan="6" style="height:15.0pt; text-align:center">VAT(%)</td>
                                <td class="text-center">10</td>
                            </tr>
                            <tr style="font-weight: bold">
                                <td colspan="6" style="height:15.0pt; text-align:center">총지불/ Total Payment (VND)</td>
                                <td class="text-right pr-3">{{(amountBeforeVAT + amountBeforeVAT * 10 / 100).toLocaleString('es-ES')}}</td>
                            </tr>
                            <tr style="font-weight: bold">
                                <td colspan="5" style="height:15.0pt; text-align:center">KRW</td>
                                <td class="text-center">4.5</td>
                                <td class="text-right pr-3">{{parseFloat(form.KRW).toLocaleString('es-ES')}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="my-2"><strong>3. 지불 정보/ Information to payment:</strong></p>
                    <p class="my-1"><strong>*지불 조건: 30일 후/ Terms of Payment:&nbsp;</strong>{{form.termOfPayment}}</p>
                    <p class="my-1"><strong>*지불 방식: 송금/ Payment method:&nbsp;</strong>{{form.paymentMethod}}</p>
                </div>

                <div class="col-md-12 mt-4" id="ajax_result">
                  <table class="bankinfo" cellpadding="5" cellspacing="0" style="border-collapse:collapse; width:100%">
                    <tbody>
                      <tr><td colspan="2" style="text-align:center"><strong>공급자 정보 (은행 송금 전용)/ Information of supplier ( Only for Bank Tranfer ) </strong></td></tr>
                      <tr><td class="w-25"><strong>회사 이름/ Company name </strong></td><td>{{currentSelectSupplier.SupplierName?currentSelectSupplier.SupplierName : '' }}</td></tr>
                      <tr><td><strong>은행 계좌/ Bank Account </strong></td><td>{{currentSelectSupplier.SupplierBankAccount}}</td></tr>
                      <tr><td><strong>은행 이름/ Bank name </strong></td><td>{{currentSelectSupplier.SupplierBankName}}</td></tr>
                      <tr><td><strong>분기/ Branch </strong></td><td>{{currentSelectSupplier.SupplierBankBranch}}</td></tr>
                    </tbody>
                  </table>
              </div>
                

            </div>
        </div>


        <div class="col-md-5">
            <div class="lineapp row">
                <div class="col-md-12">
                    <h5 style="margin-top: 10px;">
                        <i class="fas fa-caret-right"></i>&nbsp;Document Number:
                    </h5>
                    <h4 class="pl-3 text-dark">{{form.docNumber}}</h4>
                </div>
                <div class="col-md-12">
                    <div id="checkgroup">
                      <h5><i class="fas fa-caret-right"></i>&nbsp;Budget Information:</h5>
                      <table class="tableitems w-100">
                        <tbody><tr><th class="w-50">Group name</th><td>{{currentSelectCashgroup.CashgroupName?currentSelectCashgroup.CashgroupName:'-'}}</td></tr>
                        <tr><th>Budget</th><td>{{currentSelectCashgroup.CashgroupBudget?currentSelectCashgroup.CashgroupBudget.toLocaleString('es-ES'):'-'}}</td></tr>
                        <tr><th>Current Amount</th><td>{{(amountBeforeVAT + amountBeforeVAT * VATratio / 100).toLocaleString('es-ES')}}</td></tr>
                        <tr><th>Rate</th><td>-</td></tr>
                      </tbody></table>
                    </div>
                </div>
                <div class="col-md-12">
                    <h5 style="margin-top: 10px;">
                        <i class="fas fa-caret-right"></i>&nbsp;Attached files:
                    </h5>
                    <table class="table table-bordered table-file-list" style="border-collapse: collapse; margin-bottom: 10px;">
                        <tbody>
                          <tr>
                            <th>File Name</th>
                            <th>File Size</th>
                          </tr>

                          <tr v-for="(file,index) in form.attachments" :key="index">
                            <td><a target="_blank" :href='"/attachments/approval/purchase/"+file.id+"."+file.filename.substr(file.filename.lastIndexOf(".") + 1)' class="text-primary text-underlined"><i class="fas fa-download"></i>&nbsp;{{file.filename}}</a></td>
                            <td>{{file.size}}</td>
                          </tr></tbody>
                      </table>
                </div>
                <div class="col-md-12">
                    <h5 style="margin-top: 10px;">
                        <i class="fas fa-caret-right"></i>&nbsp;Line Approval Status:
                    </h5>
                    <table class="w-100">
                        <tr class="text-center" style="background-color: #f2dcdb;">
                            <th style="padding: 4px; width: 5%;">#</th>
                            <th style="width: 12%; padding: 3px;">PIC</th>
                            <th style="width: 15%">Position</th>
                            <th style="width: 10%;">Status</th>
                            <th style="width: 10%">Time</th>
                            <th>Comment</th>
                        </tr>
                        <template v-if="usersOptions.length > 0">
                            <tr>
                                <td class="text-center"><i class="fas fa-long-arrow-alt-right"></i></td>
                                <td style="padding: 3px">{{findUser(parseInt(form.userId)).employee.EmployeeName}}</td>
                                <td>{{findUser(parseInt(form.userId)).employee.EmployeeInformation}}</td>
                                <td class="bg-success text-center">Created</td>
                                <td>{{form.created_at | myDate}}</td>
                                <td></td>
                            </tr>
                        </template>
                        <template v-if="form.lines.length > 0">
                        <template v-for="(line,index) in form.lines">
                            <tr :key="line.id">
                                <td class="text-center">{{index+1}}</td>
                                <td style="padding: 3px" class="bg-infod">
                                {{findUser(parseInt(line.user_id)).employee.EmployeeName}}
                                </td>
                                <td>{{findUser(parseInt(line.user_id)).employee.EmployeeInformation}}</td>
                                <td v-if="(line.user_id == current_user_id && line.status == 0 && index == 0)">
                                   <select @change="updateLineStatus(line,index)" v-model="line.status">
                                       <option value="0">Action</option>
                                       <option value="1">Approve</option>
                                       <option value="2">Reject</option>
                                   </select>

                                </td>
                                <td v-else-if="(line.user_id == current_user_id && line.status == 3)">
                                   <select @change="updateLineStatus(line,index)" v-model="line.status">
                                       <option value="3">Action</option>
                                       <option value="1">Approve</option>
                                       <option value="2">Reject</option>
                                   </select>

                                </td>
                                <td class="bg-success text-center" v-else-if="line.status == '1'">
                                    Approved
                                </td>
                                <td class="bg-danger text-center" v-else-if="line.status == '2'">
                                    Rejected
                                </td>
                                <td class="bg-warning text-center" v-else-if="line.status == '3'">
                                    In Progress
                                </td>
                                <td v-else></td>
                                <td>{{line.action_date ? line.action_date : '' | myDate}}</td>
                                <td>
                                    <p v-if="line.user_id == current_user_id && (line.status == '1' || line.status == '2' || line.status == '3')">
                                        <textarea v-model="line.comment" class="form-control mb-1" style="font-size: 12px;">Fee for replace optical signal converter</textarea>
                                        <button @click="updateLineComment(line.id, line.comment)" class="btn btn-primary btn-sm float-right">Update Comment</button>
                                    </p>
                                    <p v-else-if="(line.status == '1') || (line.status == '2')">
                                        {{line.comment}}
                                    </p>
                                </td>
                                                    
                            </tr>
                        </template>
                        </template>
                    </table>

                </div>
                <div class="col-md-12">
                    <h5 style="margin-top: 10px;">
                        <i class="fas fa-caret-right"></i>&nbsp;Actual Payments:
                    </h5>
                    <table class="table table-bordered table-file-list" style="border-collapse: collapse; margin-bottom:5px;">
                        <tbody>
                          <tr>
                            <td>1 nth Pay</td>
                            <td>8.500.000.000</td>
                            <td>2019-11-20</td>
                          </tr>
                          <tr>
                            <td>2 nth Pay</td>
                            <td>7.500.000.000</td>
                            <td>2019-11-19</td>
                          </tr>
                        </tbody>
                      </table>

                </div>
                <div class="col-md-12">
                    <h5 style="margin-top: 10px;">
                        <i class="fas fa-caret-right"></i>&nbsp;Total History:
                    </h5>
                    <ul class="list-group mb-3">
                        <template v-if="usersOptions.length > 0">
                        <li class="list-group-item">
                            <i class="fas fa-user"></i>&nbsp;{{findUser(parseInt(current_user_id)).employee.EmployeeName}} | Create New at: {{form.created_at}}<br>
                            {{form.title}}
                        </li>
                        <li class="list-group-item" v-for="line in form.lines.filter((item) => {return item.status == '1' || item.status == '2'})" :key="line.id">
                            <span v-if="line.status == '1'"><i class="fas fa-user"></i>&nbsp;{{findUser(parseInt(line.user_id)).employee.EmployeeName}} | Check or Approve at: {{line.action_date | myDate}}<br></span>
                            <span v-else><i class="fas fa-user"></i>&nbsp;{{findUser(parseInt(line.user_id)).employee.EmployeeName}} | Reject at: {{line.action_date}}<br></span>
                            {{line.comment}}
                        </li>
                        </template>
                    </ul>

                </div>
                <div class="col-md-12"><a :href="'/approval/purchase/print/' + form.id" class="text-secondary" style="text-decoration: underline;"><i class="fas fa-print"></i> Click here to print</a></div>
            </div>
        </div>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker'
    import Purchase from '../classes/Purchase'
    import moment from 'moment';

    export default {
        props: ['purchase_id', 'current_user_id'],
        data() {
            return {
                form: new Form({
                    id: null,
                    userId: null,
                    docNumber:'',
                    purchaseType: '',
                    cashgroupId:'',
                    numOfPayments: 0,
                    title:'',
                    paymentDate:'',
                    receiveDate:'',
                    currency:'KRW',
                    attachments: [],
                    purpose: '',
                    supplierId:'',
                    items:[],
                    termOfPayment:'',
                    paymentMethod: '',
                    lines:[],
                    created_at: '',
                    KRW: ''
                }),
                normalLineOrigin:[],
                VATratio:0,
                supplierOptions: [],
                cashgroupsOptions: [],
                materialOptions: [],
                usersOptions: [],
                currentSelectSupplier:{},
                currentSelectCashgroup:{},
                money: {
                  decimal: ',',
                  thousands: '.',
                  prefix: '',
                  suffix: '',
                  precision: 0,
                  masked: false /* doesn't work with directive */
                }
            }
        },
        methods: {
            findUser(id) {
                return this.usersOptions.filter((item) => {
                    return id === item.id
                })[0]
            },
            updateLineStatus(line,index){
                axios.put("/api/update-line-status/"+line.id, {status: line.status})
                .then((res) => {
                    toast.fire({
                        type: 'success',
                          title: 'Done!'
                        });
                    line.action_date = res.data
                    if(line.status == '1')
                    {
                        this.form.lines[index+1].status = '3'
                    }
                })
            },
            updateLineComment(id, comment) {
                this.$Progress.start()
                axios.put("/api/update-line-purchase-comment/"+id, {data: comment})
                    .then((res) => {
                        toast.fire({
                            type: 'success',
                          title: 'Comment updated!'
                        });
                        this.$Progress.finish()
                    }).catch((err) => {

                    })
            },
            onSupplierChange() {
                this.currentSelectSupplier = this.supplierOptions.filter((item) => {
                    return this.form.supplierId === item.id;
                })[0]
                if(this.currentSelectSupplier === undefined)
                    this.currentSelectSupplier = {}

            },
            onCashgroupChange() {
                this.currentSelectCashgroup = this.cashgroupsOptions.filter((item) => {
                    return this.form.cashgroupId === item.id;
                })[0]
                if(this.currentSelectCashgroup === undefined)
                    this.currentSelectCashgroup = {}

            },
            loadData() {
                axios.get("/api/purchase-show-data/"+this.purchase_id).then(({data}) => {
                    this.supplierOptions = data.suppliers;
                    this.cashgroupsOptions = data.cashgroups;
                    this.usersOptions = data.users;

                    this.form.fill(data.curPur[0])

                    this.form.attachments = data.curPur[0].files

                    this.form.cashgroupId = parseInt(this.form.cashgroupId)
                    this.form.supplierId = parseInt(this.form.supplierId)

                    this.onCashgroupChange()
                    this.onSupplierChange()
                })

            }

        },
        created() {
            this.loadData();
        },
        computed: {
            amountBeforeVAT: function() {
                return this.form.items.reduce((acc, item) => acc + parseFloat(item.amount), 0)
            }
        },
        components: {
            Datepicker
        }
    }
</script>
