function controlRemote() {
    const header = document.querySelector("header")
    const isChecked = header.querySelector("#remote")
    const remoteDisplay = document.querySelector(".remote-display")

    isChecked.addEventListener("change", () => {
        if (isChecked.checked) {
            remoteDisplay.classList.add("activate")
            header.classList.add("activate")
        } else {
            remoteDisplay.classList.remove("activate")
            header.classList.remove("activate")
        }
    })
}

controlRemote()