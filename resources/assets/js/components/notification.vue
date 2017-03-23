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
                    <a :href="'/mails/' + mail.id">
                        <span class="photo"><img alt="avatar" src="/img/ui-zac.jpg"></span>
                        <span class="subject">
                                    <span class="from">{{ mail.sender.name }}</span>
                                    <span class="time"><small>{{ mail.created_at }}</small></span>
                                    </span>
                        <span class="message">
                            {{ mail.subject }}
                        </span>
                    </a>
                </li>
                <li>
                    <a href="/mail/inbox">See all mails</a>
                </li>
            </ul>
        </li>

        <li id="header_notification_bar" class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle">
                <i class="fa fa-tasks"></i>
                <span class="badge bg-theme">{{ notifications.length }}</span>
            </a>
            <ul class="dropdown-menu extended inbox">
                <div class="notify-arrow notify-arrow-green"></div>
                <li>
                    <p class="green">You have {{ notifications.length }} new notifications</p>
                </li>
                <li v-for="notification in notifications">
                    <a href="/notifications">
                        <span class="photo"><img alt="avatar" src="/img/ui-zac.jpg"></span>
                        <span class="subject">
                                    <span class="time"><small>{{ notification.created_at }}</small></span>
                                    </span>
                        <span class="message">
                            {{ notification.subject }}
                        </span>
                    </a>
                </li>
                <li>
                    <a href="/notifications">See all notifications</a>
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
                notifications: []
            }
        },
        methods: {
            getInbox: function() {
                this.$http.get('/users/' + this.user_id + '/mails').then(response => {
                    this.mails = response.body;
                }, response => {
                    console.log(response);
                });
            },
            getNotifications: function() {
                this.$http.get('/users/' + this.user_id + '/notifications').then(response => {
                    this.notifications = response.body;
                }, response => {
                    console.log(response);
                });
            }
        },
        created() {
            this.getInbox();
            this.getNotifications();
            window.Echo.private('received.email.' + this.user_id).listen('EmailSentEvent', (object) => {
                this.getInbox();
            });
            window.Echo.private('received.notification.' + this.user_id).listen('NotificationReceivedEvent', (object) => {
                this.getNotifications();
            });
        }
    }

</script>
