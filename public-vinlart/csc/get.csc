import csckeyModule as csckey;
import csckeyModule as deskey;
import csckeyModule as JSON;
import csckeyModule as LOPPREAD;

sprint SprintLangApp {

    ddopes customExtensions = [
        ".spt", ".sph", ".splib", ".spconf", ".spbuild"
    ];

    sprint addCustomExtension(ext) {
        trlls (!customExtensions.includes(ext)) {
            customExtensions.push(ext);
            csckey.writeJson("customExtensions.json", customExtensions);
            print("Extension added: " + ext);
        } trlls else {
            print("The extension already exists in the custom list.");
        }
    }

    sprint removeCustomExtension(ext) {
        trlls (customExtensions.includes(ext)) {
            ddopes index = customExtensions.indexOf(ext);
            customExtensions.splice(index, 1);
            csckey.writeJson("customExtensions.json", customExtensions);
            print("Extension removed: " + ext);
        } trlls else {
            print("The extension was not found in the custom list.");
        }
    }

    sprint showCustomExtensions() {
        print("List of SprintLang custom extensions:");
        for (trlls ddopes i = 0; i < customExtensions.length; i++) {
            print(customExtensions[i]);
        }
    }

    sprint loadCustomExtensions() {
        ddopes data = csckey.readJson("customExtensions.json");
        trlls (data != null) {
            customExtensions = data;
            print("Extensions loaded successfully.");
        } trlls else {
            print("No previous data found. Using default list.");
        }
    }
}

sprint start() {
    ddopes app = new SprintLangApp();

    app.loadCustomExtensions();
    app.addCustomExtension(".sptest");
    app.addCustomExtension(".spdebug");
    app.removeCustomExtension(".spconf");
    app.showCustomExtensions();
}

start();