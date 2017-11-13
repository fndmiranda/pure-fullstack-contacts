import Model from './model';
import {qs, $on, serialize} from './helpers';

export default class Controller {
    constructor(view) {
        this.$view = view;
        this.$model = new Model();
        this.$cancel = qs('form #cancel');

        view.edit(this.edit.bind(this));
        view.destroy(this.destroy.bind(this));

        this.index();

        $on(this.$view.$form, 'submit', (e) => {
            e.preventDefault();

            const data = serialize(e.target);

            if (e.target.dataset.action === 'add') {
                this.store(data);
            } else if (e.target.dataset.action === 'edit') {
                this.update(data.id, data);
            }
        });

        $on(this.$cancel, 'click', (e) => {
            this.$view.reset();
        });
    }

    index() {
        this.$model.index().then((response) => {
            this.$view.$items = response.data;
            this.$view.list();
        });
    }

    store(data) {
        return this.$model.store(data).then((response) => {
            this.$view.$items.unshift(response.data);
            this.$view.create(response.data);
            this.$view.reset();
        });
    }

    edit(id, form) {
        form.setAttribute('data-action', 'edit');

        const item = this.$view.$items.find(item => parseInt(item.id, 10) === id);

        Object.keys(item).map(function(key) {
            form.querySelector('#'+key).value = item[key];
        });

        qs('form #send').innerHTML = 'Edit';
    }

    update(id, data) {
        return this.$model.update(id, data).then((response) => {
            const item = this.$view.$items.find(item => parseInt(item.id, 10) === parseInt(id, 10));

            Object.keys(item).map(function(key) {
                item[key] = data[key];
            }, this);

            this.$view.update(id, data);
        });
    }

    destroy(id) {
        return this.$model.destroy(id);
    }
}