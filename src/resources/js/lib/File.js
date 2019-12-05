export default class {
    constructor($el) {
        this.$ = $el;
        this.$.on('click', event => {
             event.preventDefault();
             console.log('click');
        });
    }
}