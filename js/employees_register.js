// formata input cpf
const employeeCpfInput = document.getElementById("employee_cpf");

employeeCpfInput.addEventListener("input", function() {
  let inputValue = employeeCpfInput.value;
  inputValue = inputValue.replace(/\D/g, ""); // Remove todos os caracteres não numéricos

  if (inputValue.length > 11) {
    inputValue = inputValue.slice(0, 11);
  }

  if (inputValue.length > 3 && inputValue.length <= 6) {
    inputValue = `${inputValue.slice(0, 3)}.${inputValue.slice(3)}`;
  } else if (inputValue.length > 6 && inputValue.length <= 9) {
    inputValue = `${inputValue.slice(0, 3)}.${inputValue.slice(3, 6)}.${inputValue.slice(6)}`;
  } else if (inputValue.length > 9) {
    inputValue = `${inputValue.slice(0, 3)}.${inputValue.slice(3, 6)}.${inputValue.slice(6, 9)}-${inputValue.slice(9)}`;
  }

  employeeCpfInput.value = inputValue;
});

// verifica senha e email
const employeeEmailInput = document.getElementById("employee_email");
const emailErrorEmployee = document.getElementById("email_error_employee");
const employeePasswordInput = document.getElementById("employee_password");
const passwordErrorEmployee = document.getElementById("password_error_employee");
const loginButtonEmployee = document.getElementById("loginButtonEmployee");

employeeEmailInput.addEventListener("blur", function() {
  const inputValue = employeeEmailInput.value;

  if (inputValue.endsWith("@outlook.com") || inputValue.endsWith("@gmail.com") || inputValue.endsWith("@hotmail.com")) {
    emailErrorEmployee.style.display = "none";
  } else {
    emailErrorEmployee.style.display = "block";
  }
});

employeePasswordInput.addEventListener("input", function() {
  const inputValue = employeePasswordInput.value;

  const hasSpecialChar = /[!@#$%^&*()_+{}\[\]:;<>,.?~\-]/.test(inputValue);
  const hasUppercase = /[A-Z]/.test(inputValue);
  const hasNumber = /\d/.test(inputValue);

  if (hasSpecialChar && hasUppercase && hasNumber) {
    passwordErrorEmployee.style.display = "none";
  } else {
    passwordErrorEmployee.style.display = "block";
  }
});

employeeEmailInput.addEventListener("input", function() {
  const inputValue = employeeEmailInput.value;

  if (inputValue.endsWith("@hotmail.com") || inputValue.endsWith("@gmail.com") || inputValue.endsWith("@outlook.com")){
    emailErrorEmployee.style.display = "none";
    if (!passwordErrorEmployee.style.display || passwordErrorEmployee.style.display === "none") {
      loginButtonEmployee.removeAttribute("disabled");
    }
  } else {
    emailErrorEmployee.style.display = "block";
    loginButtonEmployee.setAttribute("disabled", true);
  }
});

employeePasswordInput.addEventListener("blur", function() {
  const inputValue = employeePasswordInput.value;

  const hasSpecialChar = /[!@#$%^&*()_+{}\[\]:;<>,.?~\-]/.test(inputValue);
  const hasUppercase = /[A-Z]/.test(inputValue);
  const hasNumber = /\d/.test(inputValue);

  if (hasSpecialChar && hasUppercase && hasNumber) {
    passwordErrorEmployee.style.display = "none";
    if (!emailErrorEmployee.style.display || emailErrorEmployee.style.display === "none") {
      loginButtonEmployee.removeAttribute("disabled");
    }
  } else {
    passwordErrorEmployee.style.display = "block";
    loginButtonEmployee.setAttribute("disabled", true);
  }
});
