/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function Person(name, ci, cant) {
  this.name = name;
  this.ci = ci;
  this.cantFamilia = cant;
}

var data = {
    "3942308": {
        "ci" : "3942308",
        "name" : "vicente",
        "cantfamilia" : "5"
    }
}


function search(){
    var cedula = document.getElementById("cedula-b").value;
    var person = data[cedula];
    var p = new Person(person.name, person.ci, person.cantFamilia);
    console.log(person);
    return p;
}

