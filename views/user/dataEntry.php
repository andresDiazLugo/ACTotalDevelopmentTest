<section id="sectionForm">
    <h2>Ingreso de datos</h2>
    <form id="formData">
        <div id="conatinerElementInput">
            <label for="name">Nombre</label>
            <div id="containerInput">
                <input type="text" id="name" name="name" placeholder="Ingrese su nombre" />
                <div class="error-message" id="name-error"></div>
            </div>
        </div>
        <div id="conatinerElementInput">
            <label for="email">Email</label>
            <div id="containerInput">
                <input type="email" id="email" name="email" placeholder="Ingrese su email" />
                <div class="error-message" id="email-error"></div>
            </div>
        </div>
        <div id="conatinerElementInput">
            <label for="phone">Teléfono</label>
            <div id="containerInput">
                <input type="phone" id="phone" name="phone" placeholder="Ingrese su teléfono" />
                <div class="error-message" id="phone-error"></div>
            </div>
        </div>
        <div class="containerButton">
            <button type="submit">Guardar</button>
        </div>
    </form>
</section>