<template>
    <div class="col-lg-12">
        <div class="row mt">
            <div v-for="building in buildings" class="col-lg-4 col-md-4 col-sm-4 mb">
				<div class="content-panel pn">
					<div id="spotify" :style="{ 'background': 'url(' + building.building_prototype.img_path + ') no-repeat center top' }">
						<div class="col-xs-4 col-xs-offset-8">
							<button class="btn btn-sm btn-clear-g"><a :href="'/resources/'+building.id">UPGRADE</a></button>
						</div>
						<div class="sp-title">
							<h3>{{ building.name }}</h3>
						</div>
						<div class="play">
							<i class="fa fa-play-circle"></i>
						</div>
					</div>
					<p class="followers"><i class="fa fa-user"></i>LEVEL {{ building.current_level }}</p>
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
            upgradeClicked() {
                console.log('test');
            }
        },
        created() {
            EventBus.$on('planet-changed', planet => {
                this.getBuildings(planet.planet.id);
            });
        }
    }
</script>
