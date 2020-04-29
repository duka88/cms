<template>
    <div class="d-flex align-items-center flex-wrap w-75 justify-content-between">
        <div v-if="!edit">
            <p class="mb-0 w-100"> <span class="text-primary">Curent:</span> {{vCurent | numFormat}} </p>
            <p class="mb-0 w-100"><span class="text-danger">Spent:</span> {{vSurent | numFormat}}</p>
        </div>
        <p v-else class="mb-0 d-flex  align-items-center">
            <span>Curent: </span><input v-model="vCurent" type="number" min="0">
            <span>Spent: </span><input v-model="vSurent" type="number" min="0">
            <span @click="submit()" class=" ml-2 btn btn-success btn-sm ">Ok</span>
        </p>
        <span v-if="!edit" @click="edit = true" class="ml-4 btn btn-primary btn-sm text-white">Edit</span>
        <span v-else @click="close()" class=" ml-4 btn btn-danger btn-sm ">Cancel</span>
        <span class="w-100 text-danger" v-for="error in errors">{{error[0]}}</span>
    </div>
</template>
<script>
export default {
    props: ['client_id', 'curent', 'spent'],
    data() {
        return {
            vCurent: this.curent,
            vSurent: this.spent,
            errors: [],
            edit: false
        }
    },
    methods: {
        submit() {

            axios.post('/budget', {
                    id: this.client_id,
                    curent: this.vCurent,
                    spent: this.vSurent
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
            this.vCurent = this.curent;
            this.vSurent = this.spent;
            this.edit = false;
            this.errors = [];
        }
    },
    filters: {
        numFormat(value) {
            if (value) {
                return new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' }).format(value)
            }
        }
    }
}

</script>
