<template>
    <div class="col-lg-12">
        <div class="row">
            <div v-for="building in buildings" class="col-lg-4 col-md-4 col-sm-4 mb">
				<div class="content-panel pn">
					<div id="spotify" :style="{ 'background': 'url(' + building.img_path + ') no-repeat center top' }">
						<div class="col-xs-4 col-xs-offset-8">
							<!--<button class="btn btn-sm btn-clear-g" :id="{building.pivot.building_id}" @click="upgradeBuilding"><a>UPGRADE</a></button>-->
							<button class="btn btn-sm btn-clear-g" @click="upgradeBuilding(building.pivot.id)"><a>UPGRADE</a></button>
						</div>
						<div class="sp-title">
							<h3>{{ building.display_name }}</h3>
						</div>
					</div>
					<p class="followers"><i class="fa fa-user"></i>LEVEL {{ building.pivot.current_level }}</p>
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
                buildings: []
            }
        },
        props: {
            buildingType: {
                type: String,
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
                    var temp = response.body;
                    console.log(temp);
                });
            }
        },
        created() {
            EventBus.$on('planet-changed', planet => {
                this.getBuildings(planet.planet.id);
            });
            window.Echo.private('building.upgraded.' + 71).listen('BuildingHasUpgradedEvent', (object) => {
                console.log("BUILDING UPGRADED EVENT");
            });
        }
    }
</script>
