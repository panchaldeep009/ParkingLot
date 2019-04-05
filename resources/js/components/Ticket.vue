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
            <div v-if="!error" style="padding: 1.5em">
                <div class="font-weight-light title mb-2"> Your Ticket Number </div>
                <h3 class="display-1 font-weight-light orange--text mb-2">{{ticket_number}}</h3>
                <div class="font-weight-light title mb-2"> Available Space : {{available_space}}/6 </div>
                <div class="font-weight-light grey--text paragraph mb-2">
                    * The price would increases by 50% for following each rate level : 1hr, 3hr, 6hr, or ALL DAY
                </div>
            </div>
            <div v-if="error" class="font-weight-light red--text title mb-2 pt-4">{{error}}</div>
        </v-card-text>
    </v-card>
</template>

<script>
    export default {
        data() {
            return { }
        },
        props: ['ticket_number', 'available_space', 'error']
    }
</script>