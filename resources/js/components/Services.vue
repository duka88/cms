<template>
    <div class="form-group">
        <label>Services</label>
        <vue-multiselect v-model="selected" :options="services" :multiple=true track-by="name" value="id" label="name" :close-on-select=false :clear-on-select=false :preserve-search=false>
        </vue-multiselect>
        <input v-for="service in selected" type="hidden" name="service_id[]" :value="service.id">
        <p @click="add = !add" class="btn btn-sm btn-success mt-2">Add More Servises</p>
        <div v-if="add">
            <label for="addService " class="mt-2">Add Service</label>
            <input class="form-control" type="text" name="addService" v-model="service">
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
            <p @click="addService()" class="btn btn-sm btn-success mt-2">Add Service</p>
        </div>
    </div>
</template>
<script>
import VueMultiselect from 'vue-multiselect';

export default {
    components: {
        VueMultiselect
    },
    props: ['ser_id'],
    data() {
        return {
            add: false,
            service: '',
            services: [],
            errors: [],
            success: '',
            submit: true,
            selected: []

        }
    },
    methods: {
        addService() {
            this.errors = [];
            this.success = "";

            if (this.submit) {
                this.submit = false;

                axios.post('/store_services', {
                        name: this.service
                    })
                    .then(({ data }) => {
                        console.log(data)
                        this.submit = true;
                        this.success = `Service "${data.data.name}" added`;
                        this.services.push(data.data);
                        this.service = "";
                    })
                    .catch(error => {
                        this.submit = true;
                        this.errors = error.response.data.errors.name;
                    })
            }
        },
        getServices() {
            axios.get('/all_services')
                .then(({ data }) => {
                    this.services = data.data;
                })
        },
        selectedServices() {

            let services = [];
            if (this.service_id) {
                this.service_id.forEach((item) => {

                    service.push({ 'id': item.id, 'name': item.name });
                });
            }
            this.selected = services;
        }
    },
    created() {
        this.getServices();
        this.selectedServices();
    }

}

</script>
