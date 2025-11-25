document.addEventListener("DOMContentLoaded", () => {
  const form = document.querySelector("form");
  const submitBtn = form.querySelector("input[type='submit']");

  function validarDNI(input) {
    fetch("../php/validar_dni.php", {
      method: "POST",
      headers: { "Content-Type": "application/x-www-form-urlencoded" },
      body: "dni=" + encodeURIComponent(input.value)
    })
    .then(res => res.json())
    .then(data => {
      let errorMsg = input.nextElementSibling;
      if (!errorMsg || !errorMsg.classList.contains("error-msg")) {
        errorMsg = document.createElement("span");
        errorMsg.classList.add("error-msg");
        errorMsg.style.color = "red";
        errorMsg.style.marginLeft = "8px";
        input.insertAdjacentElement("afterend", errorMsg);
      }

      if (data.existe) {
        errorMsg.textContent = "";
        input.dataset.valid = "true";
      } else {
        errorMsg.textContent = "❌ DNI no registrado en la base de datos";
        input.dataset.valid = "false";
      }

      // Bloquear envío si algún invitado no es válido
      const invalid = [...document.querySelectorAll("input[name='dni_invitados[]']")]
        .some(inp => inp.dataset.valid === "false");
      submitBtn.disabled = invalid;
    });
  }

  // Escuchar cambios en todos los campos de invitados
  document.getElementById("invitados").addEventListener("input", e => {
    if (e.target.name === "dni_invitados[]") {
      validarDNI(e.target);
    }
  });
});
