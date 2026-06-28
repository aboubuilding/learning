/**
 * login.js — MERF Togo
 * Gestion du formulaire d’authentification
 */

$(document).ready(function () {
    // Éléments DOM
    const $form = $('#form-login');
    const $email = $('#email');
    const $password = $('#password');
    const $btnSubmit = $('#btn-login');
    const $spinner = $btnSubmit.find('.spinner');
    const $btnText = $btnSubmit.find('.btn-text');
    const $btnArrow = $btnSubmit.find('.btn-arrow');
    const $togglePw = $('#toggle-pw');
    const $eyeIcon = $('#eye-icon');
    const $forgotLink = $('#forgotLink');
    const $forgotModal = $('#forgotModal');
    const $modalClose = $('#modalClose, #modalCancel');
    const $modalOverlay = $('.modal-overlay');

    // Gestion de l’affichage du mot de passe
    $togglePw.on('click', function () {
        const type = $password.attr('type') === 'password' ? 'text' : 'password';
        $password.attr('type', type);
        $eyeIcon.toggleClass('fa-eye fa-eye-slash');
    });

    // Afficher/Masquer le modal "Mot de passe oublié"
    $forgotLink.on('click', function (e) {
        e.preventDefault();
        $forgotModal.fadeIn(200);
    });
    $modalClose.on('click', function () {
        $forgotModal.fadeOut(200);
    });
    $modalOverlay.on('click', function () {
        $forgotModal.fadeOut(200);
    });
    $('.modal-content').on('click', function (e) {
        e.stopPropagation();
    });

    // Fonction pour afficher un toast
    function showToast(message, type) {
        const $container = $('#toast-container');
        const icons = {
            success: 'fa-check-circle',
            error: 'fa-exclamation-circle',
            info: 'fa-info-circle',
            warning: 'fa-exclamation-triangle'
        };
        const icon = icons[type] || icons.info;
        const $toast = $(`
            <div class="toast toast-${type}" role="alert">
                <i class="fas ${icon}"></i>
                <span>${message}</span>
                <button type="button" class="toast-close" aria-label="Fermer">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `);
        $container.append($toast);
        $toast.find('.toast-close').on('click', function () {
            $toast.fadeOut(300, function () { $(this).remove(); });
        });
        setTimeout(() => {
            $toast.fadeOut(300, function () { $(this).remove(); });
        }, 5000);
    }

    // Réinitialiser les messages d’erreur
    function resetErrors() {
        $('.error-message').hide();
        $('.field-input').removeClass('is-invalid');
        $('.alert-box').remove();
    }

    // Afficher une erreur sous un champ
    function showFieldError(fieldId, message) {
        const $error = $(`#error-${fieldId}`);
        if ($error.length) {
            $error.text(message).show();
            $(`#${fieldId}`).addClass('is-invalid');
        } else {
            // Fallback : alerte générique
            showToast(message, 'error');
        }
    }

    // Validation côté client
    function validateForm() {
        let isValid = true;
        const email = $email.val().trim();
        const password = $password.val();

        resetErrors();

        if (!email) {
            showFieldError('email', 'L’email est obligatoire');
            isValid = false;
        } else if (!/^\S+@\S+\.\S+$/.test(email)) {
            showFieldError('email', 'Veuillez entrer un email valide');
            isValid = false;
        }

        if (!password) {
            showFieldError('password', 'Le mot de passe est obligatoire');
            isValid = false;
        } else if (password.length < 6) {
            showFieldError('password', 'Le mot de passe doit contenir au moins 6 caractères');
            isValid = false;
        }

        return isValid;
    }

    // État de chargement du bouton
    function setLoading(loading) {
        if (loading) {
            $btnSubmit.prop('disabled', true);
            $spinner.removeClass('d-none');
            $btnText.addClass('d-none');
            $btnArrow.addClass('d-none');
        } else {
            $btnSubmit.prop('disabled', false);
            $spinner.addClass('d-none');
            $btnText.removeClass('d-none');
            $btnArrow.removeClass('d-none');
        }
    }

    // Soumission AJAX
    $form.on('submit', function (e) {
        e.preventDefault();
        if (!validateForm()) return;

        setLoading(true);
        const formData = $(this).serialize();

        $.ajax({
            url: LOGIN_ROUTE,
            type: 'POST',
            data: formData,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function (response) {
                if (response.success) {
                    showToast('Connexion réussie, redirection...', 'success');
                    setTimeout(() => {
                        window.location.href = TABLEAU_ROUTE;
                    }, 800);
                } else {
                    setLoading(false);
                    showToast(response.message || 'Identifiants incorrects', 'error');
                }
            },
            error: function (xhr) {
                setLoading(false);
                let msg = 'Erreur serveur. Veuillez réessayer.';
                if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                    const errors = xhr.responseJSON.errors;
                    if (errors.email) msg = errors.email[0];
                    else if (errors.password) msg = errors.password[0];
                } else if (xhr.status === 401) {
                    msg = xhr.responseJSON?.message || 'Authentification échouée';
                } else if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                }
                showToast(msg, 'error');
            }
        });
    });

    // Initialisation : cacher les messages d’erreur au chargement
    resetErrors();
});
