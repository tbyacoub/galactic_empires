<template>
    <div>

        <div class="mail-option">
            <div class="btn-group hidden-phone">
                <a data-toggle="dropdown" href="#" class="btn mini blue">
                    Edit
                    <i class="fa fa-angle-down "></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="/mail" @click="mailApi('read')" id=""><i class="fa fa-pencil"></i> Mark as Read</a></li>
                    <li><a href="/mail" @click="mailApi('un-read')"><i class="fa fa-ban"></i> Mark as Unread</a></li>
                    <li><a href="/mail" @click="mailApi('favorite')"><i class="fa fa-star"></i> Mark as Favorite</a></li>
                    <li><a href="/mail" @click="mailApi('un-favorite')"><i class="fa fa-star"></i> Remove Favorite</a></li>
                    <li class="divider"></li>
                    <li><a href="/mail" @click="mailApi('delete')"><i class="fa fa-trash-o"></i> Delete</a></li>
                </ul>
            </div>
        </div>

        <div class="table-inbox-wrap ">
            <table class="table table-inbox table-hover">
                <tbody>
                <tr v-for="mail in mails" :class="[mail.read ? '':'unread']">
                    <td class="inbox-small-cells">
                        <input type="checkbox" class="mail-checkbox" :value="mail.id" v-model="checkedMail">
                    </td>
                    <td class="inbox-small-cells">
                        <i class="fa fa-star" :class="[mail.favorite ? 'inbox-started':'']"></i>
                    </td>
                    <td class="view-message dont-show">
                        <a :href="'/mail/' + mail.id">{{mail.sender.name}}</a>
                    </td>
                    <td class="view-message"><a :href="'/mail/' + mail.id">{{mail.subject}}</a></td>
                    <td class="view-message text-right"><small>{{mail.created_at}}<small></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
    export default{
        data(){
            return{
                checkedMail: [],
            }
        },
        props: {
            mails: {
                type: Array,
                required: true
            }
        },
        methods: {
            mailApi: function(method){
                this.$http.post('/mail/api', {'method': method, 'checked':this.checkedMail});
            },
        }
    }
</script>
