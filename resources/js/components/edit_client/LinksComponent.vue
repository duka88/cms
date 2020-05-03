<template>
    <div class="d-flex align-items-center flex-wrap w-75 justify-content-between">
        <div v-if="!edit">
            <p class="mb-0 w-100" v-for="link in eLinks">
                <b>{{link.name}}: </b>{{link.type.name}}
            </p>
        </div>
        <div v-else class="form-group">
            <label>Links</label>
            <label for="addTag " class="mt-2">Add Link</label>
            <input class="form-control" type="text" v-model="link">
            <p v-for="(link, i) in eLinks">
                <span><b>{{link.name}}: </b>{{link.type.name}}
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
            <span @click="submitEdit()" class=" ml-2 btn btn-success btn-sm ">Ok</span>
        </div>
        <span v-if="!edit" @click="edit = true" class="ml-4 btn btn-primary btn-sm text-white">Edit</span>
        <span v-else @click="close()" class=" ml-4 btn btn-danger btn-sm ">Cancel</span>
        <span class="w-100 text-danger" v-for="error in errors">{{error}}</span>
    </div>
</template>
<script>
export default {
    props: ['links', 'client_id'],
    data() {
        return {
            link: '',
            type: '',
            eLinks: this.links.slice(),
            errors: [],
            success: '',
            submit: true,
            edit: false

        }
    },
    computed: {
        mapLinks() {
            return this.eLinks.map((item) => {
                let links = { link: item.name, type_id: item.type.id }
                return links
            })

        }
    },
    methods: {
        close() {
            this.eLinks = this.links.slice();
            this.edit = false;
            this.errors = [];
        },

        setType(value) {
            this.type = value[0];
        },
        addLink() {
            this.errors = [];
            this.validation();

            if (this.errors.length === 0) {
                this.eLinks.push({ type: this.type, name: this.link });


            }
        },
        removeLink(i) {
            this.eLinks.splice(i, 1);
        },
        validation() {
            if (!this.link) {
                this.errors.push('Link is required')
            }
            if (!this.type) {
                this.errors.push('Type is required')
            }
        },
        submitEdit() {
            this.errors = [];
            this.success = "";

            if (this.submit) {
                this.submit = false;
                axios.post('/links', {
                        id: this.client_id,
                        links: this.mapLinks
                    })
                    .then(({ data }) => {
                        this.submit = true;                     
                        this.edit = false;
                        this.errors = []
                    })
                    .catch(error => {
                        this.submit = true;
                        this.errors = error.response.data.errors.name;
                    })
            }
        }
    },

}

</script>
