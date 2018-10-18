<template>
	<div class="modal" :class="openModal">
	  <div class="modal-background"></div>
	  <div class="modal-card">
	    <header class="modal-card-head">
	      <p class="modal-card-title">Update {{ list.name }}'s details</p>
	      <button class="delete" aria-label="close" @click="close"></button>
	    </header>
	    <section class="modal-card-body">
	      	<div class="field">
			  <label class="label">Name</label>
			  <div class="control has-icons-left">
			    <input class="input" :class="{'is-danger': errors.name}" type="text" placeholder="Name" v-model="list.name">
			    <span class="icon is-small is-left">
			      <i class="fa fa-user"></i>
			    </span>
			  </div>
			  <small v-if="errors.name" class="has-text-danger">{{ errors.name[0] }}</small>
			</div>

			<div class="field">
			  <label class="label">Email</label>
			  <div class="control has-icons-left">
			    <input class="input" :class="{'is-danger': errors.email}" type="email" placeholder="Email" v-model="list.email">
			    <span class="icon is-small is-left">
			      <i class="fa fa-envelope"></i>
			    </span>
			  </div>
			  <small v-if="errors.email" class="has-text-danger">{{ errors.email[0] }}</small>
			</div>

			<div class="field">
			  <label class="label">Phone</label>
			  <div class="control has-icons-left">
			    <input class="input" :class="{'is-danger': errors.phone}" type="text" placeholder="Phone" v-model="list.phone">
			    <span class="icon is-small is-left">
			      <i class="fa fa-phone"></i>
			    </span>
			  </div>
			  <small v-if="errors.phone" class="has-text-danger">{{ errors.phone[0] }}</small>
			</div>

	    </section>
	    <footer class="modal-card-foot">
	      <button class="button is-success" @click="update">Update details</button>
	      <button class="button" @click="close">Cancel</button>
	    </footer>
	  </div>
	</div>
</template>

<script type="text/javascript">
	
	export default {
		props: ['openModal'],
		data() {
			return {
				list: {},
				errors: {},
			}
		},
		methods: {
			close() {
				this.$emit('closeRequest');
			},
			update() {
				axios.put(`/phonebook/${this.list.id}`, this.$data.list).then((response) => this.close())
				  .catch((error) => this.errors = error.response.data.errors)
			}
		}
	}

</script>