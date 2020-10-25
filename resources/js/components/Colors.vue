<template>
    <div class="container">
         <h1>Pick a Color {{newcolor}}</h1>
        <div class ='color_header'>
            <input class='color_picker' type="color" name="color" v-model="newcolor" >
            <button class='btn_add' v-on:click ='addColor'>Add</button>
        </div>
        <div class="colors">
            <div v-for="color in colors" :key="color.id">
                <Color :color="color"/>
            </div>
            
        </div>
    </div>
</template>

<script>
    import Color from "./Color";
    import {API} from "../service/index";
    import {hexToRGB} from "../service/index";

    export default {
        components: { Color },
        data(){
            return {newcolor:"#ffff00", colors:[]}
        },
        mounted() {
            API.get("colors").then(res=>{
                 this.colors = res.data;
            }).catch(err=>console.log(err))
        },
        methods:{
            addColor(){
                const rgb = hexToRGB(this.newcolor);
                const {red, gree, blue} = rgb;
                API.post("colors", {red, green, blue}).then(res=>{
                    this.$dialog.alert('Color is successfully updated').then(function(dialog) {
                    });
                }).catch(err=>{
                    this.$dialog.error('Request completed!').then(function(dialog) {
                    });
                })
            }
        }
    }
</script>

<style scoped>
    .container{
        background: grey;
        height: 100vh;
        text-align: center;
        padding-top:50px;
    }

    h1{
        color:white;
    }

    .color_picker{
        background-color: yellow;
        cursor: pointer;
    }
    
    .btn_add{
        background: blue;
        color: white;
        cursor:pointer;
        width:70px;
        height:50px
    }

    .color_header{
        display: flex;
        align-items: center;
        justify-content: center;
    }

    input{
        height:40px
    }
    
    .colors{
        display: flex;
        flex-direction: row;
        justify-content: center;
    }
</style>
 