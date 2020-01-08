<template>
    <div class="form-group">
        <label>Category</label>
        <select type="date" id="category_id" class="form-control" name="category_id">
            <option v-for="category in categories" :value="category.id"
            :selected="cat_id == category.id ">{{category.name}} </option>
        </select>
        <label for="addTag " class="mt-2">Add Category</label>
        <input class="form-control" type="text" name="addCategory" v-model="category">
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
        <p @click="addCategory()" class="btn btn-sm btn-success mt-2">Add Category</p>
    </div>
</template>
<script>
export default {
 props:['cat_id'],
    data() {
        return {
            category: '',
            categories: [],
            errors: [],
            success: '',
            submit: true,
        }
    },
    methods: {
        addCategory() {
            this.errors = [];
            this.success = "";

            if (this.submit) {
                this.submit = false;

                axios.post('/store_category', {
                        name: this.category
                    })
                    .then(({ data }) => {
                        console.log(data)
                        this.submit = true;
                        this.success = `Category "${data.data.name}" added`;
                        this.categories.push(data.data);
                        this.category = "";
                    })
                    .catch(error => {
                        this.submit = true;
                        this.errors = error.response.data.errors.name;
                    })
            }
        },
        getCategories() {
            axios.get('/all_categories')
                .then(({ data }) => {
                    this.categories = data.data;
                });
        },
    },
    computed: {

    },
    created() {
        this.getCategories();
    }

}

</script>
