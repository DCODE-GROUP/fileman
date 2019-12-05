require('./fontawesome');

import File from "./lib/File";


$(() => {
    $('.file').each((i, el) => {
        new File($(el));
    });
});