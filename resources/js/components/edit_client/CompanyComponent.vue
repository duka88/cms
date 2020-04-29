<template>
    <div class="d-flex align-items-center flex-wrap w-75 justify-content-between">
        <p v-if="!edit" class="mb-0">{{vCompany}}</p>
        <p v-else class="mb-0 d-flex  align-items-center">
            <input v-model="vCompany" type="text" class="form-control">            
            <span @click="submit()" class=" ml-2 btn btn-success btn-sm ">Ok</span>            
        </p>
        <span v-if="!edit" @click="edit = true" class="ml-4 btn btn-primary btn-sm text-white">Edit</span>
        <span v-else @click="close()" class=" ml-4 btn btn-danger btn-sm ">Cancel</span>
        <span class="w-100 text-danger" v-for="error in errors">{{error[0]}}</span>
    </div>
</template>
<script>
export default {
    props: ['client_id', 'company'],
    data() {
        return {
            vCompany: this.company,
            errors: [],
            edit: false
        }
    },
    methods: {
        submit() {
            if (this.vCompany) {
                this.errors = [];
                axios.post('/company', {
                        id: this.client_id,
                        company: this.vCompany
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
            	this.errors = [['company is required']];
            }
        },
        close(){
            this.vCompany = this.company;
            this.edit = false;
            this.errors = [];
        }
    },
    
}

</script>
