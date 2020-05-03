<template>
    <div class="form-group border p-2"">
        <p>Links</p>
        <input v-for="link  in links" :value="JSON.stringify(links)" type="hidden" name="addlink[]">
        <label for="addTag " class="mt-2">Add Link</label>
        <input class="form-control" type="text" v-model="link">
        <p v-for="(link, i) in links">
            <span><b>{{link.link}}: </b>{{link.type.name}}
                <span @click="removeLink(i)" class="ml-3 pointer"><b>X</b></span></span>
        </p>
        <vue-types @selected="setType"></vue-types>
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
        <p @click="addLink()" class="btn btn-sm btn-success mt-2">Add Link</p>
    </div>
</template>
<script>
export default {
    data() {
        return {
            link: '',
            type: '',
            links: [],
            errors: [],
            success: '',
            submit: true
        }
    },
    methods: {
        setType(value) {
            this.type = value[0];
        },
        addLink() {
            this.errors = [];
            this.validation();            

            if (this.errors.length === 0) {
                this.links.push({ type: this.type, link: this.link });
            }
        },
        removeLink(i) {
            this.links.splice(i, 1);
        },
        validation() {
            if (!this.link) {
                this.errors.push('Link is required')
            }
            if (!this.type) {
                this.errors.push('Type is required')
            }
        }
       
    }
}

</script>
