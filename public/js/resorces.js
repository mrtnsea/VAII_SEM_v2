function assignSelectorCheck() {
    let selector = document.getElementById("selector");
    let input = document.getElementById("fileInput");

    if (selector !== null) {
        input.disabled = selector.value === "Guide";
        selector.addEventListener("change", function() {
            let input = document.getElementById("fileInput");
            input.disabled = selector.value === "Guide";
        })
    }
}

function validateResourceAdd() {
    let fileInput = document.getElementById("fileInput");
    let name = document.getElementById("name");
    let selector = document.getElementById("selector");

    let types = ["Guide", "Banner", "Character Icon", "Splash-art", "Relic Icon", "Relic piece"];
    let fileTypes = ['image/jpeg', 'image/png', 'image/webp'];

    let imageError = document.getElementById("imageError");
    let nameError = document.getElementById("nameError");
    let submitError = document.getElementById("submitError");
    let submitFeedback = document.getElementById("submitFeedback");

    imageError.innerHTML = "";
    nameError.innerHTML = "";
    submitError.innerHTML = "";
    submitFeedback.innerHTML = "";

    if (!types.includes(selector.value)) {
        return false;
    }

    if ((selector.value !== "Guide" && fileInput.files.length === 0)) {
        imageError.innerHTML = "This field is required!";
        return false;
    }

    if (fileInput.files.length !== 0 && !fileTypes.includes(fileInput.files[0].type)) {
        imageError.innerHTML = "File type is not supported, supported types: jpeg, png and webp";
        return false;
    }

    if (typeof name.value != "string" || name.value.trim().length === 0) {
        nameError.innerHTML = "This field is required!";
        return false;
    }

    return true;
}

function assignAddResource() {
    let form = document.getElementById("resourceForm");

    if (form !== null) {
        form.addEventListener("submit", function (event) {
            if (!validateResourceAdd()) {
                event.preventDefault();
            }
        })
    }
}

function assignButtonListeners() {
    let guides =  document.querySelectorAll('.btn-close.guide');
    let images = document.querySelectorAll('.btn-close.img');

    guides.forEach(guide => {
        guide.addEventListener("click", async function () {
            let text = "Do you want to delete this item?";
            if (confirm(text) === true) {
                let response = await fetch("http://localhost?c=resourceApi&a=removeResource",
                    {
                        method: "POST",
                        body: JSON.stringify({
                            type: "guide",
                            id: parseInt(guide.id)
                        }),
                        headers: {
                            "Content-type": "application/json",
                            Accept: "application/json",
                            Cookie: document.cookie
                        }
                    });

                if (response.status === 200) {
                    let success = await response.json()

                    if (success) {
                        let resource = document.getElementById("guide:" + guide.id);
                        resource.remove();
                    }
                }
            }

            document.activeElement.blur();
        })
    });

    images.forEach(image => {
        image.addEventListener("click", async function () {
            let text = "Do you want to delete this item?";
            let classList = image.classList;
            let type = "";

            if (classList.contains("icon")) {
                type = "icon"
            } else if (classList.contains("piece")) {
                type = "piece"
            } else if (classList.contains("banner")) {
                type = "banner"
            } else if (classList.contains("splash")) {
                type = "splash"
            }


            if (confirm(text) === true) {
                let response = await fetch("http://localhost?c=resourceApi&a=removeResource",
                    {
                        method: "POST",
                        body: JSON.stringify({
                            type: type,
                            path: image.id
                        }),
                        headers: {
                            "Content-type": "application/json",
                            Accept: "application/json",
                            Cookie: document.cookie
                        }
                    });

                if (response.status === 200) {
                    let json = await response.json()

                    if (json.success) {
                        let resource = document.getElementById(json.type + ":" + image.id);
                        resource.remove();
                    }
                }
            }

            document.activeElement.blur();
        })
    });
}

window.addEventListener('DOMContentLoaded', assignSelectorCheck);
window.addEventListener('DOMContentLoaded', assignAddResource);
window.addEventListener('DOMContentLoaded', assignButtonListeners);