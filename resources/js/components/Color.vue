<template>
    <div class="color-body">
        <input type="color" v-model="icolor" @change="changeColor($event)" />

        <div
            aria-label="Close"
            class="close"
            v-on:click="removeColor(color.id)"
        >
            <span aria-hidden="true">×</span>
        </div>
    </div>
</template>

<script>
import { API } from "../service/index";

export default {
    props: {
        color: {
            type: Object,
            default() {
                return "";
            }
        },
        removeColor: { type: Function }
    },
    data() {
        return { icolor: this.color.color };
    },
    mounted() {},

    methods: {
        changeColor(e) {
            const handler = this;

            API.put("colors/" + this.color.id, { color: this.icolor })
                .then(res => {})
                .catch(err => {
                    handler.$dialog
                        .alert("Filed to update!")
                        .then(function(dialog) {});
                });
        }
    }
};
</script>
<style scoped>
input {
    width: 400px;
    height: 47px;
}

.color-body {
    height: 50px;
    display: flex;
    margin-top: 5px;
}

.close {
    height: 50px;
    display: flex;
    justify-content: center;
    align-items: center;
    width: 40px;
    cursor: pointer;
    color: white;
    font-size: 34px;
    background: cornflowerblue;
}
</style>
