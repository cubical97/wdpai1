const activity1h = document.querySelectorAll(".activity-block");
const activity2 = document.querySelectorAll(".activity");

function showActivity() {
    const activity = this;

    const id = activity.getAttribute("id");

    var link = location.origin+'/activity/';
    link = link+id;

    location.href = link;
}

activity1h.forEach(button => button.addEventListener("click", showActivity));
activity2.forEach(button => button.addEventListener("click", showActivity));
