<template>
    <div class="row m-0 pb-4">
        <div class="col-md-8">
            <div class="row">
                <div class="col-xs-12 col-md-12">
                    <h2 style="margin-top: 20px; margin-bottom: 10px;"><i class="fas fa-plus-circle"></i> 새로운 요청/ NEW PURCHASE REQUEST</h2>
                </div>
                <div class="col-md-3">
                  <div class="input-group">
                    <select v-model="form.purchase_type" class="form-control">
                      <option value="1">Normal</option>
                      <option value="2">Urgent</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-5">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Group&nbsp;<sup style="color: red;">*</sup></span>
                      </div>
                      <v-select 
                        :options="cashgroupsOptions" 
                        label="CashgroupName" 
                        :reduce="cashgroup => cashgroup.id" 
                        v-model="form.cashgroupId"
                        class="form-control"
                        @input="onCashgroupChange()" />
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Số lần thanh toán</span>
                      </div>
                       <input type="number" class="form-control" v-model="form.numOfPayments">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="input-group mb-1">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">Title&nbsp;<sup style="color: red;">*</sup></span>
                      </div>
                       <input type="text" class="form-control" v-model="form.title" placeholder="Input title request here">
                    </div>
                </div>
                <div class="col-md-3">
                   <strong>Payment date:</strong> 
                   <datepicker @input="form.paymentDate = fixDate($event)" format="yyyy-MM-dd" input-class="form-control"></datepicker>
            
                </div>
                <div class="col-md-3">
                   <strong>Ngày nhận hàng:</strong>
                   <datepicker @input="form.receiveDate = fixDate($event)" format="yyyy-MM-dd" input-class="form-control"></datepicker>
                </div>
                <div class="col-md-3">
                  <strong>Currency:</strong> 
                  <br>
                  <select name="currency" v-model="form.currency" class="form-control">
                    <option value="VND">VND</option>
                    <option value="USD">USD</option>
                    <option value="KRW">KRW</option>
                    <option value="KRW">EUR</option>
                  </select>
                </div>
                <div class="col-md-3">
                    <strong>Files:</strong>
                    <br>
                    <input type="file" ref="files_input" @change="prepareFiles" id="attachedFiles" class="form-control" accept=".pdf,.ppt,.pptx,.jpg, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" multiple="" style="line-height: 1.3;">
                </div>
                <div class="col-md-12 mt-2">
                    <div class="input-group mb-1">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">1. 목적/ Purpose&nbsp;<sup style="color: red;">*</sup></span>
                      </div>
                       <input type="text" class="form-control" v-model="form.purpose">
                    </div>
                </div>
                <div class="col-md-12 mt-1">
                    <div class="input-group mb-2">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1">2. 업체/ Supplier&nbsp;<sup style="color: red;">*</sup></span>
                      </div>
                      <v-select 
                        :options="supplierOptions" 
                        label="SupplierName" 
                        :reduce="supplier => supplier.id" 
                        v-model="form.supplierId"
                        class="form-control"
                        @input="onSupplierChange()" />
                    </div>
                </div>

                <div class="col-md-12">
                    <button class="btn btn-sm btn-primary mb-1" @click="addNewItem()">Add new item</button>
                    <table class="tableitems" cellpadding="2" cellspacing="0" style="border-collapse:collapse; width:100%;">
                        <tbody>
                            <tr>
                                <td style="text-align:center;width: 9%;"><strong>품번/ Index </strong></td>
                                <td style="text-align:center; width: 40%;"><strong>세부/ Detail </strong></td>
                                <td style="text-align:center; width: 10%;"><strong>단위/ Unit </strong></td>
                                <td style="text-align:center"><strong>수량/ Quantity </strong></td>
                                <td style="text-align:center"><strong>단가/ UNP </strong></td>
                                <td style="text-align:center;width: 13%;"><strong>금액/ Amount</strong></td>

                            </tr>
                            <tr v-for="(item,index) in this.form.items">
                                <td class="text-center">{{index + 1}}</td>
                                <td>
                                    <v-select 
                                    :options="materialOptions" 
                                    label="MaterialName" 
                                    :reduce="material => material.id" 
                                    v-model="item.material_id"
                                    class="vselect-input" />
                                </td>
                                <td><input type="text" name="" style="width: 100%;" v-model="item.unit"></td>
                                <td><input type="number" @change="calculateAmount(item)" name="" style="width: 100%;" v-model.number="item.quantity"></td>
                                <td><money v-model="item.unp" v-bind="money" @keyup.native="calculateAmount(item)"></money></td>
                                <td class="text-center">{{item.amount.toLocaleString('es-ES')}}</td>
                                <td><a href="#" @click.prevent="removeItem(index)"><i class="fas fa-trash-alt red"></i></a></td>
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
                                <td colspan="4" style="height:15.0pt; text-align:center">VAT(%)</td>
                                <td><input type="number" style="width: 100%;" v-model.number="VATratio"></td>
                            </tr>
                            <tr>
                                <td style="height:15.0pt; text-align:center; white-space:nowrap">&nbsp;</td>
                                <td colspan="4" style="height:15.0pt; text-align:center">총지불/ Total Payment (VND)</td>
                                <td>{{(amountBeforeVAT + amountBeforeVAT * VATratio / 100).toLocaleString('es-ES')}}</td>
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
                       <input type="text" class="form-control" v-model="form.termOfPayment">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="input-group mb-1">
                      <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><sup style="color: red;">*</sup>&nbsp;지불 방식/ Payment method:</span>
                      </div>
                       <input type="text" class="form-control" v-model="form.paymentMethod">
                    </div>
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


        <div class="col-md-4">
            <h3 style="margin-top: 25px;">
                <i class="fas fa-caret-right"></i>&nbsp;Approval line:
            </h3>
            <div class="lineapp row">
                <div class="col-md-6">
                    <div class="form-group" v-for="(line, index) in form.normalLines">
                        <v-select 
                        :placeholder="'line ' + (index+1)"
                        :options="usersOptions" 
                        v-model="line.user_id"
                        :getOptionLabel="u => (u.employee.EmployeeName + ' - ' + u.employee.EmployeeInformation)" 
                        :reduce="user => user.id" 
                        class="form-control" />
                    </div>
                    <div>
                        <a class="text-info" href="#" @click="addNormalLine()">Add more line</a>
                        &nbsp;|&nbsp;
                        <a class="text-danger" href="#" @click="removeNormalLine()">Remove last line</a>
                    </div>

                </div>

                <div class="col-md-6">
                    <div v-for="forcedLine in form.forcedLines" class="form-group">
                        <select class="form-control" :value="forcedLine" disabled="">
                            <option v-for="user in usersOptions" :value="user.id">{{user.employee.EmployeeName + ' - ' + user.employee.EmployeeInformation}}</option>
                        </select>
                    </div>

                </div>

                <div class="col-md-12">
                    <div id="checkgroup">
                      <h3><i class="fas fa-caret-right"></i>&nbsp;Check Budget:</h3>
                      <table class="table table-bordered">
                        <tbody><tr><th class="w-50">Group name</th><td>{{currentSelectCashgroup.CashgroupName?currentSelectCashgroup.CashgroupName:'-'}}</td></tr>
                        <tr><th>Budget</th><td>-</td></tr>
                        <tr><th>Current Amount</th><td>-</td></tr>
                        <tr><th>Rate</th><td>-</td></tr>
                      </tbody></table>
                    </div>
                </div>
                <div class="col-md-12">
                    <h3 style="margin-top: 0px;">
                        <i class="fas fa-caret-right"></i>&nbsp;Attached files:
                    </h3>
                      <table class="table table-bordered" style="border-collapse: collapse;">
                        <tbody>
                          <tr>
                            <th>File Name</th>
                            <th>File Size</th>
                            <th></th>
                          </tr>

                          <tr v-for="(file,index) in form.attachments">
                            <td>{{file.name}}</td>
                            <td>{{file.size}}</td>
                            <td class="text-right py-0 align-middle">
                              <div class="btn-group btn-group-sm">
                                <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                                <a href="#" @click.prevent="removeFile(index)" class="btn btn-danger"><i class="fas fa-trash"></i></a>
                              </div>
                            </td>
                          </tr></tbody>
                      </table>
                </div>
                <div class="col-md-4">
                    <button @click.prevent="saveData()" class="btn btn-warning btn-block">save</button>
                </div>

                <div class="col-md-4">
                    <button @click.prevent="saveAndSubmitData()" class="btn btn-success btn-block">submit</button>
                </div>
                <div class="col-md-4">
                    <a href="#" target="_blank" class="btn btn-secondary btn-block"><i class="fas fa-print"></i> Print</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker'
    import moment from 'moment';

    export default {
        data() {
            return {
                form: new Form({
                    purchase_type: '1',
                    cashgroupId:'',
                    numOfPayments: 0,
                    title:'',
                    paymentDate:'',
                    receiveDate:'',
                    currency:'KRW',
                    attachments: [],
                    purpose: '',
                    supplierId:'',
                    items:[
                        {material_id: 3, unit: '', quantity: '0', unp: '', amount:'0'}
                    ],
                    termOfPayment:'',
                    paymentMethod: '',
                    normalLines:[{user_id: ''}],
                    forcedLines:[]
                }),
                editMode: false,
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
            fixDate(event) {
                return moment(event).format('YYYY-MM-DD')
            },
            prepareFiles() {
                let files = this.$refs.files_input.files;
                if(!files.length)
                    return;
                for (var i = files.length - 1; i >= 0; i--) {

                    let reader = new FileReader();
                    let fileObj = {}

    
                    reader.onloadend = (file) => {

                        // this.form.EmployeePhoto = reader.result;
                        fileObj.data = reader.result;
                    }
                    fileObj.name = files[i].name;
                    fileObj.size = files[i].size;
                    reader.readAsDataURL(files[i]);
                    this.form.attachments.push(fileObj);
                }
                    
                document.getElementById("attachedFiles").value = [];
            },
            addNewItem() {
                this.form.items.push({material_id: '', unit: '', quantity: '0', unp: '', amount: '0'})
            },
            addNormalLine(){
                this.form.normalLines.push({user_id: ''});
            },
            removeNormalLine(){
                this.form.normalLines.splice(this.form.normalLines.length -1, 1)
            },
            removeItem(index) {
                this.form.items.splice(index,1)
            },
            removeFile(index) {
                this.form.attachments.splice(index, 1)
            },
            calculateAmount(item){
                item.amount = item.quantity * item.unp;
            },
            saveData(){
                console.log(this.form.items);
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
            loadConfigData() {
                axios.get("/api/get-purchase-approval-data").then(({data}) => {
                    this.supplierOptions = data.suppliers;
                    this.cashgroupsOptions = data.cashgroups;
                    this.materialOptions = data.materials;
                    this.usersOptions = data.users;
                    this.form.forcedLines = data.forcedLines;
                });
            }
        },
        created() {
            this.loadConfigData();
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
