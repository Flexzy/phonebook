<template>
	<div>
		<nav class="panel column is-offset-2 is-8">
		  <p class="panel-heading">
		    VueJs Phonebook
		    <button class="button is-link is-outlined" @click="openAdd">
		      Add new
		    </button>
		    <span class="is-pulled-right" v-if="loading">
		    	<i class="fa fa-refresh fa-spin fa-2x fa-fw"></i>
		    </span>
		  </p>
		  <div class="panel-block">
		    <p class="control has-icons-left">
		      <input class="input is-small" type="text" placeholder="search" v-model="searchQuery">
		      <span class="icon is-small is-left">
		        <i class="fa fa-search" aria-hidden="true"></i>
		      </span>
		    </p>
		  </div>
		  <a class="panel-block" v-for="item,key in temp">
		    <span class="column is-9">
		    	<strong>{{ item.name }}</strong>
		    </span>
		    <span class="panel-icon column is-1" @click="del(key, item.id)">
		      <i class="has-text-danger fa fa-trash" aria-hidden="true"></i>
		    </span>
		    <span class="panel-icon column is-1" @click="openUpdate(key)">
		      <i class="has-text-info fa fa-edit" aria-hidden="true"></i>
		    </span>
		    <span class="panel-icon column is-1" @click="openShow(key)">
		      <i class="has-text-primary fa fa-eye" aria-hidden="true"></i>
		    </span>
		  </a>
		</nav>

		<Add :openModal='addActive' @closeRequest="close"></Add>
		<Show :openModal='showActive' @closeRequest="close"></Show>
		<Update :openModal='updateActive' @closeRequest="close"></Update>
	</div>
</template>

<script type="text/javascript">
	
	let Add = require('./Add.vue');
	let Show = require('./Show.vue');
	let Update = require('./Update.vue');

	export default {
		components: {Add,Show,Update},
		data() {
			return {
				addActive: '',
				showActive: '',
				updateActive: '',
				lists: {},
				errors: {},
				loading: false,
				temp: '',
				searchQuery: '',
			}
		},
		mounted() {
			axios.post('/getData')
			.then((response) => this.lists = this.temp = response.data)
			.catch((error) => this.errors = error.response.data.errors)
		},
		watch: {
			searchQuery() {
				if(this.searchQuery.length > 0) {
					this.temp = this.lists.filter((item) => {
						return Object.keys(item).some((key) => {
							let string = String(item[key])
							return string.toLowerCase().indexOf(this.searchQuery.toLowerCase()) > -1
						})
						//return item.name.toLowerCase().indexOf(this.searchQuery.toLowerCase()) > -1
					})
				}else{
					this.temp = this.lists
				}
			}
		},
		methods: {
			openAdd() {
				this.addActive = 'is-active'
			},
			openShow(key) {
				this.showActive = 'is-active';
				this.$children[1].list = this.temp[key];
			},
			openUpdate(key) {
				this.updateActive = 'is-active';
				this.$children[2].list = this.temp[key];
			},
			del(key, id) {
				if(confirm("Are you sure?")) {
					this.loading = !this.loading
					axios.delete(`/phonebook/${id}`)
					.then((response) => {
						console.log(response.data);
						this.lists.splice(key, 1);
						this.loading = !this.loading
					})
					.catch((error) => this.errors = error.response.data.errors)
				}
			},
			close() {
				this.addActive = this.showActive = this.updateActive = ''
			}
		}
	}

</script>