import FloatAlertMessage from "@/Components/FloatAlertMessage.vue";

export default class {
    constructor() {
        // 
    }
    
    static dialog(props = {}) {
        console.log('FloatAlertMessage', FloatAlertMessage)
        var elem = document.createElement('div');
        elem.append("<FloatAlertMessage />");
        elem.style.cssText = 'z-index:99999;position:fixed;width:100%;height:100%;opacity:0.3;z-index:100;background:#000;top:0;bottom:0;right:0;left:0;';
        elem.className = "sample";
        document.body.appendChild(elem);
    }
}
