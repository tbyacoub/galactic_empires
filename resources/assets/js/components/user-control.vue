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
                <h5>Metal: {{selectedPlanet.getMetal()}}</h5>
                <h5>Wood</h5>
                <h5>Energy</h5>
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
            return (100 - (this.planet.resources.metal/99999)*100) + '%';
        }

        getWood(){
            return (100 - (this.planet.resources.wood/99999)*100) + '%';
        }

        getEnergy(){
            return (100 - (this.planet.resources.energy/99999)*100) + '%';
        }

    }
    export default{
        data(){
            return{
                selectedPlanet: new Planet(),
            }
        },
        methods: {
            changePlanet: function(){
                this.selectedPlanet.setPlanet(this.planets[event.target.id]);
            }
        },
        created() {
            this.selectedPlanet.setPlanet(this.planets[0]);
        },
        props: {
            user: {
                type: Object,
                required: true
            },
            planets: {
                type: Array,
                required: true
            }
        }
    }
</script>
