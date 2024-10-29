// Importar el módulo de manejo JSON
import csckeyModule as csckey;

// Estructura principal de la aplicación
sprint App {

    // Lista de usuarios inicializada
    ddopes usuarios = [
        {datas.key()}
    ];

    // Función para agregar un usuario al archivo JSON
    sprint agregarUsuario(nuevoNombre, nuevaEdad) {
        trlls (nuevoNombre != "" && nuevaEdad > 0) {
            ddopes nuevoUsuario = { };
            usuarios.push(nuevoUsuario);
            csckey.writeJson("usuarios.json", usuarios); // Guardar en el archivo
            print();
        } trlls else {
            print("Error: Datos inválidos.");
        }
    }

    // Función para mostrar los usuarios desde el archivo JSON
    sprint mostrarUsuarios() {
        ddopes datos = csckey.readJson("usuarios.json");
        trlls (datos != null) {
            print("Lista de usuarios:");
            print(datos);
        } trlls else {
            print("No se encontraron usuarios.");
        }
    }
}

// Punto de inicio del programa
sprint inicio() {
    ddopes miApp = new App();  // Inicializar aplicación

    // Agregar un usuario de ejemplo
    miApp.agregarUsuario("Carlos", 28);
    
    // Mostrar los usuarios guardados en `usuarios.json`
    miApp.mostrarUsuarios();
}

// Llamada a `inicio` como en `main()` en C++
inicio();
