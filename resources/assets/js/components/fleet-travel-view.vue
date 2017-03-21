<template>
    <div class="col-lg-12">
        <div class="row">
            <div v-for="" class="col-lg-4 col-md-4 col-sm-4 mb">
				<! -- ANIMATED PROGRESS BARS -->
				<div class="showback">
					<h4><i class="fa fa-angle-right"></i> Animated Progress Bars</h4>
					<div class="progress progress-striped active">
						<div class="progress-bar"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
							<span class="sr-only">45% Complete</span>
						</div>
					</div>
				</div><!-- /showback -->

			</div>
        </div>
    </div>
</template>

<script>

    import { EventBus } from '../eventBus.js';

    export default{
        data() {
            return{
                buildings: [],
				planetId: 0,
				active: false,
            }
        },
        props: {
            buildingType: {
                type: String,
                required: true
            },
            userId: {
                type:String,
                required: true
            }
        },
        methods: {
            getBuildings(id) {
                this.$http.get('/api/planet/' + id + '/' + this.buildingType).then(response => {
					this.buildings = response.body;
                });
            },
			EmitPlanetUpdateEvent() {
                EventBus.$emit('update-planet', this.planetId);
            },
            upgradeBuilding(id) {
                this.$http.post('/building/'+ id + '/upgrade').then(response => {
                    if(response.body != "false"){
                        this.getBuildings(this.planetId);
                        this.EmitPlanetUpdateEvent();
                    }
                });
            }
        },
        created() {
            EventBus.$on('planet-changed', planet => {
                this.getBuildings(planet.planet.id);
                this.planetId = planet.planet.id;
            });

            window.Echo.private('building.upgraded.' + this.userId).listen('BuildingHasUpgradedEvent', (object) => {
                this.getBuildings(this.planetId);
                this.EmitPlanetUpdateEvent();
            });
        }
    }
</script>
