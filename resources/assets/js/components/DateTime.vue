<template>
    <div>
        <Datepicker
            lang="en"
            @change="onChange"
            @input="onInput"
            v-model="date"
        />
        <input ref="input" type="hidden" :name="inputName" :value="date" />
    </div>
</template>
<script>
import VueDatepickerUi from "vue-datepicker-ui";
import "vue-datepicker-ui/lib/vuedatepickerui.css";

export default {
    props: {
        inputName: null,
    },
    computed: {
        date() {},
    },
    methods: {
        onChange() {
            console.log(this.$refs.input);
        },
    },
    components: {
        Datepicker: VueDatepickerUi,
    },
};
</script>