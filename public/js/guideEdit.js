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

function assignDeleteHandler() {
    let del = document.getElementById("delete");

    if (del !== null) {
        del.addEventListener("click", function (event) {
            let text = "Do you want to delete this guide?";
            if (!confirm(text)) {
                event.preventDefault();
            }
        })
    }
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

function assignSectionDeletes() {
    let buttons = document.querySelectorAll('.sectionButton');

    buttons.forEach(button => {
        button.addEventListener("click", async function (event) {
            event.preventDefault();
            let text = "Do you want to delete this item?";
            if (confirm(text) === true) {
                let response = await fetch("http://localhost?c=guideApi&a=removeSection",
                    {
                        method: "POST",
                        body: JSON.stringify({
                            id: parseInt(button.id)
                        }),
                        headers: {
                            "Content-type": "application/json",
                            Accept: "application/json",
                            Cookie: document.cookie
                        }
                    });

                if (response.status === 204) {
                    let section = document.getElementById("section_" + button.id);
                    section.remove();
                }
            }

            document.activeElement.blur();
        })
    });
}

window.addEventListener('DOMContentLoaded', assignTextAreaEventHandlers);
window.addEventListener('DOMContentLoaded', assignDeleteHandler);
window.addEventListener('DOMContentLoaded', assignSectionDeletes);
window.addEventListener("DOMContentLoaded", assignImageChangeHandlers)