<!--
  - Copyright (c) by anime-free
  - Date: 2020.
  - User: Alukardua
  -->

<template>
	<select name="genre[]" v-model="selected" class="mdb-select md-form" multiple>
		<option v-for="category in categories" v-bind:value="category.id">
			{{ category.title }}
		</option>
	</select>
</template>

<script>
	export default {
		name: "CategorySelect",
		props: ['post'],
		data: function () {
			return {
				categories: [],
				selected: []
			}
		},
		mounted() {
			var app = this;
			axios.get('/api/category')
				.then(function (resp) {
					app.categories = resp.data;
				})
				.catch(function (resp) {
					console.log(resp);
				});
			axios.get('/api/anime/' + this.post)
				.then(function (resp) {
					$.each(resp.data['get_category'], function (key, item) {
						app.selected.push(item['id']);
					})
				})
				.catch(function (resp) {
					console.log(resp);
				});
		},
	}
</script>