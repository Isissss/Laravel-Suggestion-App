let likebutton;
let upvoted;
init()

function init() {
    likebutton = document.getElementById('like-btn')
    likebutton.addEventListener('click', likeHandler)

    upvoted = document.getElementById('upvoted-count')
}

function likeHandler(e) {
    e.preventDefault();
    let clicked = e.target
    console.log(likebutton.innerHTML)
    let upvotednum;
    // -1 if unliked, +1 if liked

    likebutton.classList.toggle('voted');
    upvotednum = parseInt(upvoted.innerHTML) + ((likebutton.innerHTML.includes("Upvote")) ? 1 : -1)
    likebutton.innerHTML = likebutton.innerHTML.includes("Upvote") ? "Voted <i class=\"fas fa-thumbs-up\"></i>" : "Upvote <i class=\"far fa-thumbs-up\"></i> "
    upvoted.innerHTML = upvotednum;


    axios.post(`/posts/${clicked.dataset.id}/like`)
        .then(function (res) {

        }).catch(function (res) {
        console.log(res)
    })

}
