import { dom, library } from '@fortawesome/fontawesome-svg-core';

import {
    faFile,
    faFolder,
    faTrashAlt,
} from '@fortawesome/free-regular-svg-icons';

import {
    faPlus,
} from '@fortawesome/free-solid-svg-icons';

library.add(
    faPlus,
    faFile,
    faFolder,
    faTrashAlt,
);

dom.watch();