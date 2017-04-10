<template>
    <div>
        <div class="showback">
            <h4><i class="fa fa-angle-right"></i> Outgoing Fleets</h4>
            <div v-if="outgoing.length > 0">
                <table class="table table-striped table-advance table-hover">
                    <thead>
                    <tr>
                        <th>Your Fleet</th>
                        <th>Duration</th>
                        <th>Enemy Planet</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="travel in outgoing">
                            <td>
                                Babylon 5: {{ travel.data.fleet[0] }} <br>
                                Battlestar Galactica: {{ travel.data.fleet[1] }} <br>
                                Stargate: {{ travel.data.fleet[2] }} <br>
                            </td>
                            <td width="40%">
                                <p>Arrives on {{ travel.data.arrival }}</p>
                                <div class="progress progress-striped active">
                                    <div :data-rate="travel.getPercentRatePerSecond" :data-width="travel.getTravelPercent" class="progress-bar"  role="progressbar" :style="{width: travel.getTravelPercent + '%'}"></div>
                                </div>
                            </td>
                            <td>{{ travel.data.to_planet.name }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div v-else>
                <h5>There are currently no Outgoing Attacks. Use your fleets to attack another planet and steal their resources!</h5>
            </div>
        </div>

        <div class="showback">
            <h4><i class="fa fa-angle-right"></i> Incoming Fleets</h4>
            <div v-if="incoming.length > 0">
                <table class="table table-striped table-advance table-hover">
                    <thead>
                    <tr>
                        <th>Status</th>
                        <th>Duration</th>
                        <th>Enemy Planet</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr v-for="travel in incoming">
                            <td>
                                <div v-if="travel.type == 'attacking'">
                                    Enemy is Attacking
                                </div>
                                <div v-else>
                                    Returning Fleet Carrying: <br>
                                    {{ travel.data.metal }} Metal <br>
                                    {{ travel.data.energy }} Crystal <br>
                                    {{ travel.data.crystal }} Energy <br>
                                </div>
                            </td>
                            <td width="40%">
                                <p>Arrives on {{ travel.data.arrival }}</p>
                                <div class="progress progress-striped active" style="transform: scaleX(-1)">
                                    <div :data-rate="travel.getPercentRatePerSecond" :data-width="travel.getTravelPercent" class="progress-bar progress-bar-danger"  role="progressbar" :style="{width: travel.getTravelPercent + '%'}"></div>
                                </div>
                            </td>
                            <td>{{ travel.data.from_planet.name}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div v-else>
                <h5>There are currently no Incoming Attacks. It's a good day.</h5>
            </div>
        </div>
    </div>
</template>

<script>

    import { EventBus } from '../eventBus.js';

    export default{
        data(){
            return{
                outgoing: [],
                incoming: [],
                planetId: 0,
            }
        },
        props: {
            userId: {
                type:String,
                required: true
            }
        },
        methods: {
            getTravels() {
                this.$http.get('/planets/'+this.planetId+'/travels').then(response => {
                    this.outgoing = response.body.outgoing;
                    this.incoming = response.body.incoming;
                });
            },
            travelStatusListener() {
                window.Echo.private('travel.status.'+this.userId).listen('TravelStatusChangedEvent', (object) => {
                    this.getTravels();
                    EventBus.$emit('update-planet', this.planetId);
                });
            },
            updateProgress(){
                let i;
                for(i = 0; i < this.outgoing.length; i++) {
                    let travel_rate = this.outgoing[i].getPercentRatePerSecond;

                    let width = this.outgoing[i].getTravelPercent;

                    let update = (travel_rate) + width;

                    this.outgoing[i].getTravelPercent = update;
                }

                for(i = 0; i < this.incoming.length; i++) {
                    let travel_rate = this.incoming[i].getPercentRatePerSecond;

                    let width = this.incoming[i].getTravelPercent;

                    let update = (travel_rate) + width;

                    this.incoming[i].getTravelPercent = update;
                }
            }
        },
        created() {
            EventBus.$on('planet-changed', planet => {
                this.planetId = planet.planet.id;
                this.getTravels();
            });
            this.travelStatusListener();
        },
        mounted() {
            window.setInterval( () => {
                this.updateProgress();
            }, 1000);
        },
    }
</script>
