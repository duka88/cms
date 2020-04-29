<template>
    <div class="d-flex align-items-center flex-wrap w-75 justify-content-between">
        <p v-if="!edit" class="mb-0">{{vName}}</p>
        <p v-else class="mb-0 d-flex  align-items-center">
            <input v-model="vName" type="text" class="form-control">            
            <span @click="submit()" class=" ml-2 btn btn-success btn-sm ">Ok</span>            
        </p>
        <span v-if="!edit" @click="edit = true" class="ml-4 btn btn-primary btn-sm text-white">Edit</span>
        <span v-else @click="close()" class=" ml-4 btn btn-danger btn-sm ">Cancel</span>
        <span class="w-100 text-danger" v-for="error in errors">{{error[0]}}</span>
    </div>
</template>
<script>
export default {
    props: ['client_id', 'name'],
    data() {
        return {
            vName: this.name,
            errors: [],
            edit: false
        }
    },
    methods: {
        submit() {
            if (this.vName) {
                this.errors = [];
                axios.post('/name', {
                        id: this.client_id,
                        name: this.vName
                    })
                    .then(({ data }) => {
                        this.edit = false
                    })
                    .catch((error)=>{
                      
                       let err =  error.response.data.errors;
                       
                       Object.values(err).forEach((item)=>{
                          this.errors.push(item);
                       });
                         
                    })
            }else{
            	this.errors = [['name is required']];
            }
        },
        close(){
            this.vName = this.name;
            this.edit = false;
            this.errors = [];
        }
    },
    
}

</script>
