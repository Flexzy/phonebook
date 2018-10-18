<template>
	<div class="modal" :class="openModal">
	  <div class="modal-background"></div>
	  <div class="modal-card">
	    <header class="modal-card-head">
	      <p class="modal-card-title">{{list.name}}'s details</p>
	      <button class="delete" aria-label="close" @click="close"></button>
	    </header>
	    <section class="modal-card-body">
	      	<div class="field">
			  <label class="label">Name</label>
			  <div class="control has-icons-left">
			    <input class="input" readonly type="text" placeholder="Name" :value="list.name">
			    <span class="icon is-small is-left">
			      <i class="fa fa-user"></i>
			    </span>
			  </div>
			</div>

			<div class="field">
			  <label class="label">Email</label>
			  <div class="control has-icons-left">
			    <input class="input" readonly type="email" placeholder="Email" :value="list.email">
			    <span class="icon is-small is-left">
			      <i class="fa fa-envelope"></i>
			    </span>
			  </div>
			</div>

			<div class="field">
			  <label class="label">Phone</label>
			  <div class="control has-icons-left">
			    <input class="input" readonly type="text" :value="list.phone">
			    <span class="icon is-small is-left">
			      <i class="fa fa-phone"></i>
			    </span>
			  </div>
			</div>

	    </section>
	    <footer class="modal-card-foot">
	      <button class="button is-danger" @click="close">Cancel</button>
	    </footer>
	  </div>
	</div>
</template>

<script type="text/javascript">
	export default {
		props: ['openModal'],
		data() {
			return {
				list: '',
			}
		},
		methods: {
			close() {
				this.$emit('closeRequest');
			}
		}
	}
</script>