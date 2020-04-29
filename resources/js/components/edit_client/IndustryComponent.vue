<template>
    <div class="d-flex align-items-center flex-wrap w-75 justify-content-between">
        <p v-if="!edit" class="mb-0">
            {{industryEdit.name}}
        </p>
        <div v-else>
            <select type="date" id="industry_id" name="industry_id" v-model="industryEdit" class="form-control">
                <option v-for="industry in industries" :value="industry" :selected="ind_id == industry.id ">{{industry.name}} </option>
            </select>
            <span @click="submitEdit()" class=" ml-2 btn btn-success btn-sm ">Ok</span>   
            <p @click="add = !add" class="btn btn-sm btn-success mb-0">Add More Industry</p>
            <div v-if="add">
                <input type="text" name="addindustry" v-model="industry">
                <div v-if="errors.length > 0" class="alert alert-danger ">
                    <ul class="list-group">
                        <li v-for="error in errors" class="list-group-item text-danger">{{error}}</li>
                    </ul>
                </div>
                <div v-if="success" class="alert alert-success ">
                    <ul class="list-group">
                        <li class="list-group-item text-success">{{success}}</li>
                    </ul>
                </div>
                <p @click="addIndustry()" class="btn btn-sm btn-success mb-0">Add Industry</p>
            </div>
        </div>
        <span v-if="!edit" @click="edit = true" class="ml-4 btn btn-primary btn-sm text-white">Edit</span>
        <span v-else @click="close()" class=" ml-4 btn btn-danger btn-sm ">Cancel</span>
    </div>
</template>
<script>
export default {
    props: ['ind_id', 'client_id', 'current'],
    data() {
        return {
            add: false,
            industry: '',
            industries: [],
            errors: [],
            success: '',
            submit: true,
            edit: false,
            industryEdit:{
                id: '',
                name: this.current
            }
       


        }
    },
    methods: {
        close(){
            this.industryEdit.id= "";
            this.industryEdit.name= this.current;          
            this.edit = false;
            this.errors = [];
        },
        addIndustry() {
            this.errors = [];
            this.success = "";

            if (this.submit) {
                this.submit = false;

                axios.post('/store_industry', {
                        name: this.industry
                    })
                    .then(({ data }) => {
                        this.submit = true;
                        this.success = `industry "${data.data.name}" added`;
                        this.industries.push(data.data);
                        this.industry = "";
                    })
                    .catch(error => {
                        this.submit = true;
                        this.errors = error.response.data.errors.name;
                    })
            }
        },
        getIndustries() {
            axios.get('/all_industries')
                .then(({ data }) => {
                    this.industries = data.data;
                });
        },
        submitEdit() {
           
                this.errors = [];
                axios.post('/industry', {
                        id: this.client_id,
                        industry: this.industryEdit.id
                    })
                    .then(({ data }) => {
                        this.edit = false
                    })
                    .catch((error) => {

                        let err = error.response.data.errors;

                        Object.values(err).forEach((item) => {
                            this.errors.push(item);
                        });

                    })
            }
       
    },
    computed: {

    },
    created() {
        this.getIndustries();
    }

}

</script>
