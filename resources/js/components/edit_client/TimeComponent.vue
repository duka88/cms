<template>
    <div class="d-flex align-items-center flex-wrap w-75 justify-content-between">
        <div v-if="!edit">
            <p class="mb-0 w-100"><span class="text-success">Started:</span> {{vStarted | numFormat}}</p>
            <p class="mb-0 w-100"> <span class="text-primary">Time Frame:</span> {{vTimeFrame | numFormat }} </p>
            <p class="mb-0 w-100"><span class="text-danger">Finshid:</span> {{vFinshid | numFormat}}</p>
        </div>
        <p v-else class="mb-0 d-flex  align-items-center">
            <span>Started: </span><input v-model="vStarted" type="date" min="0">
            <span>Time Frame: </span><input v-model="vTimeFrame" type="date" min="0">
            <span>Finshid: </span><input v-model="vFinshid" type="date" min="0">
            <span @click="submit()" class=" ml-2 btn btn-success btn-sm ">Ok</span>
        </p>
        <span v-if="!edit" @click="edit = true" class="ml-4 btn btn-primary btn-sm text-white">Edit</span>
        <span v-else @click="close()" class=" ml-4 btn btn-danger btn-sm ">Cancel</span>
        <span class="w-100 text-danger" v-for="error in errors">{{error[0]}}</span>
    </div>
</template>
<script>
export default {
    props: ['client_id', 'started', 'time_frame', 'finished'],
    data() {
        return {
            vStarted: this.started,
            vTimeFrame: this.time_frame,
            vFinshid: this.finished,
            errors: [],
            edit: false
        }
    },
    methods: {
        submit() {

            axios.post('/time', {
                    id: this.client_id,
                    'started': this.vStarted,
                    'time_frame': this.vTimeFrame,
                    'finished': this.vFinshid
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
            this.vStarted = this.started;
            this.vTimeFrame = this.time_frame;
            this.vFinshid = this.finished;
            this.edit = false;
            this.errors = [];
        }
    },
    filters: {
        numFormat(value) {
            if (value) {
                var tim = new Date(value);


                return `${tim.getDate()}/${tim.getMonth()+1}/${tim.getFullYear()}`
            }
        }
    }
}

</script>
