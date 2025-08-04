function controlDOMColor() {
    const header = document.querySelector("header")
    const isChecked = header.querySelector("#remote")
    const remoteDisplay = document.querySelector(".remote-display")
    const sectionHeight = document.querySelector("section").offsetHeight

    isChecked.addEventListener("change", () => {
        if (isChecked.checked) {
            remoteDisplay.classList.add("activate")
            header.classList.add("activate")
        } else {
            remoteDisplay.classList.remove("activate")
            header.classList.remove("activate")
        }

        if (scrollY >= sectionHeight) header.classList.add("activate")
    })
    
    window.addEventListener("scroll", () => {
        if (scrollY >= sectionHeight) header.classList.add("activate")
        else header.classList.remove("activate")
    })
}

controlDOMColor()