<template>
    <div class="col-lg-12">
        <section class="task-panel tasks-widget">
            <div class="panel-heading">
                <div class="pull-left"><h5><i class="fa fa-tasks"></i> Buy Fleets</h5></div>
                <br>
            </div>
            <div class="panel-body">
                <div class="task-content">

                    <ul class="task-list">
                        <li v-for="(fleet, index) in fleets">
                            <div class="task-title">
                                <span class="task-title-sp">{{ fleet.description.display_name }}</span>
                                <span class="badge bg-success">{{ fleetCount[index].count }}</span>
                                <div class="pull-right">
                                    <button @click="upgradeFleet(fleet.id, index)" class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                                </div>
                                <div class="slider pull-right">
                                    <vue-slider ref="slider" :width="200" v-model="fleetCount[index].count" :max="fleet.capacity - fleet.count" :disabled="(fleet.capacity - fleet.count) == 0"></vue-slider>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
    </div>
</template>

<style>

.task-content {
    margin-bottom: 30px;
}

.task-panel {
	background: #fff;
	text-align: left;
	box-shadow: 0px 3px 2px #aab2bd;
	margin: 5px;
}

.tasks-widget .task-content:after {
	clear: both;
}

.tasks-widget .task-footer  {
	margin-top: 5px;
}

.tasks-widget .task-footer:after,
.tasks-widget .task-footer:before {
	content: "";
	display: table;
	line-height: 0;
}

.tasks-widget .task-footer:after {
	clear: both;
}

.tasks-widget  .task-list {
  padding:0;
  margin:0;
}

.tasks-widget .task-list > li {
  position:relative;
  padding:10px 5px;
  border-bottom:1px dashed #eaeaea;
}

.tasks-widget .task-list  li.last-line {
  border-bottom:none;
}

.tasks-widget .task-list  li > .task-bell  {
  margin-left:10px;
}

.tasks-widget .task-list  li > .task-checkbox {
	float:left;
	width:30px;
}

.tasks-widget .task-list  li > .task-title  {
  overflow:hidden;
  margin-right:10px;
}

.tasks-widget .task-list  li > .task-config {
	position:absolute;
	top:10px;
	right:10px;
}

.tasks-widget .task-list  li .task-title .task-title-sp  {
  margin-right:5px;
}

.tasks-widget .task-list  li.task-done .task-title-sp  {
  text-decoration:line-through;
  color: #bbbbbb;
}

.tasks-widget .task-list  li.task-done  {
  background:#f6f6f6;
}

.tasks-widget .task-list  li.task-done:hover {
  background:#f4f4f4;
}

.tasks-widget .task-list  li:hover  {
  background:#f9f9f9;
}

.tasks-widget .task-list  li .task-config {
  display:none;
}

.tasks-widget .task-list  li:hover > .task-config {
  display:block;
  margin-bottom:0 !important;
}

.slider {
    margin-right: 10px;
}


@media only screen and (max-width: 320px) {

	.tasks-widget .task-config-btn {
		float:inherit;
		display:block;
	}

	.tasks-widget .task-list-projects li > .label {
		margin-bottom:5px;
	}

}
</style>

<script>

    import { EventBus } from '../eventBus.js';
    import vueSlider from 'vue-slider-component';

    export default{
        components: {
            vueSlider
        },
        data() {
            return{
                fleets: [],
                fleetCount: [
                    {count: 0},
                    {count: 0},
                    {count: 0},
                ],
                planetId: 0,
            }
        },
        props: {
            userId: {
                type:String,
                required: true
            }
        },
        methods: {
            getFleets(id) {
                this.$http.get('/planets/' + id + '/fleets').then(response => {
					this.fleets = response.body;
                });
            },
            EmitPlanetUpdateEvent() {
                EventBus.$emit('update-planet', this.planetId);
            },
            upgradeFleet(id, index) {
                this.$http.put('/fleets/' + id, {'amount': this.fleetCount[index].count}).then(response => {
                    if(response.body == 1) {
                        alert('Not enough metal');
                    } else {
                        this.getFleets(this.planetId);
                        this.fleetCount[index].count = 0;
                        this.EmitPlanetUpdateEvent();
                    }

                });
            }
        },
        created() {
            EventBus.$on('planet-changed', planet => {
                this.getFleets(planet.planet.id);
                this.planetId = planet.planet.id;
            });
        }
    }
</script>
