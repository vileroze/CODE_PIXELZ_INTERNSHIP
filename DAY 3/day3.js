const person = {
    name: "Mosh",
    walk(){},
    talk(){}
};

//when you dont know what property will be modified
person.walk();
person.name = '';

const targetMember = 'name';
person[targetMember.value] = 'John';



//"this" keyword
const person2 = {
    name: 'vileroze',
    walk(){
        console.log(this);
    }
};

person2.walk();

let ex1 = person2.walk;
ex1(); //returns undefined

let ex2 = person2.walk.bind(person2); //sets the value of "this" permanently
ex2();



//arrow functions
const jobs=[
    {id:1, isActive:true},
    {id:2, isActive:true},
    {id:3, isActive:false},
    {id:4, isActive:true},
];

//both below does the same thing
const activeJobs = jobs.filter(function (job){return job.isActive;});
const activeJobs2 = jobs.filter(job => job.isActive); //brackets not required ffor only one argument

const peron3 = {
    talk(){
        setTimeout(() => {
            console.log("this", this);
        }, timeout);
    }
}

person.talk();



//maps
const colors = ['red', 'green', 'blue'];
const indColors = colors.map(color => `<li>${color}</li>`);
console.log(indColors);




//object destructuring
const address = {
    street:'',
    city: '',
    country: ''
};

//both below extracts propert and store it

const street_add = address.street;
const city_add = address.city;
const country_add = address.country;

const {street:st, city:ct, country:cy} = address; //set aliases using ":"




//spread operator
const first = [1,2,3];
const second = [4,5,6];

//you can do either of the two, but using the spread operator you can add things in the middle
const combined = first.concat(second);
const combined2 = [...first, 'a', ...second,'b'];

//you can clone arrays
const clone = [...first];

//you can conbime two objects and also add properties
const obj1 = {name: "Mosh"};
const obj2 = {job: "translator"};

const obj_combined = {...obj1, ...obj2, language:"chinese"};

const obj1_clone = {...obj1}; //clone obj1






//classes
class Person{
    constructor(name){
        this.name = name;
    }

    walk(){
        console.log("walk");
    }
}

const pp = new Person('gg');
pp.walk();


//inheritance
class Teacher extends Person{
    constructor(name, degree){
        super(name);
        this.degree = degree;
    }


    teach(){
        console.log("teach");
    }
}

const th = new Teacher("Rohan", "MSc. Computing");
th.walk();
console.log(th.degree);