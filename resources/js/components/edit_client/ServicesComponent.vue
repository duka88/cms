<template>
    <div class="d-flex align-items-center flex-wrap w-75 justify-content-between">
        <div v-if="!edit" class="d-flex align-items-center flex-wrap">
            <p v-for="service in selected" class="mb-0 w-100">{{service.name}}</p>
        </div>
        <p v-else class="mb-0 d-flex  align-items-center">
            <vue-multiselect v-model="selected" :options="options" :multiple=true track-by="name" value="id" label="name" :close-on-select=false :clear-on-select=false :preserve-search=false>
            </vue-multiselect>
            <span @click="submit()" class=" ml-2 btn btn-success btn-sm ">Ok</span>
        </p>
        <span v-if="!edit" @click="edit = true" class="ml-4 btn btn-primary btn-sm text-white">Edit</span>
        <span v-else @click="close()" class=" ml-4 btn btn-danger btn-sm ">Cancel</span>
        <span class="w-100 text-danger" v-for="error in errors">{{error[0]}}</span>
    </div>
</template>
<script>
import VueMultiselect from 'vue-multiselect';
export default {
    props: ['client_id', 'services'],
    components: {
        VueMultiselect
    },
    data() {
        return {
            vServices: this.services,
            errors: [],
            edit: false,
            selected: this.services,
            options: []
        }
    },
    methods: {
        getServices() {
            axios.get('/all_services')
                .then(({ data }) => {
                    this.options = data.data;
                })
        },
        submit() {

            this.errors = [];
            axios.post('/services', {
                    id: this.client_id,
                    services: this.selected.map(item => item.id)
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

        },
        close() {
            this.selected = this.services;
            this.edit = false;
            this.errors = [];
        }
    },

    created() {
        this.getServices();
    }

}

</script>
