<template>
    <div class="form-group">
        <label>Industry*</label>
        <select type="date" id="industry_id" class="form-control" name="industry_id">
            <option v-for="industry in industries" :value="industry.id" :selected="ind_id === industry.id ">{{industry.name}} </option>
        </select>
        <p @click="add = !add" class="btn btn-sm btn-success mt-2">Add More Industry</p>
        <div  v-if="add">
            <label for="addTag " class="mt-2">Add industry</label>
            <input class="form-control" type="text" name="addindustry" v-model="industry">
            <div v-if="errors.length > 0" class="alert alert-danger mt-2">
                <ul class="list-group">
                    <li v-for="error in errors" class="list-group-item text-danger">{{error}}</li>
                </ul>
            </div>
            <div v-if="success" class="alert alert-success mt-2">
                <ul class="list-group">
                    <li class="list-group-item text-success">{{success}}</li>
                </ul>
            </div>
            <p @click="addIndustry()" class="btn btn-sm btn-success mt-2">Add Industry</p>
        </div>
    </div>
</template>
<script>
export default {
    props: ['ind_id'],
    data() {
        return {
            add: false,
            industry: '',
            industries: [],
            errors: [],
            success: '',
            submit: true,

        }
    },
    methods: {
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
    },
    computed: {

    },
    created() {
        this.getIndustries();
    }

}

</script>
