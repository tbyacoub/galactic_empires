<template>
    <div class="col-lg-12">
		
    </div>
</template>

<script>

    import { EventBus } from '../eventBus.js';

    export default{
        data() {
            return{
                planet: {},
            }
        },
        props: {
            userId: {
                type:String,
                required: true
            }
        },
        created() {
            EventBus.$on('planet-changed', planet => {
                this.planet = planet;
            });
        }
    }
</script>
