// formata input data de nascimento
const input = document.getElementById("user_birthday");

input.addEventListener("input", function() {
  let inputValue = input.value;
  inputValue = inputValue.replace(/\D/g, ""); // Remove todos os caracteres não numéricos

  if (inputValue.length > 8) {
    inputValue = inputValue.slice(0, 8);
  }

  if (inputValue.length >= 3) {
    const day = inputValue.slice(0, 2);
    const month = inputValue.slice(2, 4);
    const year = inputValue.slice(4, 8);

    inputValue = `${day}/${month}/${year}`;
  }

  input.value = inputValue;
});

// formata input telefone
const userPhoneInput = document.getElementById("user_phone");

userPhoneInput.addEventListener("input", function() {
  let inputValue = userPhoneInput.value;
  inputValue = inputValue.replace(/\D/g, ""); // Remove todos os caracteres não numéricos

  if (inputValue.length > 11) {
    inputValue = inputValue.slice(0, 11);
  }

  if (inputValue.length > 2 && inputValue.length <= 6) {
    inputValue = `(${inputValue.slice(0, 2)}) ${inputValue.slice(2)}`;
  } else if (inputValue.length > 6) {
    inputValue = `(${inputValue.slice(0, 2)}) ${inputValue.slice(2, 7)}-${inputValue.slice(7)}`;
  }

  userPhoneInput.value = inputValue;
});

// formata input cpf
const userCpfInput = document.getElementById("user_cpf");

userCpfInput.addEventListener("input", function() {
  let inputValue = userCpfInput.value;
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

  userCpfInput.value = inputValue;
});


const useremailInput = document.getElementById("user_email");
const emailError = document.getElementById("email_error");
const userPasswordInput = document.getElementById("user_password");
const passwordError = document.getElementById("password_error");
const entrarButton = document.getElementById("entrarButton");

useremailInput.addEventListener("blur", function() {
  const inputValue = useremailInput.value;

  if (inputValue.endsWith("@hotmail.com") || inputValue.endsWith("@gmail.com") || inputValue.endsWith("@outlook.com")) {
    emailError.style.display = "none";
  } else {
    emailError.style.display = "block";
  }
});

userPasswordInput.addEventListener("input", function() {
  const inputValue = userPasswordInput.value;

  const hasSpecialChar = /[!@#$%^&*()_+{}\[\]:;<>,.?~\-]/.test(inputValue);
  const hasUppercase = /[A-Z]/.test(inputValue);
  const hasNumber = /\d/.test(inputValue);

  if (hasSpecialChar && hasUppercase && hasNumber) {
    passwordError.style.display = "none";
  } else {
    passwordError.style.display = "block";
  }
});

useremailInput.addEventListener("input", function() {
  const inputValue = useremailInput.value;

  if (inputValue.endsWith("@hotmail.com") || inputValue.endsWith("@gmail.com") || inputValue.endsWith("@outlook.com")) {
    emailError.style.display = "none";
    if (!passwordError.style.display || passwordError.style.display === "none") {
      entrarButton.removeAttribute("disabled");
    }
  } else {
    emailError.style.display = "block";
    entrarButton.setAttribute("disabled", true);
  }
});

userPasswordInput.addEventListener("blur", function() {
  const inputValue = userPasswordInput.value;

  const hasSpecialChar = /[!@#$%^&*()_+{}\[\]:;<>,.?~\-]/.test(inputValue);
  const hasUppercase = /[A-Z]/.test(inputValue);
  const hasNumber = /\d/.test(inputValue);

  if (hasSpecialChar && hasUppercase && hasNumber) {
    passwordError.style.display = "none";
    if (!emailError.style.display || emailError.style.display === "none") {
      entrarButton.removeAttribute("disabled");
    }
  } else {
    passwordError.style.display = "block";
    entrarButton.setAttribute("disabled", true);
  }
});
