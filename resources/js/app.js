/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
Vue.prototype.laravel = window.Laravel;
Vue.prototype.global = {};

import Pusher from "pusher-js"

import Echo from 'laravel-echo'

window.Echo = new Echo({
  broadcaster: 'pusher',
  key: '719dadbd79115f7555a7',
  cluster: 'eu',
  forceTLS: true
});

Vue.component('chat-messages', require('./components/ChatMessages.vue').default);
Vue.component('chat-form', require('./components/ChatForm.vue').default);

const app = new Vue({
    el: '#app',
    data() {
        return {
            messages: []
        }
     },
    created() {
        this.fetchMessages();
        let converation = $('#conversation_id').val();
    },
    mounted(){
      let converation = $('#conversation_id').val();
    	var channel = window.Echo.channel(`conversation.${converation}`);
	    channel.listen('.message-posted', (data) => {
	    	this.messages.push({
			      content: data.message.content,
			      user: data.message.user
			    });
	    });
  		this.scrollToEnd();
	},
	updated () {
	  	this.scrollToEnd(); 
	},
    methods: {
        fetchMessages() {
        	let converation = $('#conversation_id').val();
            axios.get(`/conversation/messages/${converation}`).then(response => {
                this.messages = response.data.messages;
            });
        },
        addMessage(message) {
            this.messages.push(message);
            axios.post('/conversation/messages', message).then(response => {
                  console.log(response.data);
             });
        },
        scrollToEnd () {
      		var chatwapper = this.$refs.chatwapper;
	      	chatwapper.scrollTop = chatwapper.scrollHeight;
	    }
    }
});

