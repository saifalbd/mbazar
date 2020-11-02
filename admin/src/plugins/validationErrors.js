
export default function (data,ref='form'){
  
    if (data.hasOwnProperty('errors')) {
        const err = {};
        
        for (const key in data.errors) {
            if (data.errors.hasOwnProperty(key)) {
               err[key]= data.errors[key];     
            }
        }

        
        this.$refs[ref].setErrors(err);
        
    }

}