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
    document.querySelector("#save_button").addEventListener('click', setSave);
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

window.addEventListener('DOMContentLoaded', assignTextAreaEventHandlers);
window.addEventListener('DOMContentLoaded', assignChangeHandlers);