// Real-time notifications
class Notification {
    static show(message, type = 'success', duration = 3000) {
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 p-4 rounded-lg shadow-lg z-50 animate-slide-in-right
            ${type === 'success' ? 'bg-green-50 text-green-800 border border-green-200' :
              type === 'error' ? 'bg-red-50 text-red-800 border border-red-200' :
              'bg-blue-50 text-blue-800 border border-blue-200'}`;

        notification.innerHTML = message;
        document.body.appendChild(notification);

        setTimeout(() => {
            notification.style.animation = 'slide-out-right 0.3s ease-in forwards';
            setTimeout(() => notification.remove(), 300);
        }, duration);
    }
}

// Form validation
class FormValidator {
    static validate(form) {
        const inputs = form.querySelectorAll('[required]');
        let isValid = true;

        inputs.forEach(input => {
            if (!input.value.trim()) {
                input.classList.add('border-red-500');
                isValid = false;
            } else {
                input.classList.remove('border-red-500');
            }
        });

        return isValid;
    }
}

// Export functions
window.Notification = Notification;
window.FormValidator = FormValidator;
