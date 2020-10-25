<template>
    <div class="container">
         <h1>Pick a Color {{color}}</h1>
        <div class ='color_header'>
            <input class='color_picker' type="color" name="color" v-model="color" >
            <button class='btn_add' >Add</button>
        </div>
        <div class="colors">
            <Color color="#ff0000"/>
        </div>
    </div>
</template>

<script>
    import Color from "./Color";

    export default {
        components: { Color },
        data(){
            return {color:"#ffff00"}
        },
        mounted() {
            console.log('Component mounted.')
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
 