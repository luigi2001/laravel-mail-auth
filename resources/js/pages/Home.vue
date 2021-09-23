<template>
   <main class="text-center">
        <h2>articoli del blog:</h2>
        <p class="border-bottom-0">pagina {{currentpage}} di {{lastpage}}</p>
        <div class="mb-5" v-for="post in posts" :key="post.id">
            <div class="card border-0">
                <div class="card-header">
                    {{formatdata(post.created_at)}}
                </div>
                <div class="card-body">
                    <h5 class="card-title">{{post.title}}</h5>
                    <p class="card-text">{{post.content}} <span><router-link :to="{ name: 'post', params:{slug: post.slug} }">continua a leggere...</router-link></span> </p>
                </div>
            </div>
        </div>
        <div class="pulsanti ">
            <ul>
                <li><span @click="getposts( --currentpage )">indietro</span></li>
                <li :class="{'disabilita' : currentpage == lastpage}" ><span @click="getposts( ++currentpage )">avanti</span></li>
            </ul>
        </div>
    </main>
</template>

<script>
export default {
    name: 'Home',
    data(){
        return{
            apiurl: 'http://localhost:8000/api/posts',
            posts: [],
            currentpage: 1,
            lastpage: null
        }
    },
    created(){
        this.getposts(1);
    },
    methods: {
        getposts(page){
            axios.get(this.apiurl, {
                params: {
                    page: page
                }
            })
                 .then(response => {
                     this.posts = response.data.results.data;
                     this.currentpage = response.data.results.current_page;
                     this.lastpage = response.data.results.last_page
                     console.log( this.currentpage )
                 })
                 .catch();
        },
        formatdata(data){
            const postData = new Date(data);
            return postData.getDate() + '/' + parseInt(postData.getMonth() + 1) + '/' + postData.getFullYear();
        }
    }
}
</script>

<style lang="scss" scoped>
p{
    border-bottom: 5px solid yellow;
    padding: 10px;
}
ul{
    list-style: none;
    li{
    display: inline-block;
    padding: 20px;
    cursor: pointer;
    } 
    .disabilita{
        display: none;
    }
}
</style>