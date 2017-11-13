import {qs, $on} from "./helpers";

export default class Model {

    index() {
        return fetch(`${BASE_API}/person`)
            .then((response) => response.json() || {});
    }

    store(data) {
        const body = new FormData();
        Object.keys(data).map(function(key) {
            body.append(key, data[key]);
        });

        return fetch(`${BASE_API}/person/store`, {method: 'post', body: body})
            .then(response => response.json());
    }

    update(id, data) {
        const body = new FormData();
        Object.keys(data).map(function(key) {
            body.append(key, data[key]);
        });

        return fetch(`${BASE_API}/person/update/${id}`, {method: 'post', body: body})
            .then(response => response.json());
    }

    destroy(id) {
        return fetch(`${BASE_API}/person/destroy/${id}`, {method: 'delete'})
            .then(response => response.json());
    }

}