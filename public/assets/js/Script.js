



function search() {

    if (document.getElementById('search').classList.contains('search')) {
        document.getElementById('search').classList.remove('search');
             document.getElementById('navbar').classList.add("nav");

    } else {
        document.getElementById('search').classList.add('search');
            document.getElementById('navbar').classList.remove("nav");

    }

}

function searchExit() {
    document.getElementById('search').classList.add('search');
     document.getElementById('navbar').classList.remove("nav");
}


function userListState(event) {
    console.log(event);
    var elems = document.querySelector("#userList.active");
    if(elems !==null){
        elems.classList.remove("active");
    }
        event.target.classList.add("active");

}


