import LocomotiveScroll from 'https://esm.sh/locomotive-scroll'

window.addEventListener("load", () => {
    const scroll = new LocomotiveScroll({
        el: document.querySelector('[data-scroll-container]'),
        smooth: true,
        lerp: 0.08,
    })
    controlDOM(scroll)
    if (document.body.dataset.page === "works") changeFilmData()
})

function controlDOM(scroll) {
    const header = document.querySelector("header")
    const isChecked = header.querySelector("#remote")
    const remoteDisplay = document.querySelector(".remote-display")
    const sectionHeight = document.querySelector("section").offsetHeight

    scroll.on("scroll", (args) => {
        if (args.scroll.y >= sectionHeight - 25 && args.scroll.y < sectionHeight * 2 - 50) header.classList.add("activate")
        else header.classList.remove("activate")
    })

    isChecked.addEventListener("change", () => {
        if (isChecked.checked) {
            remoteDisplay.classList.add("activate")
            header.classList.remove("activate")
        } else {
            remoteDisplay.classList.remove("activate")
            header.classList.add("activate")
            if (scroll.scroll.instance.scroll.y >= sectionHeight - 25 && scroll.scroll.instance.scroll.y < sectionHeight * 2 - 50) header.classList.add("activate")
            else header.classList.remove("activate")
        }
    })
    
    window.addEventListener("scroll", () => {
        if (scrollY >= sectionHeight - 25 && scrollY < sectionHeight * 2 - 50) header.classList.add("activate")
        else header.classList.remove("activate")
    })
}

function changeFilmData() {
    const fixedFilm = document.querySelector(".fixed-film img")
    const filmList = document.querySelectorAll(".film-grid .film")
    let selected = null

    filmList.forEach(film => {
      film.querySelector("img").addEventListener("click", (e) => {
        (scroll?.scrollTo || ((y) => window.scrollTo({ top: y, behavior: 'auto' })))(0);

        if (fixedFilm.src === film.querySelector("img").src) return

        if (selected) selected.classList.remove("selected")
        selected = e.target
        selected.classList.add("selected")
        fixedFilm.parentNode.style.opacity = 0
        
        setTimeout(() => {
            fixedFilm.src = film.querySelector("img").src

            if (fixedFilm.offsetHeight > fixedFilm.offsetWidth) fixedFilm.classList.add("short-horizontal")
            else fixedFilm.classList.remove("short-horizontal")

            fixedFilm.parentNode.style.opacity = 1
        }, 250)
      })
    })
}