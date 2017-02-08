<template>
    <ul class="nav top-menu">
        <li id="header_inbox_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#">
                <i class="fa fa-envelope-o"></i>
                <span class="badge bg-theme">{{ messages.length }}</span>
            </a>
            <ul class="dropdown-menu extended inbox">
                <div class="notify-arrow notify-arrow-green"></div>
                <li>
                    <p class="green">You have {{ messages.length }} new messages</p>
                </li>
                <li v-for="message in messages">
                    <a href="index.html#">
                        <span class="photo"><img alt="avatar" src="/img/ui-zac.jpg"></span>
                        <span class="subject">
                                    <span class="from">{{ message.sender.name }}</span>
                                    <span class="time">{{ message.created_at }}</span>
                                    </span>
                        <span class="message">
                            {{ message.subject }}
                        </span>
                    </a>
                </li>
                <li>
                    <a href="/inbox">See all messages</a>
                </li>
            </ul>
        </li>
    </ul>
</template>

<style></style>

<script>
    export default{
        data(){
            return{
                messages: [],
            }
        },
        methods: {
            getInbox: function() {
                this.$http.get('/api/msg/get-private-message-notifications').then(response => {
                    this.messages = response.body;
                }, response => {
                    console.log(response);
                });
            }
        },
        components:{

        },
        beforeMount() {
            this.getInbox();
        }
    }
</script>
