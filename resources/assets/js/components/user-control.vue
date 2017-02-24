<template>
    <div v-if="render" class="col-lg-12">
        <div class="row content-panel">
            <div class="col-md-4 profile-text mt mb">
                <div class="btn-group">
                    <h3>Current Planet: <strong>{{ getName }}</strong></h3>
                    <button type="button" class="btn btn-theme dropdown-toggle" data-toggle="dropdown">
                        Planets <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu">
                        <li v-for="(planet, index) in getPlanets"><a :id="index" @click="changePlanet" href="#">{{planet.name}}</a></li>
                    </ul>
                </div>
            </div>

            <div class="col-md-4 centered">
                <h5>Metal</h5>
                <div class="progress">
                    <div class="progress-bar progress-bar-success" role="progressbar"
                         aria-valuemin="0" aria-valuemax="99999" :style="{width: getMetal }">
                    </div>
                </div>
                <h5>Crystal</h5>
                <div class="progress">
                    <div class="progress-bar progress-bar-info" role="progressbar"
                         aria-valuemin="0" aria-valuemax="99999" :style="{width: getCrystal }">
                    </div>
                </div>
                <h5>Energy</h5>
                <div class="progress">
                    <div class="progress-bar progress-bar-warning" role="progressbar"
                         aria-valuemin="0" aria-valuemax="99999" :style="{width: getEnergy }"></div>
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

    export default{
        methods: {
            changePlanet: function(){
                this.$store.commit('SET_PLANET', event.target.id);
            },
            setPlanets() {
                this.$http.get('/api/planets').then(response => {
                    this.$store.commit('SET_PLANETS', response.body);
                });
            }
        },
        created() {
            this.setPlanets();
        },
        computed: {
            getName() {
                return this.$store.getters.getName
            },
            getPlanets() {
                return this.$store.getters.getPlanets
            },
            getMetal(){
                return this.$store.getters.getMetal
            },
            getCrystal(){
                return this.$store.getters.getCrystal
            },
            getEnergy(){
                return this.$store.getters.getEnergy
            },
            render(){
                return this.$store.getters.render
            }
        }
    }
</script>
