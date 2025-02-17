import * as _ from "lodash";
import { aliases } from "./aliases";

export const registerFileman = (app) => {
    const files = import.meta.glob("./**/*.vue", { eager: true });
    Object.entries(files).forEach(([path, mod]) => {
        app.component(`Fileman${getComponentName(path)}`, mod.default);
    });
};

function getComponentName(path) {
    const name = _.upperFirst(_.camelCase(path.replace(/\.\w+$/, "").split("/")));
    return aliases[name] !== undefined ? aliases[name] : name;
}
