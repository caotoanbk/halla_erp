<template>
    <div class="row mt-3 w-100">
        <div class="col-md-8">
            <h3 class="text-center">
                출금 계획 - Payment Plan
            </h3>
            <p class="text-center">Date: <datepicker wrapper-class="d-inline-block" @input="form.date_payment = fixDate($event)" 
            format="yyyy-MM-dd" v-model="form.date_payment" input-class=""></datepicker></p>
            <table class="w-100 ml-3">
                <tr>
                    <td>USD/KRW</td>
                    <td><input type="number" step=".01" v-model="form.usd_krw" class="w-100"></td>
                    <td>VND/KRW</td>
                    <td><input type="number" step=".01" v-model="form.vnd_krw" class="w-100"></td>
                    <td>USD/VND</td>
                    <td><input type="number" step=".01" v-model="form.usd_vnd" class="w-100"></td>
                    <td class="text-center"><button class="btn btn-primary btn-sm" @click="loadNewestRate()">Load newest rate</button></td>
                </tr>
            </table>
            <table class="w-100 ml-3 mt-3 table2">
                <thead>
                    <tr>
                        <th rowspan="2" style="width: 10%">Bank</th>
                        <th style="width: 10%">구분</th>
                        <th style="width: 6%">계정과목</th>
                        <th style="width: 10%">지출처</th>
                        <th>내용</th>
                        <th style="width: 10%;text-align: right; padding-right: 10px;">금액</th>
                        <th style="width: 15%;text-align: center">비고</th>
                    </tr>
                    <tr>
                        <th>Sortation</th>
                        <th>Acc Code</th>
                        <th>Supplier</th>
                        <th>Content</th>
                        <th class="text-right pr-2">Amount</th>
                        <th class="text-center">BP number</th>
                    </tr>
                </thead>
                <tbody>
                    <template v-for="(value,name) in items">
                        <tr :key="name">
                            <td :rowspan="orignItems[name].length + Object.keys(items[name]).length*2 + 3">{{name}}</td>
                            <td :rowspan="items[name][Object.keys(items[name])[0]].length">{{items[name][Object.keys(items[name])[0]][0].bank_account}}</td>
                            <td class="text-center">1</td>
                            <td>{{items[name][Object.keys(items[name])[0]][0].supplier_name}}</td>
                            <td>{{items[name][Object.keys(items[name])[0]][0].purchase_title}}</td>
                            <td style="text-align: right; padding: 5px">{{items[name][Object.keys(items[name])[0]][0].amount.toLocaleString('es-ES')}}</td>
                            <td class="text-center"><a target="_blank" :href="'/approval/purchase/show/'+items[name][Object.keys(items[name])[0]][0].purchaserequest_id">
                            {{items[name][Object.keys(items[name])[0]][0].purchase_docno}}</a>
                            &nbsp;<a href="#" @click.prevent="removePurchaseBank(items[name][Object.keys(items[name])[0]][0].id)" class="text-danger">
                                <i class="fas fa-times-circle"></i></a></td>
                        </tr>
                        <template v-for="(val,name, index1) in value">
                            <tr :key="name" v-if="index1 > 0">
                                <td :rowspan="val.length">{{name}}</td>
                                <td class="text-center">1</td>
                                <td>{{val[0].supplier_name}}</td>
                                <td>{{val[0].purchase_title}}</td>
                                <td style="text-align: right; padding: 5px">{{val[0].amount.toLocaleString('es-ES')}}</td>
                                <td class="text-center"><a target="_blank" :href="'/approval/purchase/show/'+val[0].purchaserequest_id">{{val[0].purchase_docno}}</a>&nbsp;<a href="#" @click.prevent="removePurchaseBank(val[0].id)" class="text-danger"><i class="fas fa-times-circle"></i></a></td>
                            </tr>
                            <template v-for="(item,index2) in val">
                                <tr :key="item.id" v-if="index2 > 0">
                                    <td class="text-center">{{index2+1}}</td>
                                    <td>{{item.supplier_name}}</td>
                                    <td>{{item.purchase_title}}</td>
                                    <td style="text-align: right; padding: 5px">{{item.amount.toLocaleString('es-ES')}}</td>
                                    <td class="text-center"><a target="_blank" :href="'/approval/purchase/show/'+item.purchaserequest_id">{{item.purchase_docno}}</a>&nbsp;<a href="#" @click.prevent="removePurchaseBank(item.id)" class="text-danger"><i class="fas fa-times-circle"></i></a></td>
                                </tr>
                            </template>
                            <tr>
                                <td colspan="3"><strong>Sub Total</strong></td>
                                <td></td>
                                <td style="text-align: right; padding: 5px"><strong>{{calculateSubTotal(val[0].bank_id).toLocaleString('es-ES')}}</strong></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="3"><strong>KRW</strong></td>
                                <td></td>
                                <td style="text-align: right; padding: 5px"><strong>{{(calculateSubTotal(val[0].bank_id)*(form.vnd_krw)/100).toLocaleString('es-ES')}}</strong></td>
                                <td></td>
                            </tr>
                        </template>
                        <tr class="bg-warning">
                            <td colspan="4" class="font-weight-bold">Total VND</td>
                            <td style="text-align: right; padding: 5px"><strong>{{calculateTotal(orignItems[name]).toLocaleString('es-ES')}}</strong></td>
                            <td></td>
                        </tr>
                        <tr class="bg-warning">
                            <td colspan="4" class="font-weight-bold">Total USD</td>
                            <td style="text-align: right; padding: 5px"><strong>{{(calculateTotal(orignItems[name])/form.usd_vnd).toLocaleString('es-ES')}}</strong></td>
                            <td></td>
                        </tr>
                        <tr class="bg-warning">
                            <td colspan="4" class="font-weight-bold">Total KRW</td>
                            <td style="text-align: right; padding: 5px"><strong>{{(calculateTotal(orignItems[name])*(form.vnd_krw)/100).toLocaleString('es-ES')}}</strong></td>
                            <td></td>
                        </tr>

                    </template>
                </tbody>
                <tfoot>

                    <tr class="bg-danger">
                        <td colspan="5"><strong class="">&rarr;&nbsp;Total VND</strong></td>
                        <td style="text-align: right; padding: 5px;"><strong>{{calculateTotal(payment_bank_purchases).toLocaleString('es-ES')}}</strong></td>
                        <td></td>
                    </tr>
                    <tr class="bg-danger">
                        <td colspan="5"><strong class="">&rarr;&nbsp;Total USD</strong></td>
                        <td style="text-align: right; padding: 5px"><strong>{{(calculateTotal(payment_bank_purchases)/form.usd_vnd).toLocaleString('es-ES')}}</strong></td>
                        <td></td>
                    </tr>
                    <tr class="bg-danger">
                        <td colspan="5"><strong class="">&rarr;&nbsp;Total KRW</strong></td>
                        <td style="text-align: right; padding: 5px"><strong>{{(calculateTotal(payment_bank_purchases)*form.vnd_krw/100).toLocaleString('es-ES')}}</strong></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="col-md-4 pt-5">
            <h4>윤곽 - Lines</h4>
            <p v-if="filteredLines.length == 0" class="d-inline-block bg-danger p-1">No lines selected</p>
            <div class="row">
                <div class="col-md-12">
                    <template v-if="form.lines.length > 0">
                        <div class="form-group mb-1 lines" v-for="(line, index) in form.lines" :key="index">
                            <template v-if="usersOptions">
                                <v-select 
                                :placeholder="'line ' + (index+1)"
                                :options="usersOptions" 
                                :getOptionLabel="u => (u.employee_opt_name)" 
                                v-model="line.user_id"
                                :reduce="user => user.id + ''" 
                                class="form-control" />
                            </template>
                        </div>
                    </template>
                    <div class="mb-1" v-if="!form.is_submit">
                        <a class="text-info" href="#" @click="addNewLine()"><i class="fas fa-plus"></i>&nbsp;Add new line</a>
                        &nbsp;|&nbsp;
                        <a class="text-danger" v-if="form.lines.length > 0" href="#" @click="removeLastLine()"><i class="fas fa-times"></i>&nbsp;Remove last line</a>
                    </div>

                </div>
            </div>
            <template v-if="!this.form.is_submit">
            <h4 class="mt-3">선택 요청 - Select request</h4>
            <template v-if="purchaseOptions">
            <v-select multiple
                :options="purchaseOptions" 
                :getOptionLabel="u => (u.docNumber + ' # ' + u.supplier_name + ' # ' + u.total_amount_format + ' # ' + u.title )"  
                :reduce="purchase => purchase.id" 
                v-model="selectedPurchases"
            />
            </template>
            <div class="mt-4 pt-3">
                <template v-for="(bank,index) in banks" >
                    <button @click.prevent="addToBank(b.id)" class="btn btn-block btn-outline-secondary" v-for="b in banks[index]" :key="b.id">Add {{index}} {{b.BankAccount}}</button>
                </template>
            </div>
            </template>
            <div v-if="!form.is_submit" class="mt-4">
            <button class="btn btn-primary" @click.prevent="saveData()">Save</button>
            <button class="btn btn-success" @click="submitData()">Finish &amp; send to lines</button>
            </div>
            <div v-else class="mt-4">
                <h5 class="text-danger">THIS PAYMENT WERE SUBMITTED</h5>
                <a :href="'/approval/paymentplan/print/'+paymentplan_id" class="btn btn-secondary"><i class="fas fa-print">&nbsp;Print</i></a>
            </div>
        </div>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker'
    import moment from 'moment';

    export default {
        props: ['paymentplan_id'],
        data() {
            return {
                form: new Form({
                    date_payment: '',
                    docno: '',
                    usd_krw: '',
                    vnd_krw: '',
                    usd_vnd: '',
                    is_submit: null,
                    lines: [{id: null, user_id: ''}]
                }),
                purchaseOptions: null,
                usersOptions: [],
                selectedPurchases: [],
                banks: null,
                items: null,
                paymentplan: null,
                orignItems: null,
                payment_bank_purchases:null,
                errors: []
            }
        },
        methods: {
            fixDate(event) {
                return moment(event).format('YYYY-MM-DD')
            },
            addNewLine(){
                this.form.lines.push({user_id: null, id: null});
            },
            removeLastLine(){
                this.form.lines.splice(this.form.lines.length -1, 1)
            },
            loadNewestRate(){
                axios.get('/api/exrate/newest')
                .then(({data}) => {
                    if(data){
                        this.form.usd_krw = parseFloat(data.usd_krw).toFixed(2)
                        this.form.vnd_krw = parseFloat(data.vnd_krw).toFixed(2)
                        this.form.usd_vnd = parseFloat(data.usd_vnd).toFixed(2)
                    }
                })
                .catch(() => {

                })
            },
            saveData(){
                if(this.filteredLines.length > 0){
                    this.$Progress.start();
                    this.form.put('/api/paymentplan/'+this.paymentplan_id)
                    .then(({data}) => {
                        swal.fire(
                            'Updated!',
                        'Information has been updated.',
                        'success'
                        )
                        this.$Progress.finish(); 
                    })
                    .catch(() => {
                        this.$Progress.fail();
                    })
                }else{
                    toast.fire({
                        type: 'error',
                        title: 'Lines not selected!'
                    });
                }
            },
            submitData(){
                if(this.filteredLines.length > 0){
                    this.$Progress.start()
                    this.form.is_submit = true
                    this.form.put('/api/paymentplan/'+this.paymentplan_id)
                    .then(({data}) => {
                        swal.fire(
                            'Submitted!',
                        'Payment has been submitted.',
                        'success'
                        )
                        this.$Progress.finish(); 
                    })
                    .catch(() => {
                        this.form.is_submit = false
                        this.$Progress.fail();
                    })
                }else{
                    toast.fire({
                        type: 'error',
                        title: 'Lines not selected!'
                    });
                }
            },
            addToBank(bank_id){
                if(this.form.is_submit)
                {
                    return;
                }
                if(this.selectedPurchases.length == 0)
                {
                    toast.fire({
                        type: 'error',
                        title: 'None request to add!'
                    });
                    return;
                }
                this.$Progress.start()
                axios.put('/api/add-purchase-to-bank/' + this.paymentplan_id + '/'+bank_id, {data: this.selectedPurchases})
                .then(({data}) => {
                    this.paymentplan = data.paymentplan[0]
                    this.payment_bank_purchases = data.paymentplan[0].payment_bank_purchases
                    this.orignItems = _.groupBy(data.paymentplan[0].payment_bank_purchases, 'bank_name')
                    this.items = _.groupBy(data.paymentplan[0].payment_bank_purchases, 'bank_name')
                    for(const item in this.items){
                        this.items[item] = _.groupBy(this.items[item], 'bank_account')
                    }
                    toast.fire({
                        type: 'success',
                        title: 'Add to bank successfully!'
                    });
                    this.selectedPurchases = []
                    this.$Progress.finish()
                })
                .catch(() => {
                    this.$Progress.fail()
                })

            },
            removePurchaseBank(id){
                this.$Progress.start()
                axios.delete('/api/purchase-bank-payment/'+id)
                .then(({data}) => {
                    this.paymentplan = data.paymentplan[0]
                    this.payment_bank_purchases = data.paymentplan[0].payment_bank_purchases
                    this.orignItems = _.groupBy(data.paymentplan[0].payment_bank_purchases, 'bank_name')
                    this.items = _.groupBy(data.paymentplan[0].payment_bank_purchases, 'bank_name')
                    for(const item in this.items){
                        this.items[item] = _.groupBy(this.items[item], 'bank_account')
                    }
                    toast.fire({
                        type: 'success',
                        title: 'Deleted!'
                    });
                    this.$Progress.finish()
                })
                .catch((err) => {
                    this.$Progress.fail()
                })
            },
            calculateSubTotal(bank_id){
                let myArr = _.filter(this.payment_bank_purchases, function(o){
                    return o.bank_id == bank_id
                })
                return _.sumBy(myArr, function(o){
                    return parseInt(o.amount)
                })
            },
            calculateTotal(arr){
                return _.sumBy(arr, function(o){
                    return parseInt(o.amount)
                })
            },
            loadData(){
                axios.get("/api/get-paymentplan-data/"+this.paymentplan_id)
                .then(({data}) => {
                    this.form.fill(data.paymentplan[0])
                    this.paymentplan = data.paymentplan[0]
                    this.purchaseOptions = data.purchases
                    this.usersOptions = data.users
                    if(!this.form.usd_krw){
                        if(data.exrate){
                            this.form.usd_krw = parseFloat(data.exrate.usd_krw).toFixed(2)
                            this.form.vnd_krw = parseFloat(data.exrate.vnd_krw).toFixed(2)
                            this.form.usd_vnd = parseFloat(data.exrate.usd_vnd).toFixed(2)
                        }else{
                            this.form.usd_krw = 1.01
                            this.form.vnd_krw = 1.01
                            this.form.usd_vnd = 1.01
                        }
                    }else{
                        this.form.usd_krw = parseFloat(this.form.usd_krw).toFixed(2)
                        this.form.vnd_krw = parseFloat(this.form.vnd_krw).toFixed(2)
                        this.form.usd_vnd = parseFloat(this.form.usd_vnd).toFixed(2)
                    }
                    this.banks = data.banks
                    this.payment_bank_purchases = data.paymentplan[0].payment_bank_purchases
                    this.orignItems = _.groupBy(data.paymentplan[0].payment_bank_purchases, 'bank_name')
                    this.items = _.groupBy(data.paymentplan[0].payment_bank_purchases, 'bank_name')
                    for(const item in this.items){
                        this.items[item] = _.groupBy(this.items[item], 'bank_account')
                    }
                    
                })
            }
        },
        created() {
            this.loadData();
        },
        mounted() {
        },
        computed: {
            filteredLines(){
                return this.form.lines.filter((item) => {
                    return item.user_id != null
                })
            }
        },
        components: {
            Datepicker
        }
    }
</script>
<style scope>
.table2 th, .table2 td{
    padding-left: 4px;
}
.lines .vs__dropdown-toggle {
    border: 0px;
    margin-top: -4px;
}
</style>
