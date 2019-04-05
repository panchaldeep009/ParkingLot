<template>
    <div style="padding: 1.5em">
        <div class="font-weight-light title mb-2"> Your Ticket Number </div>
        <h3 class="display-1 font-weight-light orange--text mb-2">{{ticketNumber}}</h3>
        <div class="font-weight-light title mb-2"> Total Amount 
            {{car_status == 'paid' ? 'Paid' : 'Due'}}
            : <span style="color: green">$ {{total_amount_owe}}</span> </div><br/>
        <div class="font-weight-light paragraph mb-2">
            {{message}}<br/>
            Charged Hours : {{total_charged_hours}}<br/>
            Additional Charges per Hour : {{additional_amount_chared_per_hour}}<br/>
            Time Parked for : {{total_time_parked}}<br/>
        </div>
        <hr>
        <div v-if="car_status == 'parked'">
            <div class="font-weight-light title m-2"> Enter Your Cradit Card Number For Pay </div>
            <v-text-field
                class="m-2 pt-4"
                :color="error.credit_card ? 'red' : 'primary'"
                label="Cradit Card Number"
                prepend-icon="credit_card"
                v-model="creditCardNumber"
                mask="credit-card"
                :error="error.credit_card"
                :hint="error.credit_card && error.credit_card[0]"
            ></v-text-field>
            <v-btn color="blue" @click="pay" dark :loading="requestLoading">Pay Now</v-btn>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'TicketInfo',
        props: [ 
            'message', 
            'total_amount_owe', 
            'total_charged_hours', 
            'total_time_parked', 
            'additional_amount_chared_per_hour', 
            'car_status',
            'ticketNumber'
        ],
        data() {
            return {
                error: '',
                creditCardNumber: '',
                requestLoading: false,
            }
        },
        methods: {
            pay: function () {
                if (this.creditCardNumber != '') {
                    this.requestLoading = true;
                    const paymentInfo = new FormData();
                    paymentInfo.append('credit_card', this.creditCardNumber);

                    fetch('/api/payments/'+this.ticketNumber, {
                        method: 'POST',
                        body: paymentInfo,
                    })
                    .then((response) => {
                        return response.json();
                    })
                    .then((response) => {
                        if(response.status == 400){
                            this.error = response.error
                        } else {
                            this.car_status = 'paid';
                        }
                        this.requestLoading = false;
                    })
                    .catch(function (error) {
                        this.error = response.error
                        this.requestLoading = false;
                    });
                } else {
                    this.error = "Credit Card Number is Required";
                }
            },
        }
    }
</script>