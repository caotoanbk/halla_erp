<template>
    <div class="row mt-3 w-100">
        <div class="col-md-8">
            <h3 class="text-center">
                출금 계획 - Payment Plan
            </h3>
            <p class="text-center"><datepicker wrapper-class="d-inline-block" @input="form.date_payment = fixDate($event)" 
            format="yyyy-MM-dd" v-model="form.date_payment" input-class=""></datepicker></p>
            <table class="w-100 ml-3">
                <tr>
                    <td>USD/KRW</td>
                    <td><input type="number" class="w-100"></td>
                    <td>VND/KRW</td>
                    <td><input type="number" class="w-100"></td>
                    <td>USD/VND</td>
                    <td><input type="number" class="w-100"></td>
                </tr>
            </table>
            <table class="w-100 ml-3 mt-3">
                <thead>
                    <tr>
                        <th rowspan="2" style="width: 10%">Bank</th>
                        <th style="width: 10%">구분</th>
                        <th style="width: 5%">계정과목</th>
                        <th style="width: 10%">지출처</th>
                        <th>내용</th>
                        <th style="width: 10%">금액</th>
                        <th style="width: 20%">비고</th>
                    </tr>
                    <tr>
                        <th>Sortation</th>
                        <th>Acc Code</th>
                        <th>Supplier</th>
                        <th>Content</th>
                        <th>Amount</th>
                        <th>BP number</th>
                    </tr>
                </thead>
                <tbody>
                    <template v-for="(bank,index) in banks">
                    <tr :key="bank.id">
                        <td :rowspan="banks[index].length * 3 + 3">{{index}}</td>
                        <td>{{banks[index][0].BankAccount}}</td>
                        <td>1</td>
                        <td></td>
                        <td></td>
                        <td>0</td>
                        <td></td>
                    </tr>
                    <tr :key="bank.id">
                        <td colspan="2">Sub Total</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr :key="bank.id">
                        <td colspan="2">KRW</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <template v-for="b in banks[index].slice(1)">
                    <tr :key="b.id">
                        <td>{{b.BankAccount}}</td>
                        <td>1</td>
                        <td></td>
                        <td></td>
                        <td>0</td>
                        <td></td>
                    </tr>
                    <tr :key="b.id">
                        <td colspan="2">Sub Total</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr :key="b.id">
                        <td colspan="2">KRW</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    </template>
                    <tr :key="bank.id">
                        <td colspan="2">Total VND</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr :key="bank.id">
                        <td colspan="2">Total USD</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr :key="bank.id">
                        <td colspan="2">Total KRW</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    </template>
                </tbody>
                <tfoot>

                    <tr>
                        <td colspan="2">Total VND</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>2,090,000</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">Total USD</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>0</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">Total KRW</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>105,963</td>
                        <td></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="col-md-4">
            <h3>선택 요청 - Select request</h3>
            <v-select multiple
                :options="purchaseOptions" 
                :getOptionLabel="u => (u.docNumber + ' # ' + u.supplier_name + ' # ' + u.total_amount_format + ' # ' + u.title )"  
                :reduce="purchase => purchase.id" 
                v-model="selectedPurchases"
            />
            <div class="mt-5 pt-4">
                <template v-for="(bank,index) in banks" >
                    <button class="btn btn-block btn-outline-secondary" v-for="b in banks[index]" :key="b.id">Add {{b.BankAccount}}</button>
                </template>
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
                    docno: ''
                }),
                purchaseOptions: null,
                selectedPurchases: [],
                banks: null,
                items: [
                    {id: null, bank_id: 2, supplier: '', content: '', amount: '', purchaserequest_id: ''}
                ],
                paymentplan: null
            }
        },
        methods: {
            fixDate(event) {
                return moment(event).format('YYYY-MM-DD')
            },
            loadData(){
                axios.get("/api/get-paymentplan-data/"+this.paymentplan_id).then(({data}) => {
                    this.form.fill(data.paymentplan[0])
                    this.paymentplan = data.paymentplan[0]
                    this.purchaseOptions = data.purchases
                    this.banks = data.banks
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
