<template>
    <div class="app-container">
        <Home v-if="nav=='Home'"></Home>
        <Ticket v-if="nav=='Ticket'" v-bind="newTicket"></Ticket>
        <Payment v-if="nav=='Payment'"></Payment>
    </div>
</template>

<script>
    import Home from './components/Home.vue';
    import Ticket from './components/Ticket.vue';
    import Payment from './components/Payment.vue';
    export default {
        name: "App",
        data() {
            return  {
                nav: 'Home',
                newTicket: ''
            }
        },
        components: { Home, Ticket, Payment },
        mounted() {
            this.$root.$on('navTo', (nav) => {
                if (nav == 'Ticket') {
                    
                } else {
                    
                }
                switch (nav) {
                    case 'Ticket':
                        fetch('/api/tickets', {
                            method: 'POST'
                        })
                        .then((response) => {
                            return response.json();
                        })
                        .then((response) => {
                            if (response.status == 404) {
                                this.newTicket = {};
                                this.newTicket.error = response.message;
                            } else {
                                this.newTicket = response;
                                this.newTicket.error = false;
                            }
                            this.nav = nav;
                        })
                        .catch(function (error) {
                            this.newTicket = {};
                            this.newTicket.error = response.error;
                            this.nav = nav;
                        });
                        break;
                    default:
                        this.nav = nav;
                        break;
                }
            });
        }
    }
</script>
<style>

.app-container {
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
</style>