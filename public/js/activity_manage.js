const joinleftButton = document.querySelectorAll(".menubutton");

function changeStatus() {
    const button = this;

    const id = button.getAttribute("id");

    var link = location.origin+'/';

    if(id === "activ-join")
    {
        const container = button.parentElement.parentElement;
        const id_a = container.getAttribute("id");

        fetch(`/join/${id_a}`)
            .then(function () {
                button.innerHTML = button.innerHTML + " V ";
            })
    }
    else if(id === "activ-left")
    {
        const container = button.parentElement.parentElement;
        const id_a = container.getAttribute("id");

        fetch(`/left/${id_a}`)
            .then(function () {
                button.innerHTML = button.innerHTML + " V ";
            })
    }
    else
    {
        link = link+id;
        location.href = link;
    }
}

joinleftButton.forEach(button => button.addEventListener("click", changeStatus));