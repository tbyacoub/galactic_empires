<template>
    <div class="col-lg-12">
        <div class="row content-panel">
            <div class="col-md-4 profile-text mt mb">
                <div class="btn-group">
                    <h3>Current Planet: <strong>{{selectedPlanet.getName()}}</strong></h3>
                    <button type="button" class="btn btn-theme dropdown-toggle" data-toggle="dropdown">
                        Planets <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li v-for="(planet, index) in planets"><a :id="index" @click="changePlanet" href="#">{{planet.name}}</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4 centered">
                <h5>Metal</h5>
                <div class="progress">
                    <div class="progress-bar progress-bar-success" role="progressbar"
                         :style="{width: selectedPlanet.getMetal() }">
                    </div>
                </div>
                <h5>Crystal</h5>
                <div class="progress">
                    <div class="progress-bar progress-bar-info" role="progressbar"
                         aria-valuemin="0" aria-valuemax="99999" :style="{width: selectedPlanet.getCrystal() }">
                    </div>
                </div>
                <h5>Energy</h5>
                <div class="progress">
                    <div class="progress-bar progress-bar-warning" role="progressbar"
                         aria-valuemin="0" aria-valuemax="99999" :style="{width: selectedPlanet.getEnergy() }"></div>
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

        getMetal(){
            return ((this.planet.resources.metal/99999)*100) + '%';
        }

        getCrystal(){
            return ((this.planet.resources.crystal/99999)*100) + '%';
        }

        getEnergy(){
            return ((this.planet.resources.energy/99999)*100) + '%';
        }

    }

    import { EventBus } from '../eventBus.js';

    export default{
        data(){
            return{
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
            }
        },
        created() {
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