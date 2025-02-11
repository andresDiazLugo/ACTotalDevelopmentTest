(function() {
    document.addEventListener("DOMContentLoaded", async function() {
        const usersContainer = document.getElementById("usersContainer");
        const loadingMessage = document.createElement("p");
        loadingMessage.textContent = "Cargando...";
        loadingMessage.id = 'loading'
        usersContainer.appendChild(loadingMessage);

        try {
            const response = await fetch("userGetAllApi");
            if (!response.ok) throw new Error("Error al obtener los usuarios");

            const result = await response.json();
            usersContainer.innerHTML = ""; // Elimina el mensaje de carga

            if (result.status === "success" && Array.isArray(result.data)) {
                result.data.forEach(user => {
                    const listItem = document.createElement("li");   
                    listItem.id = "containerInfoUser";                 
                    // Formatear la fecha
                    const formattedDate = new Date(user.createDate).toLocaleString("es-ES", {
                        year: "numeric",
                        month: "long",
                        day: "numeric",
                        hour: "2-digit",
                        minute: "2-digit"
                    });

                    const div1 = document.createElement("div");
                    const div2 = document.createElement("div");
                    
                    div1.innerHTML = `<p> <span>Nombre: </span> ${user.name}</p>
                                      <p> <span>Teléfono: </span> ${user.phone}</p>`;
                    
                    div2.innerHTML = `<p> <span>Email: </span> ${user.email} </p>
                                      <p> <span>Ingresado: </span> ${formattedDate} </p>`;
                    
                    listItem.appendChild(div1);
                    listItem.appendChild(div2);
                    usersContainer.appendChild(listItem);
                });
            } else {
                usersContainer.innerHTML = "<span id='msgInfoUser'>No hay usuarios disponibles</span>";
            }
        } catch (error) {
            usersContainer.innerHTML = "<span id='msgInfoUser'>Error al cargar los datos</span>";
            console.error(error);
        }
    });
})();
