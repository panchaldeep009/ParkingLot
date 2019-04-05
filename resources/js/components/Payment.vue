<template>
    <v-card
        class="mx-auto"
        color="grey lighten-4"
        max-width="600"
        >
        <v-img
            :aspect-ratio="16/9"
            src="https://images.pexels.com/photos/1004409/pexels-photo-1004409.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940"
        >
        </v-img>
        <v-card-text
            class="pt-4"
            style="position: relative; width: max-content" >
            <v-btn
                @click="$root.$emit('navTo', 'Home')"
                absolute color="orange" class="white--text"
                fab large left top>
                <v-icon>mdi-home</v-icon>
            </v-btn>
            <div v-if="!ticketData" style="padding: 1.5em">
                <div class="font-weight-light title m-2"> Enter Your Ticket Number </div>
                <v-text-field
                    class="m-2 pt-4"
                    :color="error.length ? 'red' : 'primary'"
                    label="Ticket Number"
                    prepend-icon="confirmation_number"
                    v-model="ticketNumber"
                    :error="error!=''"
                    :hint="error"
                ></v-text-field>
                <v-btn color="blue" @click="getTicketInfo" dark :loading="requestLoading">Check out now</v-btn>
            </div>
            <TicketInfo v-if="ticketData" v-bind="ticketData"></TicketInfo>
        </v-card-text>
    </v-card>
</template>

<script>
    import TicketInfo from './TicketInfo.vue';
    export default {
        name: 'Payment',
        data() {
            return {
                ticketData: false,
                ticketNumber: '',
                thisTicket: '',
                error: '',
                requestLoading: false
            }
        },
        components: { TicketInfo },
        methods: {
            getTicketInfo: function () {
                if (this.ticketNumber != '') {
                    this.requestLoading = true;
                    fetch('/api/tickets/'+this.ticketNumber)
                    .then((response) => {
                        return response.json();
                    })
                    .then((response) => {
                        this.requestLoading = false;
                        // this.ticketData = true;
                        if (response.status == 404) {
                            this.error = response.message
                        } else {
                            this.ticketData = response;
                            this.ticketData.ticketNumber = this.ticketNumber;
                        }
                    })
                    .catch(function (error) {
                        this.error = response.error
                    });
                } else {
                    this.error = "Ticket Number is Required";
                }
            },
        }
    }
</script>