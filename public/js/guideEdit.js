let unsavedChanges = 0;
let sectionCount = 0;
let save = false;

function assignTextAreaEventHandlers() {
    const inputs = document.querySelectorAll('.edit_area');
    inputs.forEach(input => {
        input.addEventListener('input', () => {
            input.style.height = 'auto';
            input.style.height = (input.scrollHeight + 10) + 'px';
        });
        input.style.height = (input.scrollHeight + 10) + 'px';
    });
}

function assignChangeHandlers() {
    let save = document.querySelector("#save_button")
    let del = document.getElementById("delete");

    if (del !== null) {
        del.addEventListener("click", function (event) {
            let text = "Do you want to delete this guide?";
            if (!confirm(text)) {
                event.preventDefault();
            }
        })
    }

    if (save !== null) {
        save.addEventListener('click', setSave);
    }
}

function setSave() {
    save = true;
}

window.addEventListener('beforeunload', function (event) {
    if (unsavedChanges !== 0 && !save) {
        event.preventDefault();
    }
});

function addSection() {
    sectionCount++;
    unsavedChanges++;
    let form = document.querySelector("#guideForm");
    let div = document.createElement("div");
    let h2 = document.createElement("h2");
    h2.innerText = "Section";
    let innerDiv = document.createElement("div");
    let header = document.createElement("h5");
    header.innerText = "Header";
    let header_text_area = document.createElement("textarea");
    header_text_area.name = "new_header_" + sectionCount;
    let images = document.createElement("h5");
    images.innerText = "Images";
    let new_image = document.createElement("input");
    new_image.name = "image";
    new_image.type = "file";
    new_image.accept = "image/png, image/jpeg, image/webp";
    let cards = document.createElement("h5");
    cards.innerText = "Cards";
    let new_card = document.createElement("input");
    new_card.name = "image";
    new_card.type = "file";
    new_card.accept = "image/png, image/jpeg, image/webp";
    let text = document.createElement("h5");
    text.innerText = "Text";
    let text_text_area = document.createElement("textarea");
    text_text_area.name = "new_text_" + sectionCount;
    let section = document.createElement("input");
    section.name = "new_s_" + sectionCount;
    section.type = "number";
    section.value = sectionCount.toString();
    section.classList.add("hidden");
    innerDiv.appendChild(header);
    innerDiv.appendChild(header_text_area);
    innerDiv.appendChild(images);
    innerDiv.appendChild(new_image);
    innerDiv.appendChild(cards);
    innerDiv.appendChild(new_card);
    innerDiv.appendChild(text);
    innerDiv.appendChild(text_text_area);
    div.classList.add("section");
    div.classList.add("sectionHeader");
    div.appendChild(h2);
    div.appendChild(innerDiv);
    form.appendChild(div);
    form.appendChild(section);
    let buttonDiv = document.querySelector("#buttonDiv");
    form.removeChild(buttonDiv);
    form.appendChild(buttonDiv);
}

function assignImageChangeHandlers() {
    let bins = document.querySelectorAll(".trashBin");
    let addButtons = document.querySelectorAll(".addCardButton, .addImageButton");

    bins.forEach(bin => {
        bin.addEventListener("click", async function () {
            let match = bin.id.match(/\d+/);
            let response = await fetch("http://localhost?c=guideApi&a=removeImage", {
                method: "POST",
                body: JSON.stringify({
                    id: parseInt(match[0])
                }),
                headers: {
                    "Content-type": "application/json",
                    Accept: "application/json",
                    Cookie: document.cookie
                }
            });

            if (response.status === 204) {
                let element = document.getElementById(match[0]);
                element.remove();
            }
        })
    });

    addButtons.forEach(button => {
        button.addEventListener("click", async function () {
            let sectionId = button.id.match(/\d+/);
            let isImage = button.id.startsWith("addImage");
            let cardHeader = document.getElementById("input_" + sectionId);
            let cardHeaderError = document.getElementById("cardHeaderError_" + sectionId);
            let option = document.getElementById("card_" + sectionId).value;
            if (isImage) {
                option = document.getElementById("image_" + sectionId).value;
            }

            if (!isImage) {
                cardHeaderError.innerHTML = "";

                if (cardHeader.value.trim().length === 0) {
                    cardHeaderError.innerHTML = "This field is required!";
                    return;
                }
            }

            let response = await fetch("http://localhost?c=guideApi&a=addImage", {
                method: "POST",
                body: JSON.stringify({
                    id: parseInt(sectionId[0]),
                    path: option,
                    header: isImage ? null : cardHeader.value
                }),
                headers: {
                    "Content-type": "application/json",
                    Accept: "application/json",
                    Cookie: document.cookie
                }
            });

            if (response.status !== 204) {
                return;
            }

            location.reload();
        })
    });
}

window.addEventListener('DOMContentLoaded', assignTextAreaEventHandlers);
window.addEventListener('DOMContentLoaded', assignChangeHandlers);
window.addEventListener("DOMContentLoaded", assignImageChangeHandlers)