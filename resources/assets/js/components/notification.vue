<template>
    <ul class="nav top-menu">
        <li id="header_inbox_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle">
                <i class="fa fa-envelope-o"></i>
                <span class="badge bg-theme">{{ mails.length }}</span>
            </a>
            <ul class="dropdown-menu extended inbox">
                <div class="notify-arrow notify-arrow-green"></div>
                <li>
                    <p class="green">You have {{ mails.length }} new mails</p>
                </li>
                <li v-for="mail in mails">
                    <a :href="'/mail/' + mail.id">
                        <span class="photo"><img alt="avatar" src="/img/ui-zac.jpg"></span>
                        <span class="subject">
                                    <span class="from">{{ mail.sender.name }}</span>
                                    <span class="time">{{ mail.created_at }}</span>
                                    </span>
                        <span class="message">
                            {{ mail.subject }}
                        </span>
                    </a>
                </li>
                <li>
                    <a href="/mail">See all mails</a>
                </li>
            </ul>
        </li>
    </ul>
</template>

<script>
    export default{
        props: {
            user_id: {
                type:Number,
                required: true
            }
        },
        data(){
            return{
                mails: [],
            }
        },
        methods: {
            getInbox: function() {
                this.$http.get('/mail/api/get-notifications').then(response => {
                    this.mails = response.body;
                }, response => {
                    console.log(response);
                });
            }
        },
        created() {
            this.getInbox();
            window.Echo.private('received.email.' + this.user_id).listen('EmailSentEvent', (object) => {
                this.getInbox();
            });
        }
    }

</script>
