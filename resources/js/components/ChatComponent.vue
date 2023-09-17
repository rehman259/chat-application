<template>
	<div class="chat card" style="background-color: #f0f0f0;">
		<div class="scrollable card-body" ref="hasScrolledToBottom">
			<template v-for="message in messages">
				<div class="message message-receive" v-if="user.id != message.user.id">
					<p>
						<strong class="primary-font">
							{{ message.user.name }} :
						</strong>
						{{ message.message }}
					</p>
				</div>
				<div class="message message-send" v-else>
					<p>
						<strong class="primary-font">
							{{ message.user.name }} :
						</strong>
						{{ message.message }}
					</p>
				</div>
			</template>
			<!-- Typing indicator -->
			<div class="typing-indicator" v-if="isTyping">
				<span>{{ typingUser }} is typing...</span>
				<div class="typing-bubbles"></div>
			</div>
		</div>

		<div class="chat-form input-group">

			<input id="btn-input" type="text" name="message" class="form-control input-sm message-"
				placeholder="Type your message here..." v-model="newMessage" @input="handleInput" @blur="stopTyping"
				@keydown.enter="sendMessage">

			<span class="input-group-btn">
				<button class="btn btn-primary" id="btn-chat" @click="addMessage">
					Send
				</button>
			</span>
		</div>

	</div>
</template>

<script>
import { ref, onMounted, onUpdated } from 'vue';
import axios from 'axios';
export default {
	props: ['user'],
	setup(props) {
		let messages = ref([])
		let newMessage = ref('')
		let hasScrolledToBottom = ref('')
		let isTyping = ref(false);
		let typingUser = ref('');

		const handleInput = () => {
			if (newMessage.value.trim() === '') {
				stopTyping();
			} else {
				startTyping();
			}
		};

		onMounted(() => {
			fetchMessages();
		})

		onUpdated(() => {
			scrollBottom();
		})

		const startTyping = () => {
			// Emit 'startTyping' event to notify others
			Echo.private('chat-channel').whisper('StartTyping', {
				user: props.user
			});

			Echo.private('chat-channel').listenForWhisper('StartTyping', (e) => {

				// Display typing indicator when 'startTyping' event is received for others
				if (e.user.id !== props.user.id) {
					isTyping.value = true;
					typingUser.value = e.user.name;
				}
			});
		};

		const stopTyping = () => {
			// Set the typing status to false
			isTyping.value = false;

			// Emit 'stopTyping' event to notify others
			Echo.private('chat-channel').whisper('StopTyping', {
				user: props.user
			});

			Echo.private('chat-channel').listenForWhisper('StopTyping', (e) => {
				// Hide typing indicator when 'stopTyping' event is received
				isTyping.value = false;
				typingUser.value = '';

			});
		};

		Echo.private('chat-channel')
			.listen('SendMessage', (e) => {
				messages.value.push({
					message: e.message.message,
					user: e.user
				});
			})

		const fetchMessages = async () => {
			axios.get('/messages').then(response => {
				messages.value = response.data;
			});
		}

		const addMessage = async () => {
			let user_message = {
				user: props.user,
				message: newMessage.value
			};
			messages.value.push(user_message);
			axios.post('/messages', user_message).then(response => {
				console.log(response.data);
			});
			newMessage.value = ''
		}

		const scrollBottom = () => {
			if (messages.value.length > 1) {
				let el = hasScrolledToBottom.value;
				el.scrollTop = el.scrollHeight;
			}
		}

		return {
			messages,
			newMessage,
			addMessage,
			fetchMessages,
			hasScrolledToBottom,
			isTyping,
			typingUser,
			startTyping,
			stopTyping,
			handleInput,
		}
	}
}
</script>