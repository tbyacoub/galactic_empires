<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Example Component</div>

                    <div class="panel-body">
                        {{ power }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                power: 0,
            }
        },
        mounted() {
            console.log('Component mounted.');
            window.Echo.private('test.channel').listen('MyEventNameHere', (object) => {
                console.log(object);
                this.power = object.data.power;
            });
        }
    }
</script>
