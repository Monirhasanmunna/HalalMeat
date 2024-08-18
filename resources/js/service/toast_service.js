import iziToast from 'izitoast';
import 'izitoast/dist/css/iziToast.min.css';

export function useToast() {

    function showToast(message, type, title = "", options = {}) {
        const defaultOptions = {
            title: title ? title : type.toUpperCase(),
            message,
            timeout: 3000,
            position: 'topRight',
            titleSize: '12px',
        };

        const toastOptions = { ...defaultOptions, ...options };

        iziToast[type](defaultOptions);
    }

    return {
        showToast,
    };
}
