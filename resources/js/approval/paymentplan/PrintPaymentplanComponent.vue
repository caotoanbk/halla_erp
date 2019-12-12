<template>
    <div class="row mt-3 w-100">
        <div class="col-md-12 px-4">
            <h3 class="text-center">
                출금 계획 - Payment Plan
            </h3>
            <p class="text-center">Date: {{form.date_payment}}</p>
            <table class="w-100 ml-3">
                <tr>
                    <td>USD/KRW</td>
                    <td>{{form.usd_krw}}</td>
                    <td>VND/KRW</td>
                    <td>{{form.vnd_krw}}</td>
                    <td>USD/VND</td>
                    <td>{{form.usd_vnd}}</td>
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
                            <td class="text-center">
                            {{items[name][Object.keys(items[name])[0]][0].purchase_docno}}</td>
                        </tr>
                        <template v-for="(val,name, index1) in value">
                            <tr :key="name" v-if="index1 > 0">
                                <td :rowspan="val.length">{{name}}</td>
                                <td class="text-center">1</td>
                                <td>{{val[0].supplier_name}}</td>
                                <td>{{val[0].purchase_title}}</td>
                                <td style="text-align: right; padding: 5px">{{val[0].amount.toLocaleString('es-ES')}}</td>
                                <td class="text-center">{{val[0].purchase_docno}}</td>
                            </tr>
                            <template v-for="(item,index2) in val">
                                <tr :key="item.id" v-if="index2 > 0">
                                    <td class="text-center">{{index2+1}}</td>
                                    <td>{{item.supplier_name}}</td>
                                    <td>{{item.purchase_title}}</td>
                                    <td style="text-align: right; padding: 5px">{{item.amount.toLocaleString('es-ES')}}</td>
                                    <td class="text-center">{{item.purchase_docno}}</td>
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
                        <tr class="">
                            <td colspan="4" class="font-weight-bold">Total VND</td>
                            <td style="text-align: right; padding: 5px"><strong>{{calculateTotal(orignItems[name]).toLocaleString('es-ES')}}</strong></td>
                            <td></td>
                        </tr>
                        <tr class="">
                            <td colspan="4" class="font-weight-bold">Total USD</td>
                            <td style="text-align: right; padding: 5px"><strong>{{(calculateTotal(orignItems[name])/form.usd_vnd).toLocaleString('es-ES')}}</strong></td>
                            <td></td>
                        </tr>
                        <tr class="">
                            <td colspan="4" class="font-weight-bold">Total KRW</td>
                            <td style="text-align: right; padding: 5px"><strong>{{(calculateTotal(orignItems[name])*(form.vnd_krw)/100).toLocaleString('es-ES')}}</strong></td>
                            <td></td>
                        </tr>

                    </template>
                </tbody>
                <tfoot>

                    <tr>
                        <td colspan="5"><strong class="">&rarr;&nbsp;Total VND</strong></td>
                        <td style="text-align: right; padding: 5px;"><strong>{{calculateTotal(payment_bank_purchases).toLocaleString('es-ES')}}</strong></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="5"><strong class="">&rarr;&nbsp;Total USD</strong></td>
                        <td style="text-align: right; padding: 5px"><strong>{{(calculateTotal(payment_bank_purchases)/form.usd_vnd).toLocaleString('es-ES')}}</strong></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="5"><strong class="">&rarr;&nbsp;Total KRW</strong></td>
                        <td style="text-align: right; padding: 5px"><strong>{{(calculateTotal(payment_bank_purchases)*form.vnd_krw/100).toLocaleString('es-ES')}}</strong></td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</template>

<script>
    import Datepicker from 'vuejs-datepicker'
    import moment from 'moment';

    export default {
        props: ['paymentplan_id', 'current_user_id'],
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
                usersOptions: [],
                items: null,
                paymentplan: null,
                payment_bank_purchases:null,
            }
        },
        methods: {
            findUser(id) {
                return this.usersOptions.filter((item) => {
                    return id === item.id
                })[0]
            },
            approvePayment(line,index){
                this.$Progress.start()
                axios.put("/api/update-line-payment-comment/"+line.id, {comment: line.comment, status: 1})
                    .then((res) => {
                        toast.fire({
                            type: 'success',
                          title: 'Approved!'
                        });
                        line.status = '1'
                        line.action_date = res
                        if(this.form.lines[index+1]){
                            this.form.lines[index+1].status = '3'
                        }
                        this.$Progress.finish()
                    }).catch((err) => {
                        line.status = '3'
                })
            },
            rejectPayment(line,index){
                this.$Progress.start()
                axios.put("/api/update-line-payment-comment/"+line.id, {comment: line.comment, status: 2})
                    .then((res) => {
                        toast.fire({
                            type: 'success',
                          title: 'Rejected!'
                        });
                        line.status = '2'
                        this.$Progress.finish()
                    }).catch((err) => {
                        line.status = '3'
                })
            },
            updateComment(line){
                this.$Progress.start()
                axios.put("/api/update-line-payment-comment/"+line.id, {comment: line.comment})
                    .then((res) => {
                        toast.fire({
                            type: 'success',
                          title: 'Comment updated!'
                        });
                        this.$Progress.finish()
                    }).catch((err) => {
                        
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
                axios.get("/api/get-paymentplan-data-show/"+this.paymentplan_id)
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
