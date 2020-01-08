<template>
    <div class="form-group">        
        <label>Tags</label>

        <vue-multiselect v-model="selected" 
         :options="tags" :multiple=true track-by="name" 
         value="id" label="name" 
         :close-on-select=false :clear-on-select=false :preserve-search=false>
        </vue-multiselect>

        <input v-for="tag in selected" type="hidden" name="tag_id[]" :value="tag.id">

        <label for="addTag " class="mt-2">Add Tag</label>
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
</template>
<script>
import VueMultiselect from 'vue-multiselect';

export default {
    components: {
        VueMultiselect
    },
    props:['tag_id'],
    data() {
        return {
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
        selectedTags(){
          
            let tags = [];
            this.tag_id.forEach((item)=>{
               
               tags.push({'id': item.id, 'name': item.name});
            });
            console.log(tags)
            this.selected = tags;
        }
    }, 
    created() {
        this.getTags();
        this.selectedTags();
    }

}

</script>
