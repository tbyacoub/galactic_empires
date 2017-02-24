<template>
    <div>
        <h1>{{planet.name}}</h1>
    </div>
</template>

<script>

    export default{
        props: {
            planets: {
                type: Array,
                required: true
            }
        },
        data(){
            return{
                planet: null,
            }
        },
        created() {
            this.planet = this.planets[0];
            EventBus.$on('changePlanet', planet => {
              this.planet = planet;
            });
        }
    }

</script>
