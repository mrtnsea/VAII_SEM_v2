function assignRelicCheckers() {
    let addButton = document.getElementById("addRelic");
    let relics =  document.querySelectorAll('.btn-close.relic');
    let checkBoxes = document.querySelectorAll('.sidebar input[type="checkbox"]');

    relics.forEach(relic => {
        relic.addEventListener("click", async function () {
            let text = "Do you want to delete this item?";
            if (confirm(text) === true) {
                let response = await fetch("http://localhost?c=relicsApi&a=removeRelic",
                    {
                        method: "POST",
                        body: JSON.stringify({
                            id: parseInt(relic.id)
                        }),
                        headers: {
                            "Content-type": "application/json",
                            Accept: "application/json",
                            Cookie: document.cookie
                        }
                    });

                if (response.status === 204) {
                    let resource = document.getElementById("relic_" + relic.id);
                    resource.remove();
                }
            }

            document.activeElement.blur();
        })
    });

    addButton.addEventListener("click", async function() {
        main = document.getElementById("main");
        first = document.getElementById("first");
        second = document.getElementById("second");
        third = document.getElementById("third");
        path = document.getElementById("type");
        mainErr = document.getElementById("mainError");
        firstErr = document.getElementById("firstError");
        secondErr = document.getElementById("secondError");
        thirdErr = document.getElementById("thirdError");
        uploadErr = document.getElementById("relicUploadError");

        mainErr.innerHTML = "";
        firstErr.innerHTML = "";
        secondErr.innerHTML = "";
        thirdErr.innerHTML = "";
        uploadErr.innerHTML = "";

        mainVal = parseInt(document.getElementById("mainVal").value);
        firstVal = parseInt(document.getElementById("firstVal").value);
        secondVal = parseInt(document.getElementById("secondVal").value);
        thirdVal = parseInt(document.getElementById("thirdVal").value);

        let isValid = true;

        if (isNaN(mainVal)) {
            mainErr.innerHTML = "Number is required!";
            isValid = false;
        } else if (mainVal < 0 || mainVal > 64) {
            mainErr.innerHTML = "Must be from range 0-64";
            isValid = false;
        }

        if (isNaN(firstVal)) {
            firstErr.innerHTML = "Number is required!";
            isValid = false;
        } else if (firstVal < 0 || firstVal > 25) {
            firstErr.innerHTML = "Must be from range 0-25";
            isValid = false;
        }

        if (isNaN(secondVal)) {
            secondErr.innerHTML = "Number is required!";
            isValid = false;
        } else if (secondVal < 0 || secondVal > 25) {
            secondErr.innerHTML = "Must be from range 0-25";
            isValid = false;
        }

        if (isNaN(thirdVal)) {
            thirdErr.innerHTML = "Number is required!";
            isValid = false;
        } else if (thirdVal < 0 || thirdVal > 25) {
            thirdErr.innerHTML = "Must be from range 0-25";
            isValid = false;
        }

        if (!isValid) {
            return;
        }

        if (main.value === first.value || main.value === second.value || main.value === third.value
            || first.value === second.value || first.value === third.value || second.value === third.value) {
            uploadErr.innerHTML = "Can't have multiple stats of the same type!"
            return;
        }

        let response = await fetch("http://localhost?c=relicsApi&a=addRelic",
            {
                method: "POST",
                body: JSON.stringify({
                    path: path.value,
                    main: main.value,
                    mainVal: mainVal,
                    first: first.value,
                    firstVal: firstVal,
                    second: second.value,
                    secondVal: secondVal,
                    third: third.value,
                    thirdVal: thirdVal,
                }),
                headers: {
                    "Content-type": "application/json",
                    Accept: "application/json",
                    Cookie: document.cookie
                }
            });

        if (response.status === 204) {
            location.reload();
            return
        }

        uploadErr.innerHTML = "Upload Failed!"
    });

    checkBoxes.forEach(check => {
        check.addEventListener("change", function () {
            let relics = document.querySelectorAll('.cardGuide');

            relics.forEach(relic => {
                let id = relic.id
                let main = document.getElementById("main_" + id).innerHTML;
                let first = document.getElementById("first_" + id).innerHTML;
                let second = document.getElementById("second_" + id).innerHTML;
                let third = document.getElementById("third_" + id).innerHTML;

                if (check.checked) {
                    if (!main.includes(check.className) && !first.includes(check.className)
                        && !second.includes(check.className) && !third.includes(check.className)) {
                        relic.style.display = "none";
                    }
                } else {
                    if (!main.includes(check.className) && !first.includes(check.className)
                        && !second.includes(check.className) && !third.includes(check.className)) {
                        relic.style.display = "";
                    }
                }
            })
        })
    });
}

window.addEventListener("DOMContentLoaded", assignRelicCheckers);