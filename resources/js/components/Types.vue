<template>
    <div class="form-group">
        <label>Link Type</label>
        <select @change="onChange(type)" type="date" id="type_id" class="form-control" name="type_id" v-model="type">
            <option v-for="type in types" :value="type.id">{{type.name}} </option>
        </select>
        <p @click="add = !add" class="btn btn-sm btn-success mt-2">Add More Types</p>
        <div v-if="add">
            <label for="addTag " class="mt-2">Add Type</label>
            <input class="form-control" type="text" name="addCategory" v-model="type">
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
            <p @click="addType()" class="btn btn-sm btn-success mt-2">Add Type</p>
        </div>
    </div>
</template>
<script>
export default {
  
    data() {
        return {
            add: false,
            type: '',
            types: [],
            errors: [],
            success: '',
            submit: true,

        }
    },
    methods: {
        onChange(value) {
            let val = this.types.filter(item => item.id === value)
            this.$emit('selected', val)
        },
        addType() {
            this.errors = [];
            this.success = "";

            if (this.submit) {
                this.submit = false;

                axios.post('/store_type', {
                        name: this.type
                    })
                    .then(({ data }) => {
                        console.log(data)
                        this.submit = true;
                        this.success = `Type "${data.data.name}" added`;
                        this.types.push(data.data);
                        this.type = "";
                    })
                    .catch(error => {
                        this.submit = true;
                        this.errors = error.response.data.errors.name;
                    })
            }
        },
        getTypes() {
            axios.get('/all_types')
                .then(({ data }) => {
                    this.types = data.data;
                });
        },
    },
    computed: {

    },
    created() {
        this.getTypes();
    }

}

</script>
