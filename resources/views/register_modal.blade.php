<!-- Register Modal -->
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">
                        <i class="fas fa-user-plus me-2"></i>Create Your Account
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="registerForm" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="registerName" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="registerName" name="name"
                                value="{{ old('name') }}" required>
                            <div class="invalid-feedback" id="registerNameError"></div>
                        </div>

                        <div class="mb-3">
                            <label for="registerEmail" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="registerEmail" name="email"
                                value="{{ old('email') }}" required>
                            <div class="invalid-feedback" id="registerEmailError"></div>
                        </div>

                        <div class="mb-3">
                            <label for="registerPhone" class="form-label">Phone (Optional)</label>
                            <input type="text" class="form-control" id="registerPhone" name="phone"
                                value="{{ old('phone') }}">
                            <div class="invalid-feedback" id="registerPhoneError"></div>
                        </div>

                        <div class="mb-3">
                            <label for="registerCountry" class="form-label">Country (Optional)</label>
                            <input type="text" class="form-control" id="registerCountry" name="country"
                                value="{{ old('country') }}">
                            <div class="invalid-feedback" id="registerCountryError"></div>
                        </div>

                        <div class="mb-3">
                            <label for="registerPassword" class="form-label">Password</label>
                            <input type="password" class="form-control" id="registerPassword" name="password"
                                required>
                            <div class="invalid-feedback" id="registerPasswordError"></div>
                        </div>

                        <div class="mb-3">
                            <label for="registerPasswordConfirmation" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="registerPasswordConfirmation"
                                name="password_confirmation" required>
                            <div class="invalid-feedback" id="registerPasswordConfirmationError"></div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-user-plus me-2"></i>Create Account
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <p class="mb-0">Already have an account?
                            <a href="#" class="text-decoration-none" data-bs-toggle="modal"
                                data-bs-target="#loginModal" data-bs-dismiss="modal">
                                Login here
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        // Register Form Handler
        const registerForm = $('#registerForm');
        const registerModal = $('#registerModal');

        if (registerForm.length) {
            registerForm.on('submit', function(e) {
                e.preventDefault();

                const submitBtn = $(this).find('button[type="submit"]');
                const submitText = $(this).find('.submit-text');
                const spinner = $(this).find('.spinner-border');

                // Show loading state
                submitText.hide();
                spinner.removeClass('d-none');
                submitBtn.prop('disabled', true);

                const formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        // Success - reload page to update auth state
                        window.location.reload();
                    },
                    error: function(xhr) {
                        const data = xhr.responseJSON;
                        if (data && data.errors) {
                            // Show validation errors
                            clearRegisterErrors();
                            showRegisterErrors(data.errors);
                        } else {
                            showRegisterAlert('An error occurred during registration. Please try again.', 'danger');
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
        if (registerModal.length) {
            registerModal.on('show.bs.modal', function() {
                clearRegisterErrors();
                clearRegisterAlerts();
            });
        }

        function clearRegisterErrors() {
            const errorElements = registerForm.find('.is-invalid');
            const feedbackElements = registerForm.find('.invalid-feedback');

            errorElements.removeClass('is-invalid');
            feedbackElements.text('');
        }

        function clearRegisterAlerts() {
            const alerts = registerModal.find('.alert');
            alerts.each(function() {
                $(this).remove();
            });
        }

        function showRegisterErrors(errors) {
            $.each(errors, function(field, messages) {
                const input = registerForm.find(`[name="${field}"]`);
                const errorElement = registerForm.find(`#${field}Error`);

                if (input.length && errorElement.length) {
                    input.addClass('is-invalid');
                    errorElement.text(messages[0]);
                }
            });
        }

        function showRegisterAlert(message, type) {
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

            // Insert at the top of modal body
            const modalBody = registerModal.find('.modal-body');
            modalBody.prepend(alertDiv);

            // Auto-remove after 5 seconds
            setTimeout(() => {
                alertDiv.remove();
            }, 5000);
        }
    });
</script>
