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
import {hexToRGB} from "../service/index"

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
                    API.delete("colors/" + this.color.id ).then(res=>{
                        this.$dialog.alert('Color is successfully deleted').then(function(dialog) {         
                        });
                    }).catch(err=>{
                        this.$dialog.alert('Filed to delete!').then(function(dialog) {
                        });
                    })
                })
                 
        },
        changeColor(e){
            const rgb = hexToRGB(this.icolor);
            const {red, green, blue} = rgb;
            API.post("colors/" + this.color.id, {red, green, blue} ).then(res=>{
                this.$dialog.alert('Color is successfully updated').then(function(dialog) {         
                });
            }).catch(err=>{
                this.$dialog.alert('Filed to update!').then(function(dialog) {
                });
            })
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