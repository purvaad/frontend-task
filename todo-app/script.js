let form = document.querySelector("form");
let text = document.getElementById("text");
let todoCon = document.querySelector(".todo-con");

//adds submit event listener to the form
form.addEventListener('submit', (e) => {
    e.preventDefault();
    addtodo();
});

//function to add a new todo item
function addtodo() {
    let todoColl = document.createElement("div");
    todoColl.classList.add("todocoll");
    let todotext = text.value;
    // Adding HTML content for the todo item
    todoColl.innerHTML = `
    <div class="todo-li">
            <div class="check"> 
                <i class="fa-solid fa-check"></i>
            </div>
            <p>${todotext}</p>
            <button class="close"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="line"></div>`;

    //appending the todo item to the todo-container
    todoCon.appendChild(todoColl);

    //adding event listener for the close button
    let close = todoColl.querySelector(".close");
    close.addEventListener("click", () => {
        //removing the todo item when close button is clicked
        todoColl.remove();
        updateTodoVisibility();
        totalItems();  //update total items
    });

    //adding event listener for the check button
    let check = todoColl.querySelector(".check");
    check.addEventListener('click', () => {
        check.classList.toggle("active-check");
        todoColl.children[0].children[1].classList.toggle("complete");
        updateTodoVisibility();
        totalItems(); //update total items 
    });

    text.value = ""; 

    totalItems(); //updating total items
}

//fnction to update todo item visibility on selecting options
function updateTodoVisibility() {
    let info = document.querySelectorAll(".options p");
    let todoli = document.querySelectorAll(".todocoll");

    //adding event listener to each option
    info.forEach(todotext => {
        todotext.addEventListener("click", () => {
            //remove active class from all options
            info.forEach(item => {
                item.classList.remove("active");
            });
            //add active class to the clicked option
            todotext.classList.add("active");

            //loops through each todo item to update visibility
            todoli.forEach(elem => {
                let isCompleted = elem.children[0].children[1].classList.contains("complete");
                if (todotext.innerText === "Active" && !isCompleted) {
                    elem.style.display = "block";
                } else if (todotext.innerText === "Completed" && isCompleted) {
                    elem.style.display = "block";
                } else if (todotext.innerText === "All") {
                    elem.style.display = "block";
                } else {
                    elem.style.display = "none";
                }
            });
        });
    });
}

//add event listener to clear completed todos
let clear = document.querySelector(".clear");
clear.addEventListener("click", () => {
    let completedTodo = document.querySelectorAll(".complete");
    completedTodo.forEach(task => task.parentElement.parentElement.remove());
    totalItems(); //update total items 
});


let total = document.querySelector(".total");
// Function to update total items count
function totalItems() {
    let todoli = document.querySelectorAll(".todocoll");
    let activeTodo = document.querySelectorAll(".todo-li .active-check");
    let diff = todoli.length - activeTodo.length;
    total.innerText = `${diff} items left`; // Update the total items display
}
// Initializing total items count
totalItems();
