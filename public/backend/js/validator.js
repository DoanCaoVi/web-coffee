
//đối tượng
function Validator(options){

    //hàm thực hiện validate
    function validate(inputElement, rule){
        var errorMessage = rule.test(inputElement.value);
        var errorElement = inputElement.parentElement.querySelector(options.errorSelector);
        if (errorMessage){
            errorElement.innerText = errorMessage;
            inputElement.parentElement.classList.add('invalid');
        } else{
            errorElement.innerText = '';
            inputElement.parentElement.classList.remove('invalid');
        }
        //console.log(inputElement.parentElement.querySelector('.form-message'))       
    }

    var formElement = document.querySelector(options.form);// lấy được formelement

    if(formElement){
        options.rules.forEach(function (rule){
            var inputElement = formElement.querySelector(rule.selector);
        
            if(inputElement){
                // xử lý trường hợp blur khỏi input
                inputElement.onblur = function(){
                    //value: inputElement.value
                    //test func: rule.test
                    validate(inputElement, rule);
                }
                //xư lý mỗi khi người dùng nhập vào input
                inputElement.oninput = function(){
                    var errorElement = inputElement.parentElement.querySelector(options.errorSelector);
                    errorElement.innerText = '';
                    inputElement.parentElement.classList.remove('invalid');
                }
            }
        })
    }
}

//Định nghĩa các rules
//Nguyên tắc của các rules:
//1. khi có lỗi => trả ra message lỗi
//2. khi hợp lệ => không trả ra cái gì cả(undefined)
Validator.isRequired = function(selector){
    return {
        selector: selector,
        test: function (value){
            return value.trim() ? undefined : 'Vui lòng nhập trường này' //trim() loại bỏ tất cả dấu cách
        }
    };
}

Validator.isEmail = function(selector){
        return {
        selector: selector,
        test: function (value){
           var regex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
           return regex.test(value) ? undefined : 'trường này phải là email'; 
        }
    };
}

Validator.minLength = function(selector, min){
    return {
    selector: selector,
    test: function (value){
       return value.length>=min ? undefined : `vui lòng nhập tối thiểu ${min} ký tự`; 
    }
};
}