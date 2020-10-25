<template>
    <div class="container"> 
        <input type='color' v-model='icolor'  @change="changeColor($event)" />
        
        <div  aria-label="Close" class="close" v-on:click='removeColor'>
            <span aria-hidden="true">×</span>
        </div>
    </div>
</template>

<script>
import {API} from "../service/index";
import {rgbToHex} from "../service/index"

export default {
    props:{
        color:{
            type:Object,
            default(){
                return ""
            }
        },
        id:{
            type:String,
            default(){
                return ""
            }
        }
    },
    data(){
        return {icolor:rgbToHex(this.color)}
    },
    mounted(){
     },
    methods:{
        removeColor(e){
            this.$dialog
                .confirm('Please confirm to continue')
                .then(function(dialog) {
                    console.log('Clicked on proceed');
                })
                .catch(function() {
                    console.log('Clicked on cancel');
                });
        },
        changeColor(e){
            const rgb = hexToRGB(this.newcolor);
            const {red, gree, blue} = rgb;
            API.post("colors/" + this.color.id, {red, green, blue} )
        }
    }
    
}
</script>
<style scoped>
    input{
        width: 400px;
        height: 47px;
    }

    .container{
        height:50px;
        display: flex;
    }

    .close{
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