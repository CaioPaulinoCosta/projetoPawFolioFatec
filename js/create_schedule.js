const datePicker = document.getElementById('datePicker');
const today = new Date();
const year = today.getFullYear();
const month = String(today.getMonth() + 1).padStart(2, '0');
const day = String(today.getDate()).padStart(2, '0');
const minDate = `${year}-${month}-${day}`;

datePicker.min = minDate;

const selectedDateInput = document.getElementById('datePicker');
const horarioRow = document.getElementById('horarioRow');

selectedDateInput.addEventListener('change', function() {
    if (selectedDateInput.value !== '') {
        horarioRow.style.display = 'block';
    } else {
        horarioRow.style.display = 'none';
    }
});

function togglePaymentForm(show) {
    var paymentRow = document.getElementById("paymentRow");
    paymentRow.style.display = show ? "block" : "none";
}