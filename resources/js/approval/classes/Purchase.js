import { Model } from '@vuex-orm/core'

export default class Purchase extends Model {
    static entity = 'purchases'

    static fields() {
        return {
            id: this.attr(null),
            purchaseType: this.number(0),
            cashgroupId: this.string(''),
            numOfPayments: this.number(0),
            title: this.string(''),
            paymentDate: this.attr(null),
            receiveDate: this.attr(null),
            currency:this.string('KRW'),
            // attachments: [],
            purpose: this.string(''),
            supplierId: this.attr(null),
            // items:[
            //     {material_id: 3, unit: '', quantity: '0', unp: '', amount:'0'}
            // ],
            termOfPayment: this.string(''),
            paymentMethod: this.string(''),
            // normalLines:[{user_id: ''}],
            // forcedLines:[]
        }
    }
}
