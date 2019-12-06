import { dom, library } from '@fortawesome/fontawesome-svg-core';

import {
    faFile,
    faFolder,
    faTrashAlt,
} from '@fortawesome/free-regular-svg-icons';

import {
    faFileImport,
    faFolderPlus,
} from '@fortawesome/free-solid-svg-icons';

library.add(
    faFile,
    faFolder,
    faFileImport,
    faFolderPlus,
    faTrashAlt,
);

dom.watch();