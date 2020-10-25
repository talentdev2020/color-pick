import { apiUrl } from '../config/index'
import axios from 'axios'

export const API = axios.create({
    baseURL: apiUrl,
})

function componentToHex(c) {
    var hex = c.toString(16);
    return hex.length == 1 ? "0" + hex : hex;
  }
  
export const rgbToHex = (rgb) =>{
    const {red,green,blue} = rgb;
    
   return "#" + componentToHex(red) + componentToHex(green) + componentToHex(blue);
}

export const hexToRGB = (hex) =>{
  var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
  return result ? {
    red: parseInt(result[1], 16),
    green: parseInt(result[2], 16),
    blue: parseInt(result[3], 16)
  } : null;
}
