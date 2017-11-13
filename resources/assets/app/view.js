import {qs, escape, $delegate} from './helpers';

const _id = element => parseInt(element.parentNode.parentNode.dataset.id, 10);

export default class View {

    constructor() {
        this.$items = [];
        this.$list = qs('#list');
        this.$form = qs('form');
    }

    list() {
        this.$list.innerHTML = this.$items.reduce((a, item) => a + `
        <tr data-id="${item.id}">
            <td class="first_name">${escape(item.first_name)}</td>
            <td class="last_name">${escape(item.last_name)}</td>
            <td class="address">${escape(item.address)}</td>
            <td class="text-center item-actions">
                <button type="button" class="remove">Delete</button>
                &nbsp;
                <button type="button" class="edit">Edit</button>
            </td>
        </tr>`, '');
    }

    create(data) {
        const element = document.createElement('tr');
        element.setAttribute('data-id', data.id);
        element.innerHTML = `
        <td class="first_name">${escape(data.first_name)}</td>
        <td class="last_name">${escape(data.last_name)}</td>
        <td class="address">${escape(data.address)}</td>
        <td class="text-center item-actions">
            <button type="button" class="remove">Delete</button>
            &nbsp;
            <button type="button" class="edit">Edit</button>
        </td>`;
        this.$list.insertBefore(element, this.$list.firstChild);
    }

    edit(handler) {
        $delegate(this.$list, '.edit', 'click', ({target}) => {
            handler(_id(target), this.$form)
        });
    }

    update(id, data) {
        const container = qs(`[data-id="${id}"]`);

        Object.keys(data).map(function(key) {
            const element = container.querySelector(`.${key}`);
            if (element) {
                element.innerHTML = escape(data[key]);
            }
        }, this);

        this.reset();
    }

    destroy(handler) {
        $delegate(this.$list, '.remove', 'click', ({target}) => {
            handler(_id(target)).then((response) => {
                if (response.data) {
                    this.$list.removeChild(qs(`[data-id="${_id(target)}"]`));
                } else {
                    alert('Error occurred, please try again later!');
                }
            });
        });
    }

    reset() {
        this.$form.reset();
        this.$form.setAttribute('data-action', 'add');
        qs('form #send').innerHTML = 'Add';
    }

}