<!--
  - Copyright (c) by anime-free
  - Date: 2020.
  - User: Alukardua
  -->

<template>
	<div>
		<button class="btn btn-success btn-rounded" type="submit" form="data">Сохранить</button>
		<button class="btn btn-danger btn-rounded" type="button" v-on:click="select('patch')">Отменить</button>
	</div>
</template>

<script>
	export default {
		name: "ButtonPostFormAdmin",
		props:['patch'],
		data: function () {
			return {
				select: function(patch) {
					window.location.href = patch;
				}
			}
		}
	}
</script>