<template>
 <div class="chat-meta">
    <!-- Chat Box Right -->
    <div v-for="message in messages">
         <div class="d-flex" :class="message.user.id == user.id ? 'chat-box-right justify-content-start' : 'chat-box-left justify-content-end'">
            <div class="chat-box">
                <div class="chat-text">
                    <p> {{ message.content }}</p>
                </div>
                <div class="chat-time text-left">
                    <time> {{ message.created_at }}</time>
                </div>
            </div>
        </div>
    </div>
</div>
</template>
<script>
  export default {
    props: ['messages','user']
  };
</script>