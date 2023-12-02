function assignEventHandlers() {
    const checkBoxes = document.querySelectorAll('.sidebar input[type="checkbox"]');

    checkBoxes.forEach(checkBox => {
        checkBox.addEventListener('change', function() {
            const guides = document.querySelectorAll('.cardGuide.' + checkBox.className);
            console.log('.cardGuide .' + checkBox.className)

            if (checkBox.checked) {
                guides.forEach(guide => {
                    guide.style.display = 'flex';
                });
            } else {
                guides.forEach(guide => {
                    guide.style.display = 'none';
                });
            }
        });
    });
}

window.addEventListener('DOMContentLoaded', assignEventHandlers);