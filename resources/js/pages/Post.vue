<template>
    <div class="container text-center">
        <div class="box" v-if="post.category || post.tags">
            <span v-if="post.category">{{post.category.name}} |</span>
            <span v-for="tag in post.tags" :key="tag.id">{{tag.name}} - </span>
        </div>
        <h1 class="mb-5">{{post.title}}</h1>
        <p>{{post.content}}</p>
    </div>
</template>

<script>
export default {
    name: 'Post',
    data(){
        return{
            post: []
        }
    },
    mounted(){
        axios .get('http://localhost:8000/api/post/' + this.$route.params.slug)
              .then(response => {
                  this.post = response.data.results;
              })
              .catch()
    }
}
</script>

<style lang="scss" scoped>

</style>