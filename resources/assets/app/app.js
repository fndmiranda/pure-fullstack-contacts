import Controller from './controller';
import View from './view';
import '../css/normalize.css';
import '../styles.scss';

const view = new View();
const controller = new Controller(view);