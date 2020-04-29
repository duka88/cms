<template>
    <div class="form-group">
        <label>Tags</label>
        <vue-multiselect v-model="selected" :options="tags" :multiple=true track-by="name" value="id" label="name" :close-on-select=false :clear-on-select=false :preserve-search=false>
        </vue-multiselect>
        <input v-for="tag in selected" type="hidden" name="tag_id[]" :value="tag.id">
        <div class="w-100 d-flex justify-content-end ">
            <p @click="add = !add" class="btn btn-sm btn-success mt-2 mb-2">Add New Tag</p>
        </div>
        <div v-if="add" class="border p-2">
            <div class="w-100 d-flex justify-content-between ">
                <label for="addTag " class="mt-2">Add Tag</label>
                <p @click="add = !add" class="btn btn-sm btn-success mt-2 mb-2">Close</p>
            </div>       
            <input class="form-control" type="text" name="addTag" v-model="tag">
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
            <p @click="addTag()" class="btn btn-sm btn-success mt-2">Add Tag</p>
        </div>
    </div>
</template>
<script>
import VueMultiselect from 'vue-multiselect';

export default {
    components: {
        VueMultiselect
    },
    props: ['tag_id'],
    data() {
        return {
            add: false,
            tag: '',
            tags: [],
            errors: [],
            success: '',
            submit: true,
            selected: [],
            options: ['list', 'of', 'options']
        }
    },
    methods: {
        addTag() {
            this.errors = [];
            this.success = "";

            if (this.submit) {
                this.submit = false;

                axios.post('/store_tags', {
                        name: this.tag
                    })
                    .then(({ data }) => {
                        console.log(data)
                        this.submit = true;
                        this.success = `Tag "${data.data.name}" added`;
                        this.tags.push(data.data);
                        this.tag = "";
                    })
                    .catch(error => {
                        this.submit = true;
                        this.errors = error.response.data.errors.name;
                    })
            }
        },
        getTags() {
            axios.get('/all_tags')
                .then(({ data }) => {
                    this.tags = data.data;
                })
        },
        selectedTags() {

            let tags = [];
            if (this.tag_id) {
                this.tag_id.forEach((item) => {

                    tags.push({ 'id': item.id, 'name': item.name });
                });
            }
            this.selected = tags;
        }
    },
    created() {
        this.getTags();
        this.selectedTags();
    }

}

</script>
