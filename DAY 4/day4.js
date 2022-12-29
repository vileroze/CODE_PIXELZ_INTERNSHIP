//function that returns the number of values in string
function billCalc(){

    //get units
    let units = document.getElementById("units").value;
    let ppu = 0; 

    //check if units empty
    if(units===null || units==="") return alert("Units cannot be empty !!");

    //calculate price per unit
    if(units<=115){
        ppu = 9;
    }else if(units>115 && units<=125){
        ppu = 12;
    }else{
        ppu = 15;
    }

    //display result
    let result = "Your total bill is: " + units + "units X Rs." + ppu + " = Rs." + units*ppu;
    document.getElementById("bill-result").innerHTML = result;
}