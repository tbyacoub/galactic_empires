<template>
    <div class="col-lg-12">
        <div class="row content-panel">
            <div class="col-md-4 profile-text mt mb">
                <div class="btn-group">
                    <h3>Current Planet: <strong>{{selectedPlanet.getName()}}</strong></h3>
                    <button type="button" class="btn btn-theme dropdown-toggle" data-toggle="dropdown">
                        Select Planet <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li v-for="(planet, index) in planets"><a :id="index" @click="changePlanet" href="#">{{planet.name}}</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4 centered">
                <h5>Metal <i>{{selectedPlanet.getMetalRatio()}}</i></h5>
                <div class="progress">
                    <div class="progress-bar progress-bar-success" role="progressbar"
                         :style="{width: selectedPlanet.getMetalPercent() }">
                    </div>
                </div>
                <h5>Crystal <i>{{selectedPlanet.getCrystalRatio()}}</i></h5>
                <div class="progress">
                    <div class="progress-bar progress-bar-info" role="progressbar"
                         :style="{width: selectedPlanet.getCrystalPercent() }">
                    </div>
                </div>
                <h5>Energy <i>{{selectedPlanet.getEnergyRatio()}}</i></h5>
                <div class="progress">
                    <div class="progress-bar progress-bar-warning" role="progressbar"
                         :style="{width: selectedPlanet.getEnergyPercent() }"></div>
                </div>
            </div>

            <div class="col-md-4 centered">
                <h5>Babylon 5 <i>{{selectedPlanet.getFleetRatio(0)}}</i></h5>
                <div class="progress">
                    <div class="progress-bar progress-bar-info" role="progressbar"
                         :style="{width: selectedPlanet.getFleetPercent(0) }"></div>
                </div>

                <h5>Battlestar Galactica <i>{{selectedPlanet.getFleetRatio(1)}}</i></h5>
                <div class="progress">
                    <div class="progress-bar progress-bar-info" role="progressbar"
                         :style="{width: selectedPlanet.getFleetPercent(1) }"></div>
                </div>

                <h5>Stargatess <i>{{selectedPlanet.getFleetRatio(2)}}</i></h5>
                <div class="progress">
                    <div class="progress-bar progress-bar-info" role="progressbar"
                         :style="{width: selectedPlanet.getFleetPercent(2) }"></div>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    class Planet {

        constructor(){
            this.planet = {};
        }

        setPlanet(planet){
            this.planet = planet;
        }

        getName(){
            return this.planet.name;
        }

        getMetalPercent(){
            return ((this.planet.resources.metal/this.planet.metal_storage)*100) + '%';
        }

        getCrystalPercent(){
            return ((this.planet.resources.crystal/this.planet.crystal_storage)*100) + '%';
        }

        getEnergyPercent(){
            return ((this.planet.resources.energy/this.planet.energy_storage)*100) + '%';
        }

        getMetalRatio() {
            return (' ( ' + this.planet.resources.metal + '/' + this.planet.metal_storage + ' )');
        }

        getCrystalRatio(){
            return (' ( ' + this.planet.resources.crystal + '/' + this.planet.crystal_storage + ' )');
        }

        getEnergyRatio(){
            return (' ( ' + this.planet.resources.energy + '/' + this.planet.energy_storage + ' )');
        }

        getFleetRatio(id){
            return (' ( ' + this.planet.fleets[id].count + '/' + this.planet.fleets[id].capacity + ' )');
        }

        getFleetPercent(id){
            return ((this.planet.fleets[id].count/this.planet.fleets[id].capacity)*100) + '%';
        }
    }

    import { EventBus } from '../eventBus.js';

    export default{
        data(){
            return {
                selectedPlanet: new Planet(),
                currentPlanets: this.planets,
                currentPlanet: 0
            }
        },
        methods: {
            resourceUpdateListener(){
                window.Echo.channel('resources.updated').listen('ResourceUpdatedEvent', (object) => {
                    this.getPlanets();
                });
            },
            getPlanets(){
                this.$http.get('/users/' + this.userId + '/planets').then(response => {
                    this.currentPlanets = response.body;
                    this.selectedPlanet.setPlanet(this.currentPlanets[this.currentPlanet]);
                });
            },
            changePlanet(){
                this.currentPlanet = parseInt(event.target.id);
                this.selectedPlanet.setPlanet(this.currentPlanets[this.currentPlanet]);
                this.emitEvent();
            },
            emitEvent(){
                EventBus.$emit('planet-changed', this.selectedPlanet);
            },
        },
        created() {
            //TODO emit planet changed event wont occur if this component was not working, thus planet not updating.
            EventBus.$on('update-planet', planetId => {
                this.getPlanets();
            });
            this.selectedPlanet.setPlanet(this.currentPlanets[this.currentPlanet]);
        },
        mounted() {
            this.emitEvent();
            this.resourceUpdateListener()
        },
        props: {
            planets: {
                type: Array,
                required: true
            },
            userId: {
                type:String,
                required: true
            }
        },
    }
</script>