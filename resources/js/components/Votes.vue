<!--
  - Copyright (c) by anime-free
  - Date: 2020.
  - User: Alukardua
  -->

<template>
    <div v-if="isVoted" class="btn-group btn-group-lg mb-4" role="group" aria-label="Basic example">
        <button type="button" @click.prevent="plusVote(post)" class="btn btn-success btn-sm" disabled>
            <i class="far fa-thumbs-up"></i></button>
        <button type="button" @click.prevent="minusVote(post)" class="btn btn-danger btn-sm" disabled>
            <i class="far fa-thumbs-down"></i></button>
    </div>
    <div v-else class="btn-group btn-group-lg mb-4" role="group" aria-label="Basic example">
        <button type="button" @click.prevent="plusVote(post)" class="btn btn-success btn-sm">
            <i class="far fa-thumbs-up"></i></button>
        <button type="button" @click.prevent="minusVote(post)" class="btn btn-danger btn-sm">
            <i class="far fa-thumbs-down"></i></button>
    </div>
</template>

<script>
    export default {
        props: ['post', 'votes'],

        data: function () {
            return {
                isVoted: '',
            }
        },

        mounted() {
            this.isVoted = !!this.isVotes;
        },

        computed: {
            isVotes() {
                return this.votes;
            },
        },

        methods: {
            plusVote(post) {
                axios.post('/plusVotes/' + post)
                    .then(response => this.isVoted = true)
                    .catch(response => console.log(response.data));
            },
            minusVote(post) {
                axios.post('/minusVotes/' + post)
                    .then(response => this.isVoted = true)
                    .catch(response => console.log(response.data));
            },
        }
    }
</script>
