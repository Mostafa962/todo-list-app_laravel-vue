<template>
    <div class="item">
        <input
            type="checkbox"
            @change="updateCheck()"
            v-model="item.isCompleted"
            checked
        />
        <span :class="[item.isCompleted ? 'completed' : '', 'itemText']">
            {{item.name}}
        </span>
        <button @click="removeItem()" class="trashCan">
            <font-awesome-icon  icon="trash" />
        </button>
    </div>
</template>

<script>
export default {
    props:['item'],
    methods:{
        updateCheck(){
            axios.put('api/items/' + this.item.id, {
                is_completed:this.item.isCompleted
            })
            .then(response=>{
                var responseDate = response.data;
                if(response.status==200)
                {
                    if(responseDate.code == 200)
                    {
                        this.$emit('itemChanged');
                        this.$toast.success(responseDate.message);
                    }
                    if(responseDate.code == 101)
                    {
                        responseDate.validation.forEach(message => 
                            this.$toast.error(message)
                        );
                    }
                }
                if(response.status==500)
                {
                    this.$toast.error('Failed, Please try again later.')
                }
            })
            .catch(error=>{
                this.$toast.error('Failed, Please try again later.')
            })
        },
        removeItem(){
            axios.delete('api/items/'+this.item.id)
            .then(response=>{
                var responseDate = response.data;
                if(response.status==200)
                {
                    if(responseDate.code == 200)
                    {
                        this.$emit('itemChanged');
                        this.$toast.success(responseDate.message);
                    }
                    if(responseDate.code == 101)
                    {
                        responseDate.validation.forEach(message => 
                            this.$toast.error(message)
                        );
                    }
                }
                if(response.status==500)
                {
                    this.$toast.error('Failed, Please try again later.')
                }
            })
            .catch(error=>{
                this.$toast.error('Failed, Please try again later.')
            })
        }
    }
}
</script>
<style scoped>
.completed{
    text-decoration: line-through;
    color: #999999;
}
.itemText{
    width: 100%;
    margin-left: 20px;
}
.item{
    display: flex;
    justify-content: center;
    align-items: center;
}
.trashCan{
    background: #e6e6e6;
    color:red;
    border: none;
    outline: none;
}
</style>