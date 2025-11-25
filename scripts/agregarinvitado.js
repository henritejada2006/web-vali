document.addEventListener("DOMContentLoaded", () => {
  const contenedor = document.getElementById("invitados");
  const boton = document.getElementById("btnAgregarInvitado");

  if (!contenedor || !boton) return;

  boton.addEventListener("click", () => {
    const wrapper = document.createElement("div");
    wrapper.style.display = "inline-flex";
    wrapper.style.alignItems = "center";
    wrapper.style.marginTop = "8px";

    const input = document.createElement("input");
    input.type = "text";
    input.name = "dni_invitados[]";
    input.placeholder = "DNI del invitado";

    const eliminar = document.createElement("button");
    eliminar.type = "button";
    eliminar.textContent = "✖"; // icono pequeño
    eliminar.style.marginLeft = "6px";
    eliminar.style.padding = "2px 6px";
    eliminar.style.fontSize = "0.8em";
    eliminar.style.cursor = "pointer";
    eliminar.addEventListener("click", () => wrapper.remove());

    wrapper.appendChild(input);
    wrapper.appendChild(eliminar);
    contenedor.appendChild(wrapper);
  });
});
