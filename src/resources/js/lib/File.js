export default class {
    constructor(el) {
        this.$ = $(el);
        this.selected = false;
        this.file = this.$.data('file');
        this.url = this.$.attr('href');
        this.$.on('click', event => {
             this.onClick();
        });
    }
    onClick() {
        if (window.opener && typeof window.opener.selectItems === "function") {
            event.preventDefault();
            window.opener.selectItems({
                filename: this.file.name,
                source: this.file.source,
                size: this.file.size,
                type: this.file.type,
                url: this.url,
            });
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