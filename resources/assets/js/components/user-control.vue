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
                <h5>Dashboard Update (40%)</h5>
                <div class="progress">
                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                        <span class="sr-only">40% Complete (success)</span>
                    </div>
                </div>

                <h5>Unanswered Messages (80%)</h5>
                <div class="progress">
                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                        <span class="sr-only">80% Complete (success)</span>
                    </div>
                </div>

                <h5>Product Review (60%)</h5>
                <div class="progress">
                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                        <span class="sr-only">60% Complete (success)</span>
                    </div>
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
                this.$http.get('/api/planets').then(response => {
                    this.currentPlanets = response.body;
                this.selectedPlanet.setPlanet(this.currentPlanets[this.currentPlanet]);
            }, response => {
                    console.log(response);
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
            updatePlanet: function (id) {
                this.$http.get('/planet/'+ id ).then(response => {
                    this.selectedPlanet.setPlanet(response.body);
                });
            }
        },
        created() {

            EventBus.$on('update-planet', planetId => {
                this.updatePlanet(planetId);
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
            }
        },
    }
</script>