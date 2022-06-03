<template>
    <div class="addItem">
       <input 
            type="text" 
            max="255"
            v-model="item.name"
        />
        <font-awesome-icon 
            icon="plus-square" 
            :class="[item.name ? 'active':'inactive', 'plus']" 
            @click="addItem()"
        />
    </div>
</template>

<script>

export default {
    data:function(){
        return{
            item:{
                name:"",
            }
        }
    },
    methods:{
        addItem(){
            if(this.item.name == '')
                return;

            const data = {
                name : this.item.name,
            }
            axios.post('api/items',data)
            .then(response=>{
                var responseDate = response.data;
                if(response.status==200)
                {
                    if(responseDate.code == 200)
                    {
                        this.item.name = '';
                        this.$emit('reloadList');
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
.addItem{
    display: flex;
    justify-content: center;
    align-items: center;
}
.input{
    background: #171717;
    border: 0px;
    outline: none;
    padding: 5px;
    margin-right: 10px;
    width: 100%;
}
.plus
{
    font-size:20px;
}
.active
{
    color:green;
}
.inactive
{
    color:#999999;
}
</style>