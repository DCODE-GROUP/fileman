export default class {
    constructor(el) {
        this.$ = $(el);
        this.selected = false;
        this.file = this.$.data('file');
        this.url = this.$.data('url');
        this.$.on('click', event => {
             this.onClick();
        });
    }
    onClick() {
        if (window.opener && typeof window.opener.fileman_callback === "function") {
            event.preventDefault();
            window.opener.fileman_callback({
                filename: this.file.name,
                source: this.file.source,
                size: this.file.size,
                type: this.file.type,
                url: this.url,
            });
            window.close();
        }
    }
    select() {
        this.selected = !this.selected;
        if (this.selected) {
            this.$.addClass('selected');
        } else {
            this.$.removeClass('selected');
        }
    }
}