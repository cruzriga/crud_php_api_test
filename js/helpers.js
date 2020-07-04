"use strict";

function _typeof(obj) { if (typeof Symbol === "function" && typeof Symbol.iterator === "symbol") { _typeof = function _typeof(obj) { return typeof obj; }; } else { _typeof = function _typeof(obj) { return obj && typeof Symbol === "function" && obj.constructor === Symbol && obj !== Symbol.prototype ? "symbol" : typeof obj; }; } return _typeof(obj); }

// HELPER FUNCTION TO CHECK IF A VARIABLE ITS EMPTY
function empty(variable) {
    return typeof variable == 'undefined' || //undefined
           variable === null //null
           || variable === false //!variableiable     //false
           || variable.length === 0
           || (typeof variable === 'object' && !Object.keys(variable).length) //empty
           || variable.toString().trim() === "" //empty
           || variable.toString().replace(/\s/g, "") === "" //empty
           || !/[^\s]/.test(variable) //empty
           || /^\s*$/.test(variable) //empty
        ;
}

function isEmail(email) {
    var Emailreg = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
    return Emailreg.test(email);
}

var isDate =  function(txtDate) {
    var currVal = txtDate;
    if(currVal == '') return false;
    
    var rxDatePattern = /^(\d{4})(\/|-)(\d{1,2})(\/|-)(\d{1,2})$/; //Declare Regex
    var dtArray = currVal.match(rxDatePattern); // is format OK?
    
    if (dtArray == null)
        return false;
    
    //Checks for mm/dd/yyyy format.
    
    var dtYear  = dtArray[1];
    var dtMonth = dtArray[3];
    var dtDay   = dtArray[5];
    //alert("dia:"+dtDay+" mes:"+dtMonth+ " año:"+dtYear+"valor:"+dtArray);
    
    if (dtMonth < 1 || dtMonth > 12)
        return false;
    else if (dtDay < 1 || dtDay> 31)
        return false;
    else if ((dtMonth==4 || dtMonth==6 || dtMonth==9 || dtMonth==11) && dtDay ==31)
        return false;
    else if (dtMonth == 2)
    {
        var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
        if (dtDay> 29 || (dtDay ==29 && !isleap))
            return false;
    }
    return true;
};


var isText =function(texto) {
    var re =  /^[a-zA-ZáéíóúñÁÉÍÓÚÑ\s]*$/;
    return re.test(texto);
};

var hasNumbers = function(texto) {
    var n = 0;
    texto = texto.split('');
    $.each(texto, function(index, letra){ if(!isNaN(letra)){ n++;}});
    return(n);
};


var _loading = function _loading() {
    var load = this;
    var $parent = $("#loading");
    
    load.show = function (parent) {
      $parent.css('display', 'flex');
    };
    
    load.hide = function (parent) {
        $parent.css('display', 'none');
    };
};


var Toast = function _toast() {
    var doptions = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
    var options = {
        text: null,
        title: "",
        icon: "info",
        timer: 4000,
    };
    
    if (!empty(doptions) && _typeof(doptions) == 'object') {
        options = $.extend({}, options, doptions); //options = { ...options, ...doptions}
    }
    
    if (!empty(doptions) && typeof doptions == 'string') {
        options.title = doptions;
    }
    
    _Toast.fire(options);
};

var _Toast = Swal.mixin({
                           toast            : true,
                           position         : 'top-end',
                           showConfirmButton: false,
                           timer            : 3000,
                           timerProgressBar : true,
                           onOpen           : (toast) => {
                               toast.addEventListener('mouseenter', Swal.stopTimer)
                               toast.addEventListener('mouseleave', Swal.resumeTimer)
                           }
                       });




