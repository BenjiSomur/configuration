// let js = "amazing";
// console.log(40 + 8 + 23 - 10);
// console.log('Jonas');
// console.log(87.5);

/////////////////// Assignment ///////////////////////
//////////////// Values and variables ///////////////

// let country = 'Mexico';
// let continent = 'North-America';
// let population = 130000000;
// console.log(country)
// console.log(continent)
// console.log(population)

///////////////////// Data types ////////////////////
//numbers
// let age = 25;

// //string 
// let firstName = 'Juan';

// //boolean
// let fullAge = true;

// //undefined
// let children;

// let javascriptIsFun = true;
// console.log(javascriptIsFun);
// // console.log(typeof true);
// console.log(typeof javascriptIsFun);
// // console.log(typeof 23);
// // console.log(typeof 'juan');

// /////////// Dynamic typing ////////////

// javascriptIsFun = 'YES!'
// console.log(javascriptIsFun);
// console.log(typeof javascriptIsFun)


//$$$$$$$$$$$$$$$$$$$$$$ Challenge $$$$$$$$$$$$$$$$$$
///////// Set 1 ///////////////
// let johnHeight = 1.95
// let johnWeight = 92
// let markHeight = 1.69
// let markWeight = 78

/////////////// Set 2 //////////// 
// let johnHeight = 1.76;
// let johnWeight = 85;
// let markHeight = 1.88;
// let markWeight = 95;


// markBMI = markWeight / (markHeight ** 2);
// johnBMI = johnWeight / (johnHeight ** 2);

// markHigherBMI = markBMI > johnBMI;
// console.log(markBMI, johnBMI);
// console.log(markHigherBMI);
//$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$$

// let firstName = 'Juan';
// let job = 'student';
// const birthYear = 1998;
// const year = 2023;

// const presentation = `I'm ${firstName}, a ${year - birthYear} years old ${job}!`
// console.log(presentation)

////////////// statements ///////////////
let age = 15;
const isOldEnough = age >= 18;
if (isOldEnough) {
    console.log('Sarah can have a driving license and INE');
} else {
    let yearsLeft = 18 - age;
    console.log('Sarah is too young to drive D:');
    console.log(`Sarah needs to wait ${yearsLeft} more years`);
}

