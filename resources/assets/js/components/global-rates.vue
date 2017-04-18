<template>
    <div class="row mt">
        <div class="col-lg-12">
            <section class="task-panel tasks-widget">
                <div class="panel-heading">
                    <div class="pull-left"><h5><i class="fa fa-tasks"></i> Game Setting</h5></div>
                    <br>
                </div>
                <div class="panel-body">
                    <div class="task-content">

                        <ul class="task-list">
                            <li>

                                <div class="task-title">
                                    <span class="task-title-sp">Metal Gather Rate</span>
                                    <span class="badge bg-success">{{ count[0] }}</span>
                                    <div class="pull-right">
                                        <button @click="update(0)" class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                                    </div>
                                    <div class="slider pull-right">
                                        <vue-slider ref="slider" :width="200" v-model="count[0]" :min="1" :max="9"></vue-slider>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="task-title">
                                    <span class="task-title-sp">Crystal Gather Rate</span>
                                    <span class="badge bg-success">{{ count[1] }}</span>
                                    <div class="pull-right">
                                        <button @click="update(1)" class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                                    </div>
                                    <div class="slider pull-right">
                                        <vue-slider ref="slider" :width="200" v-model="count[1]" :min="1" :max="9"></vue-slider>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="task-title">
                                    <span class="task-title-sp">Energy Gather Rate</span>
                                    <span class="badge bg-success">{{ count[2] }}</span>
                                    <div class="pull-right">
                                        <button @click="update(2)" class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                                    </div>
                                    <div class="slider pull-right">
                                        <vue-slider ref="slider" :width="200" v-model="count[2]" :min="1" :max="9"></vue-slider>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="task-title">
                                    <span class="task-title-sp">Ship Build Rate</span>
                                    <span class="badge bg-success">{{ count[3] }}</span>
                                    <div class="pull-right">
                                        <button @click="update(3)" class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                                    </div>
                                    <div class="slider pull-right">
                                        <vue-slider ref="slider" :width="200" v-model="count[3]" :min="1" :max="9"></vue-slider>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="task-title">
                                    <span class="task-title-sp">Ship Build Cost Rate</span>
                                    <span class="badge bg-success">{{ count[4] }}</span>
                                    <div class="pull-right">
                                        <button @click="update(4)" class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                                    </div>
                                    <div class="slider pull-right">
                                        <vue-slider ref="slider" :width="200" v-model="count[4]" :min="1" :max="9"></vue-slider>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="task-title">
                                    <span class="task-title-sp">Building Build Time Rate</span>
                                    <span class="badge bg-success">{{ count[5] }}</span>
                                    <div class="pull-right">
                                        <button @click="update(5)" class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                                    </div>
                                    <div class="slider pull-right">
                                        <vue-slider ref="slider" :width="200" v-model="count[5]" :min="1" :max="9"></vue-slider>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="task-title">
                                    <span class="task-title-sp">Building Cost Rate</span>
                                    <span class="badge bg-success">{{ count[6] }}</span>
                                    <div class="pull-right">
                                        <button @click="update(6)" class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                                    </div>
                                    <div class="slider pull-right">
                                        <vue-slider ref="slider" :width="200" v-model="count[6]" :min="1" :max="9"></vue-slider>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="task-title">
                                    <span class="task-title-sp">Research Rate</span>
                                    <span class="badge bg-success">{{ count[7] }}</span>
                                    <div class="pull-right">
                                        <button @click="update(7)" class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                                    </div>
                                    <div class="slider pull-right">
                                        <vue-slider ref="slider" :width="200" v-model="count[7]" :min="1" :max="9"></vue-slider>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="task-title">
                                    <span class="task-title-sp">Travel Rate</span>
                                    <span class="badge bg-success">{{ count[8] }}</span>
                                    <div class="pull-right">
                                        <button @click="update(8)" class="btn btn-success btn-xs"><i class="fa fa-check"></i></button>
                                    </div>
                                    <div class="slider pull-right">
                                        <vue-slider ref="slider" :width="200" v-model="count[8]" :min="1" :max="200"></vue-slider>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </section>
        </div>
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

    import vueSlider from 'vue-slider-component';

    export default{
        components: {
            vueSlider
        },
        props: {
            settings: {
                type: Array,
                required: true,
            }
        },
        data() {
            return{
                name: [
                    'metal_rate',
                    'energy_rate',
                    'crystal_rate',
                    'ship_build_time_rate',
                    'ship_cost_rate',
                    'building_build_time_rate',
                    'building_cost_rate',
                    'research_rate',
                    'travel_rate',
                ],
                count: [
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                    0,
                ]
            }
        },
        methods: {
            update(index) {
                this.$http.put('/global-rates', {'param': this.name[index], 'value': this.count[index]});
            }
        },
        created() {
            this.count[0] = this.settings[0][this.name[0]];
            this.count[1] = this.settings[0][this.name[1]];
            this.count[2] = this.settings[0][this.name[2]];
            this.count[3] = this.settings[0][this.name[3]];
            this.count[4] = this.settings[0][this.name[4]];
            this.count[5] = this.settings[0][this.name[5]];
            this.count[6] = this.settings[0][this.name[6]];
            this.count[7] = this.settings[0][this.name[7]];
            this.count[8] = this.settings[0][this.name[8]];
        }
    }
</script>
