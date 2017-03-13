<template>
	<div class="col-lg-12">
		<div class="row">
			<div v-for="building in buildings" class="col-lg-4 col-md-4 col-sm-4 mb">
				<div class="content-panel pn">
					<div id="spotify" :style="{ 'background': 'url(' + building.img_path + ') no-repeat center top' }">
						<div v-if="building.pivot.is_upgrading == 0" class="col-xs-4 col-xs-offset-8">
							<button v-show="building.pivot.current_level != building.upgrades[0].max_level" class="btn btn-sm btn-clear-g" @click="upgradeBuilding(building.pivot.id)"><a>UPGRADE</a></button>
						</div>
						<div v-else class="col-xs-4 col-xs-offset-8">
							<button class="btn btn-sm btn-clear-g" disabled><a>UPGRADING</a></button>
						</div>
						<div class="sp-title">
							<h3>{{ building.display_name }}</h3>
						</div>
					</div>
					<p class="followers"><i class="fa fa-user"></i> <span v-show="building.pivot.current_level == building.upgrades[0].max_level"> MAX -</span> LEVEL {{ building.pivot.current_level }}</p>
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
            upgradeBuilding(id) {
                console.log(id);
                this.$http.post('/upgrade-building/'+ id).then(response => {
                    console.log(response.body);
                this.getBuildings(this.planetId);
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
        });
        }
    }
</script>