<template>
	<div>
		<nav class="panel column is-offset-2 is-8">
		  <p class="panel-heading">
		    VueJs Phonebook
		    <button class="button is-link is-outlined" @click="openAdd">
		      Add new
		    </button>
		  </p>
		  <div class="panel-block">
		    <p class="control has-icons-left">
		      <input class="input is-small" type="text" placeholder="search">
		      <span class="icon is-small is-left">
		        <i class="fas fa-search" aria-hidden="true"></i>
		      </span>
		    </p>
		  </div>
		  <a class="panel-block" v-for="item,key in lists">
		    <span class="column is-9">
		    	<strong>{{ item.name }}</strong>
		    </span>
		    <span class="panel-icon column is-1">
		      <i class="has-text-danger fa fa-trash" aria-hidden="true"></i>
		    </span>
		    <span class="panel-icon column is-1">
		      <i class="has-text-info fa fa-edit" aria-hidden="true"></i>
		    </span>
		    <span class="panel-icon column is-1">
		      <i class="has-text-primary fa fa-eye" aria-hidden="true"></i>
		    </span>
		  </a>
		</nav>

		<Add :openModal='addActive' @closeRequest="close"></Add>
	</div>
</template>

<script type="text/javascript">
	
	let Add = require('./Add.vue');

	export default {
		components: {Add},
		data() {
			return {
				addActive: '',
				lists: {},
				errors: {},
			}
		},
		mounted() {
			axios.post('/getData')
			.then((response) => this.lists = response.data)
			.catch((error) => this.errors = error.response.data.errors)
		},
		methods: {
			openAdd() {
				this.addActive = 'is-active'
			},
			close() {
				this.addActive = ''
			}
		}
	}

</script>