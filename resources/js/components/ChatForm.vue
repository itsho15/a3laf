<template>
    
    <div class="chat-bottom">
        <textarea name="content" class="form-control" placeholder="Type your message here..." v-model="newMessage" @keyup.enter="sendMessage"></textarea>
        <button class="send-btn" id="btn-chat" @click="sendMessage"><i class="fas fa-paper-plane"></i></button>
    </div>
</template>

<script>
    export default {
        props: ['user','conversation_id'],
        data() {
            return {
                newMessage: ''
            }
        },
        methods: {
            sendMessage() {
                this.$emit('messagesent', {
                    user: this.user,
                    content: this.newMessage,
                    conversation_id: this.conversation_id,
                });
                this.newMessage = ''
            }
        }    
    }
</script>