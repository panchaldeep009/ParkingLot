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
            style="position: relative;" >
            <v-btn
                absolute color="orange" class="white--text"
                fab large right top>
                <v-icon>mdi-cart</v-icon>
            </v-btn>
            <h3 class="display-1 font-weight-light orange--text mb-2">Car Park</h3>
            <div class="font-weight-light title mb-2"> $5 / hour * </div>
            <v-btn large color="blue" class="white--text" @click="$root.$emit('navTo', 'Ticket')"> Check-in</v-btn>
            <v-btn large @click="$root.$emit('navTo', 'Payment')"> Check-Out</v-btn>
            <div class="font-weight-light grey--text paragraph mb-2">
                * The price would increases by 50% for following each rate level : 1hr, 3hr, 6hr, or ALL DAY
            </div>
        </v-card-text>
    </v-card>
</template>

<script>
    export default {
        name: "Home"
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