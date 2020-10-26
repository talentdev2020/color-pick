<template>
    <div class="container">
        <h1>Pick a Color</h1>
        <div class="color_header">
            <input
                 type="color"
                name="color"
                v-model="newcolor"
            />
            <button class="btn_add" v-on:click="addColor">Add</button>
        </div>
        <div class="colors">
            <Color
                :color="color"
                :removeColor="removeColor"
                v-for="color in colors"
                :key="color.id"
            />
        </div>
    </div>
</template>

<script>
import Color from "./Color";
import { API } from "../service/index";
// import {hexToRGB} from "../service/index";

export default {
    components: { Color },
    data() {
        return { newcolor: "#ffff00", colors: [] };
    },
    mounted() {
        API.get("colors")
            .then(res => {
                  console.log(res.data.data)

                this.colors = res.data.data;
            })
            .catch(err => console.log(err));
    },
    methods: {
        addColor() {
            const handler = this;

            API.post("colors", { color: this.newcolor })
                .then(res => {
                    handler.colors.push(res.data);
                })
                .catch(err => {
                    handler.$dialog
                        .alert("Failed to add the color!")
                        .then(function(dialog) {});
                });
        },
        removeColor(id) {
            const handler = this;

            this.$dialog
                .confirm("Please confirm to continue")
                .then(function(dialog) {
                    API.delete(`colors/${id}` )
                        .then(res => {
                            handler.colors = handler.colors.filter(
                                color => color.id !== id
                            );
                        })
                        .catch(err => {
                            handler.$dialog
                                .alert("Filed to delete!")
                                .then(function(dialog) {});
                        });
                });
        }
    }
};
</script>

<style scoped>
.container {
    background: grey;
    height: calc(100vh - 70px);
    text-align: center;
    padding-top: 50px;
}

h1 {
    color: white;
}

.btn_add {
    background: blue;
    color: white;
    cursor: pointer;
    font-weight: 500;
    width: 90px;
    height: 50px;
}

.color_header {
    display: flex;
    align-items: center;
    justify-content: center;
}

input[type="color"] {
	-webkit-appearance: none;
 	width: 42px;
     background: transparent;
 	height: 46px;
    cursor: pointer;
}
input[type="color"]::-webkit-color-swatch-wrapper {
	padding: 0;
}
input[type="color"]::-webkit-color-swatch {
	border: none;
}

.colors {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.colors_item {
    height: 50px;
    margin-top: 5px;
}
</style>
