let tableLine = document.querySelectorAll(".table-line");
console.log(tableLine);
let i=0
tableLine.forEach((line)=>{
    if(i%2){
        line.classList.add("grey");
    }
    i++;
})



let coll = document.querySelector(".collapsible");
console.log(coll)
coll.addEventListener("click", function() {

    coll.classList.toggle("active");
    let content = this.nextElementSibling;
    content.classList.toggle("active_content");

});
