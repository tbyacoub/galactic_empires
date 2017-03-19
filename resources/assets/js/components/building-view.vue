<template>
    <div class="col-lg-12">
        <div class="row">
            <div v-for="building in buildings" class="col-lg-4 col-md-4 col-sm-4 mb">
				<div class="content-panel pn">
					<div id="spotify" :style="{ 'background': 'url(' + building.description.img_path + ') no-repeat center top' }">
						<div class="col-xs-4 col-xs-offset-8" v-if="building.current_level < building.upgrade.max_level">
							<button v-if="!building.is_upgrading" class="btn btn-sm btn-clear-g" @click="upgradeBuilding(building.id)"><a>UPGRADE</a></button>
                            <button v-else="!building.is_upgrading" class="btn btn-sm btn-clear-g" disabled=""><a>UPGRADING</a></button>
						</div>
						<div class="sp-title">
							<h3>{{ building.description.display_name }}</h3>
						</div>
					</div>
					<p class="followers"><i class="fa fa-user"></i> <span v-show="building.current_level == building.upgrade.max_level"> MAX -</span> LEVEL {{ building.current_level }}</p>
				</div>
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
