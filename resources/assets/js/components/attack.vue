<template>
    <!-- COMPLEX TO DO LIST -->
    <div class="row">
        <div class="col-md-12">
            <section class="task-panel tasks-widget">
                <div class="panel-heading">
                    <div class="pull-left"><h5><i class="fa fa-tasks"></i> Attacking fleets</h5></div>
                    <div class="pull-right"><h5><i class="fa fa-tasks"></i> Travel Time: x min</h5></div>
                    <br>
                </div>
                <div class="panel-body">
                    <div class="task-content">

                        <ul class="task-list">
                            <li v-for="(fleet, index) in fleets">
                                <div class="task-title">
                                    <span class="task-title-sp">{{ fleet.description.display_name }}</span>
                                    <span class="badge bg-success">{{ fleetCount[index].count }}</span>
                                    <div class="slider pull-right">
                                        <vue-slider ref="slider" :width="200" v-model="fleetCount[index].count" :max="fleet.count" :disabled="fleet.count == 0"></vue-slider>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <div class=" add-task-row">
                        <a class="btn btn-success btn-sm pull-left" href="todo_list.html#">Attack</a>
                    </div>
                </div>
            </section>
        </div><!-- /col-md-12-->
    </div><!-- /row -->
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
        methods: {
            getFleets(id) {
                this.$http.get('/planets/' + id + '/fleets').then(response => {
					this.fleets = response.body;
                });
            },
        },
        created() {
            EventBus.$on('planet-changed', planet => {
                this.getFleets(planet.planet.id);
                this.planetId = planet.planet.id;
            });
        }
    }
</script>
