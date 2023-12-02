function hideEmptySections() {
    const sections = document.querySelectorAll('.section');

    sections.forEach(section => {
        const containers = section.querySelectorAll('.container')
        if (containers?.length === section.children.length) {
            containers.forEach(container => {
                if (container.value !== null || container.children.length !== 0) {
                    return;
                }
            })
            section.style.display = 'none';
        }
    });
}

window.addEventListener('DOMContentLoaded', hideEmptySections);