<!--
  - Copyright (c) by anime-free
  - Date: 2020.
  - User: Alukardua
  -->

<template>
        <button v-if="isFavorited" @click.prevent="unFavorite(post)"
           class="btn-floating btn-lg btn-danger float-right justify-content-top btn-sm"
           data-toggle="tooltip" title="Убрать из закладок"><i class="far fa-heart"></i>
        </button>
        <button v-else @click.prevent="favorite(post)"
           class="btn-floating btn-lg btn-default float-right justify-content-top btn-sm"
           data-toggle="tooltip" title="Добавить в закладки"><i class="far fa-heart"></i>
        </button>
</template>

<script>
    export default {
        props: ['post', 'favorited'],

        data: function () {
            return {
                isFavorited: '',
            }
        },

        mounted() {
            this.isFavorited = !!this.isFavorite;
        },

        computed: {
            isFavorite() {
                return this.favorited;
            },
        },

        methods: {
            favorite(post) {
                axios.post('/favorite/' + post)
                    .then(response => this.isFavorited = true)
                    .catch(response => console.log(response.data));
            },

            unFavorite(post) {
                axios.post('/unfavorite/' + post)
                    .then(response => this.isFavorited = false)
                    .catch(response => console.log(response.data));
            }
        }
    }
</script>
