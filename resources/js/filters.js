document.addEventListener('DOMContentLoaded', function () {
    const locationSelect = document.getElementById('locationFilter');
    const typeSelect = document.getElementById('typeFilter');
    const cards = document.querySelectorAll('.card');

    function filterCards() {
        const locationValue = locationSelect.value;
        const typeValue = typeSelect.value;

        cards.forEach(card => {
            const cardLocation = card.getAttribute('data-location');
            const cardType = card.getAttribute('data-type');

            const locationMatch = (locationValue === "" || locationValue === "---Location---" || cardLocation === locationValue);
            const typeMatch = (typeValue === "" || typeValue === "-----Type-----" || cardType === typeValue);

            if (locationMatch && typeMatch) {
                card.parentElement.style.display = ""; // Show the card's column
            } else {
                card.parentElement.style.display = "none"; // Hide the card's column
            }
        });
    }

    if (locationSelect && typeSelect) {
        locationSelect.addEventListener('change', filterCards);
        typeSelect.addEventListener('change', filterCards);
    }
});