<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">
                    <i class="fas fa-sign-in-alt me-2"></i>Login to Your Account
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Error Messages -->
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Login Failed</strong>
                        @foreach ($errors->all() as $error)
                            <div class="mt-1 small">{{ $error }}</div>
                        @endforeach
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif

                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif

                <form id="loginForm" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="loginEmail" class="form-label">Email Address</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            id="loginEmail" name="email" value="{{ old('email') }}" required autofocus>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="loginPassword" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            id="loginPassword" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember"
                            {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">Remember me</label>
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary" id="loginSubmitBtn">
                            <i class="fas fa-sign-in-alt me-2"></i>
                            <span class="submit-text">Sign In</span>
                            <div class="spinner-border spinner-border-sm d-none" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                        </button>
                    </div>
                </form>

                <div class="text-center mt-3">
                    <button type="button" class="btn btn-link" data-bs-toggle="modal"
                        data-bs-target="#forgotPasswordModal">
                        Forgot Password?
                    </button>
                </div>

                <div class="text-center mt-3">
                    <p class="mb-0">Don't have an account?
                        <a href="#" class="text-decoration-none" data-bs-toggle="modal"
                            data-bs-target="#registerModal" data-bs-dismiss="modal">
                            Register here
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/js/jquery.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

<script>
$(document).ready(function() {
    // Login Form Handler
    const loginForm = $('#loginForm');
    const loginModal = $('#loginModal');

    if (loginForm.length) {
        loginForm.on('submit', function(e) {
            e.preventDefault();

            const submitBtn = $(this).find('button[type="submit"]');
            const submitText = $(this).find('.submit-text');
            const spinner = $(this).find('.spinner-border');

            // Show loading state
            submitText.hide();
            spinner.removeClass('d-none');
            submitBtn.prop('disabled', true);

            // Clear previous errors
            clearLoginErrors();
            clearLoginAlerts();

            const formData = $(this).serialize();

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                dataType: 'json',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                success: function(response) {
                    // Success - redirect to intended page or home
                    if (response.redirect) {
                        window.location.href = response.redirect;
                    } else {
                        window.location.href = '/'; // Redirect to home
                    }
                },
                error: function(xhr) {
                    const data = xhr.responseJSON;

                    // Handle validation errors
                    if (data && data.errors) {
                        showLoginErrors(data.errors);
                    }

                    // Show error message for invalid credentials
                    if (xhr.status === 422 && data && data.message) {
                        showLoginAlert(data.message, 'danger');
                    } else if (xhr.status === 401) {
                        showLoginAlert('Invalid email or password. Please try again.', 'danger');
                    } else {
                        showLoginAlert('An error occurred during login. Please try again.', 'danger');
                    }
                },
                complete: function() {
                    // Reset button state
                    submitText.show();
                    spinner.addClass('d-none');
                    submitBtn.prop('disabled', false);
                }
            });
        });
    }

    // Clear errors when modal is opened
    if (loginModal.length) {
        loginModal.on('show.bs.modal', function() {
            clearLoginErrors();
            clearLoginAlerts();
            // Reset form
            loginForm[0].reset();
        });
    }

    function clearLoginErrors() {
        // Remove existing invalid classes and error messages
        loginForm.find('.is-invalid').removeClass('is-invalid');
        loginForm.find('.invalid-feedback').remove();

        // Also clear any dynamically added error elements
        loginForm.find('input').each(function() {
            const errorElement = $(this).next('.invalid-feedback');
            if (errorElement.length) {
                errorElement.remove();
            }
        });
    }

    function clearLoginAlerts() {
        const alerts = loginModal.find('.alert');
        alerts.each(function() {
            // Keep only session alerts, remove dynamic ones
            if (!$(this).hasClass('alert-info') && !$(this).find('.session-alert').length) {
                $(this).remove();
            }
        });
    }

    function showLoginErrors(errors) {
        $.each(errors, function(field, messages) {
            const input = loginForm.find(`[name="${field}"]`);
            if (input.length) {
                input.addClass('is-invalid');

                // Remove existing error message
                let errorElement = input.next('.invalid-feedback');
                if (errorElement.length === 0) {
                    errorElement = $('<div>', {
                        class: 'invalid-feedback'
                    });
                    input.after(errorElement);
                }
                errorElement.text(messages[0]);
            }
        });
    }

    function showLoginAlert(message, type) {
        const alertClass = type === 'danger' ? 'alert-danger' : 'alert-success';
        const iconClass = type === 'danger' ? 'fa-exclamation-triangle' : 'fa-check-circle';

        const alertDiv = $('<div>', {
            class: `alert ${alertClass} alert-dismissible fade show`
        });

        alertDiv.html(`
            <i class="fas ${iconClass} me-2"></i>
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `);

        // Insert at the top of modal body (after existing session alerts if any)
        const modalBody = loginModal.find('.modal-body');
        const existingAlerts = modalBody.find('.alert');

        if (existingAlerts.length) {
            existingAlerts.last().after(alertDiv);
        } else {
            modalBody.prepend(alertDiv);
        }

        // Auto-remove after 5 seconds
        setTimeout(() => {
            if (alertDiv.is(':visible')) {
                alertDiv.remove();
            }
        }, 5000);
    }

    // Prevent modal from closing when clicking outside or pressing escape on errors
    loginModal.on('hide.bs.modal', function(e) {
        // Check if there are any error alerts visible
        const hasErrors = loginModal.find('.alert-danger').length > 0;
        if (hasErrors && !$(e.target).hasClass('btn-close')) {
            e.preventDefault();
            return false;
        }
    });
});
</script>
