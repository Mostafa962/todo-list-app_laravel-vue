<template>
    <div class="todolistcontiner">
        <div class="heading">
            <h2 id="title">
                Todo List
            </h2>
            <add-item 
              v-on:reloadList="getList()"
            />
        </div>
        <view-items 
            :items="items" 
            v-on:reloadList="getList()"
        />

    </div>
</template>

<script>
import addItem from './todolist/create.vue';
import viewItems from './todolist/view.vue';

export default {
    components:{
        addItem,viewItems
    },
    data:function(){
        return {
            items:[]
        }
    },
    methods:{
        getList(){
            axios.get('api/items')
            .then(response=>{
                this.items = response.data.data.items.data
            })
            .catch(error=>{
                this.$toast.error('Failed, Please try again later.')
            })
        }
    },
    created(){
        this.getList();
    }
}
</script>

<style scoped>
.todolistcontiner{
    width: 350px;
    margin:auto;
}

.heading{
    background: #e6e6e6;
    padding:10px;
}

#title {
    text-align: center;
}
</style>
