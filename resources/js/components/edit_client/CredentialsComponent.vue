<template>
    <div class="d-flex align-items-center flex-wrap w-75 justify-content-between">
        <div v-if="!edit">
            <p class="mb-0 w-100" v-for="credential in vCredentials">
                <b>{{credential.name}}: </b>{{credential.value}}
            </p>
        </div>
        <div v-else class="mb-0 d-flex  align-items-center">
            <span>Name: </span><input v-model="name" type="text">
            <span>Value: </span><input v-model="value" type="text">
            <p v-for="(credential, i) in vCredentials">
                <span><b>{{credential.name}}: </b>{{credential.value}}
                    <span @click="removeCard(i)" class="ml-3 pointer"><b>X</b></span></span>
            </p>
            <span @click="addCrad()" class=" ml-2 btn btn-success btn-sm ">Add Credantial</span>
            <span @click="submit()" class=" ml-2 btn btn-success btn-sm ">Ok</span>
        </div>
        <span v-if="!edit" @click="edit = true" class="ml-4 btn btn-primary btn-sm text-white">Edit</span>
        <span v-else @click="close()" class=" ml-4 btn btn-danger btn-sm ">Cancel</span>
        <span class="w-100 text-danger" v-for="error in errors">{{error[0]}}</span>
    </div>
</template>
<script>
export default {
    props: ['client_id', 'credentials'],
    data() {
        return {
            name: '',
            value: '',
            errors: [],
            edit: false,
            vCredentials: JSON.parse(this.credentials),
            ok: false

        }
    },
    computed: {
        mapCred() {
            return this.vCredentials.map((item) => {
                let cred = { name: item.name, value: item.value }
                return cred
            })

        }
    },
    methods: {
        addCrad() {
            this.errors = [];
            this.validation();

            if (this.errors.length === 0) {
                this.vCredentials.push({ name: this.name, value: this.value });
                this.name = "";
                this.value = "";

            }
        },
        removeCard(i) {
            this.vCredentials.splice(i, 1);
        },
        validation() {
            if (!this.name) {
                this.errors.push('Name is required')
            }
            if (!this.value) {
                this.errors.push('Value is required')
            }
        },
        submit() {
            if (!this.ok) {
                this.ok = true;
                this.errors = [];
                axios.post('/credentials', {
                        id: this.client_id,
                        creds: this.mapCred
                    })
                    .then(({ data }) => {
                        this.edit = false;
                        this.ok = false;
                    })
                    .catch((error) => {


                    })
            } 
        },
        close() {
            this.vCredentials = JSON.parse(this.credentials);
            this.edit = false;
            this.errors = [];
        }
    },

}

</script>
