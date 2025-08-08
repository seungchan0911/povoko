import LocomotiveScroll from 'https://esm.sh/locomotive-scroll'

function controlDOMColor() {
    const header = document.querySelector("header")
    const isChecked = header.querySelector("#remote")
    const remoteDisplay = document.querySelector(".remote-display")
    const sectionHeight = document.querySelector("section").offsetHeight

    const scroll = new LocomotiveScroll({
      el: document.querySelector('[data-scroll-container]'),
      smooth: true,
      lerp: 0.08,
    })

    scroll.on("scroll", (args) => {
        if (isChecked.checked) return
        else if (args.scroll.y >= sectionHeight - 25 && args.scroll.y < sectionHeight * 2 - 50) header.classList.add("activate")
        else header.classList.remove("activate")
    })

    isChecked.addEventListener("change", () => {
        if (isChecked.checked) {
            remoteDisplay.classList.add("activate")
            header.classList.add("activate")
        } else {
            remoteDisplay.classList.remove("activate")
            header.classList.remove("activate")
            if (scroll.scroll.instance.scroll.y >= sectionHeight - 25 && scroll.scroll.instance.scroll.y < sectionHeight * 2 - 50) header.classList.add("activate")
            else header.classList.remove("activate")
        }
    })
    
    window.addEventListener("scroll", () => {
        if (scrollY >= sectionHeight - 25 && scrollY < sectionHeight * 2 - 50) header.classList.add("activate")
        else header.classList.remove("activate")
    })
}

controlDOMColor()