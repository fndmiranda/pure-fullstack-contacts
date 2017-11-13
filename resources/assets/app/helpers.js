export function qs(selector, scope) {
    return (scope || document).querySelector(selector);
}

export function $on(target, type, callback, capture) {
    target.addEventListener(type, callback, !!capture);
}

export function $delegate(target, selector, type, handler, capture) {
    const dispatchEvent = event => {
        const targetElement = event.target;
        const potentialElements = target.querySelectorAll(selector);
        let i = potentialElements.length;

        while (i--) {
            if (potentialElements[i] === targetElement) {
                handler.call(targetElement, event);
                break;
            }
        }
    };

    $on(target, type, dispatchEvent, !!capture);
}

export function serialize(form) {
    const obj = {};
    const elements = form.querySelectorAll('input');
    for (let i = 0; i < elements.length; ++i) {
        let element = elements[i];
        let name = element.name;
        let value = element.value;

        if (name) {
            obj[name] = value;
        }
    }

    return obj;
}

export const escape = s => s.replace(/[&<]/g, c => c === '&' ? '&amp;' : '&lt;');