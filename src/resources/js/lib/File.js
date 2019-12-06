export default class {
    constructor(el) {
        this.$ = $(el);
        this.selected = false;
        this.url = this.$.attr('href');
        this.filename = this.$.find('.filename').text();
        this.$.on('click', event => {
             this.onClick();
        });
    }
    onClick() {
        if (window.opener && typeof window.opener.selectItems === "function") {
            event.preventDefault();
            window.opener.selectItems({
                url: this.url,
                filename: this.filename,
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