<!-- Forgot Password Modal -->
    <div class="modal fade" id="forgotPasswordModal" tabindex="-1" aria-labelledby="forgotPasswordModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="forgotPasswordModalLabel">Reset Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-4 text-sm text-gray-600">
                        Forgot your password? No problem. Just let us know your email address and we will email you a
                        password reset link that will allow you to choose a new one.
                    </div>

                    <!-- Session Status -->
                    <div id="forgotPasswordStatus" class="auth-session-status mb-4" style="display: none;"></div>

                    <form id="forgotPasswordForm" method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label for="forgotPasswordEmail" class="input-label">Email</label>
                            <input id="forgotPasswordEmail" class="form-control" type="email"
                                name="email" value="" required autofocus />
                            <div id="forgotPasswordEmailError" class="input-error mt-2"></div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">
                                <span class="button-text">Email Password</span>
                                <span class="loading-spinner" style="display: none;">
                                    <i class="fas fa-spinner fa-spin me-2"></i>Sending...
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        // Forgot Password Form Handler
        const forgotPasswordForm = $('#forgotPasswordForm');
        const forgotPasswordModal = $('#forgotPasswordModal');

        if (forgotPasswordForm.length) {
            forgotPasswordForm.on('submit', function(e) {
                e.preventDefault();

                const submitBtn = $(this).find('#forgotPasswordSubmitBtn');
                const buttonText = $(this).find('.button-text');
                const loadingSpinner = $(this).find('.loading-spinner');

                // Show loading state
                buttonText.hide();
                loadingSpinner.show();
                submitBtn.prop('disabled', true);

                // Clear previous errors and status
                $('#forgotPasswordEmailError').text('');
                $('#forgotPasswordStatus').hide().removeClass('alert-success alert-danger').text('');

                const formData = $(this).serialize();

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'POST',
                    data: formData,
                    dataType: 'json',
                    success: function(response) {
                        // Show success message
                        $('#forgotPasswordStatus')
                            .text('Password reset link has been sent to your email address!')
                            .addClass('alert alert-success')
                            .show();

                        // Clear the form
                        forgotPasswordForm[0].reset();

                        // Auto-close modal after 3 seconds
                        setTimeout(() => {
                            const modal = bootstrap.Modal.getInstance(forgotPasswordModal[0]);
                            if (modal) {
                                modal.hide();
                            }
                        }, 3000);
                    },
                    error: function(xhr) {
                        const data = xhr.responseJSON;

                        if (data && data.errors) {
                            // Show validation errors
                            if (data.errors.email) {
                                $('#forgotPasswordEmailError').text(data.errors.email[0]);
                            }

                            // Show general error message
                            $('#forgotPasswordStatus')
                                .text('Please check the form for errors.')
                                .addClass('alert alert-danger')
                                .show();
                        } else if (data && data.message) {
                            // Show server error message
                            $('#forgotPasswordStatus')
                                .text(data.message)
                                .addClass('alert alert-danger')
                                .show();
                        } else {
                            $('#forgotPasswordStatus')
                                .text('An error occurred. Please try again.')
                                .addClass('alert alert-danger')
                                .show();
                        }
                    },
                    complete: function() {
                        // Reset button state
                        buttonText.show();
                        loadingSpinner.hide();
                        submitBtn.prop('disabled', false);
                    }
                });
            });
        }

        // Clear form when modal is hidden
        if (forgotPasswordModal.length) {
            forgotPasswordModal.on('hidden.bs.modal', function() {
                forgotPasswordForm[0].reset();
                $('#forgotPasswordEmailError').text('');
                $('#forgotPasswordStatus').hide().removeClass('alert-success alert-danger').text('');
            });
        }
    });
</script>
