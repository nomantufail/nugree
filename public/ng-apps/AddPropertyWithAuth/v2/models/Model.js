/**
 * Created by zeenomlabs on 12/12/2015.
 */
function Model(){
    this.create = function (arg1) {
        console.log('create'+arg1);
    };
    this.read = function () {
        console.log('read');
    };
    this.update = function () {
        console.log('update');
    };
    this.destroy = function () {
        console.log('delete');
    };
    this.save = function () {
        console.log(this);
    };
    this.assign = function (object) {
        for(property in object){
            this[property] = object[property];
        }
    }
}


