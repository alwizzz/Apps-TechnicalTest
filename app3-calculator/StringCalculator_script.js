$(document).ready( function() {
    let operationBox = $('#operation');
    let resultBox = $('#result'); 
    let buttonBox = $('#button');

    buttonBox.click( function() {
        let result = kalkulator(operationBox.val(), operationBox);
        if(typeof result == "string"){
            alert(result);
        } else {
            resultBox.val(result);
        }
    })

})

// Cleans up array so it is in appropiate format
function sanitize(arr){
    // remove extra space
    for( let i=0; i < arr.length; i++ ){
        if( arr[i] == '' ){
            arr.splice(i, 1);
            i--; // to handle splice glitch
        }
    }

    // only take first three elements
    arr.splice(3, arr.length-1);
}

// Validate if inputs follow the rules
function validate(left, op, right){

    if( isNaN(left) || op == undefined || isNaN(right) ){
        return "Invalid Input!";
    }
    if( op != '+' && op != '-' && op != '*' && op != '/'){
        return "Invalid Input: operator is not recognized or supported!";
    }
    if( left > 1000000 || right > 1000000){
        return "Invalid Input: number can not be more than 1000000 !";
    }
    
    // if code reach here it means no error
    return "clear";
}

function kalkulator(inputString, operationBox = null){
    let inputArray = inputString.split(" ");
    sanitize(inputArray);
    
    let leftOperand = parseFloat( inputArray[0] );
    let operator = inputArray[1];
    let rightOperand = parseFloat( inputArray[2] );
    
    let error = validate(leftOperand, operator, rightOperand);

    // if error occured, stop code flow here
    if( error != "clear" ){
        return error;
    }

    // display back validated input string if operationBox parameter is assigned
    if(operationBox != null){
        operationBox.val( `${leftOperand.toString()} ${operator} ${rightOperand.toString()}`);
    }

    let result;
    if( operator == "+"){
        result = leftOperand + rightOperand;
    } else if( operator == "-"){
        result = leftOperand - rightOperand;
    } else if( operator == "*"){
        result = leftOperand * rightOperand;
    } else if( operator == "/"){
        result = leftOperand / rightOperand;
    }

    return result;
}