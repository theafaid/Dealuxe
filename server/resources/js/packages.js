//=============== VUE JS ==================//
window.Vue = require('vue');

//=============== V-FORM =================//
import { Form, HasError, AlertError } from 'vform'
Vue.component(HasError.name, HasError);
Vue.component(AlertError.name, AlertError);
window.Form = Form;

//============= CK-EDITOR =================//
import CKEditor from '@ckeditor/ckeditor5-vue';
Vue.use( CKEditor );

//============== IMAGE UPLOADER, RESIZE ===========//
import ImageUploader from 'vue-image-upload-resize'
Vue.use(ImageUploader);


Vue.prototype.trans = (string, args) => {
    let value = _.get(window.i18n, string);

    _.eachRight(args, (paramVal, paramKey) => {
        value = _.replace(value, `:${paramKey}`, paramVal);
    });
    return value;
};
