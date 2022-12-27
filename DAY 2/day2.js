//function that returns the number of values in string
function vowelCount(){

    //get element
    var input_str = document.getElementById("input-str").value;

    //check if element is empty
    if(input_str===null || input_str==="") return alert("First enter a string !!");

    //calculate number of vowels
    var result = "Number of vowel in string is: ";
    count = 0;
    vowels = ['a','e','i','o','u'];
    vowel_count = 0;

    for(var i=0; i<input_str.length; i++){
        if(vowels.includes(input_str.charAt(i))){
            console.log("vowel");
            vowel_count++;
        }
    }
    
    //display result
    result += vowel_count;
    document.getElementById("vowel-result").innerHTML = result;
}