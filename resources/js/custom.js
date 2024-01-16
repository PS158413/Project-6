// Get the necessary elements
const decreaseBtn = document.getElementById('decreaseBtn');

const increaseBtn = document.getElementById('increaseBtn');
const quantityInput = document.getElementById('quantityInput');
let currentValue = parseInt(quantityInput.value);

// Set the value to 1 if it is null or not a number
if (isNaN(currentValue) || currentValue === null) {
    currentValue = 1;
    quantityInput.value = currentValue;
}
decreaseBtn.addEventListener('click', () => {

    if (currentValue > 1) {
        decreaseBtn.style.opacity = 1;
        currentValue--;
        quantityInput.value = currentValue;
    }
});

// Increase button click event handler
increaseBtn.addEventListener('click', () => {

    currentValue++;
    quantityInput.value = currentValue;
});

document.addEventListener('DOMContentLoaded', function() {
    var quantityInput = document.getElementById('quantityInput');
    var quantityInputValue = document.getElementById('quantityInputValue');

    // Update the value of the hidden input field when the quantity changes
    quantityInput.addEventListener('change', function() {
        quantityInputValue.value = quantityInput.value;
    });

    // Update the value of the hidden input field when the decrease button is clicked
    var decreaseBtn = document.getElementById('decreaseBtn');
    decreaseBtn.addEventListener('click', function() {
        quantityInputValue.value = quantityInput.value;
    });

    // Update the value of the hidden input field when the increase button is clicked
    var increaseBtn = document.getElementById('increaseBtn');
    increaseBtn.addEventListener('click', function() {
        quantityInputValue.value = quantityInput.value;
    });

});
