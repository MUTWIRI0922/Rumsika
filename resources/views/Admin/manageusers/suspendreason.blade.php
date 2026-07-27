<!-- Suspend reason modal -->
<div class="modal fade" id="suspendModal" tabindex="-1" aria-labelledby="suspendModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="suspendForm" method="POST" action="">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="suspendModalLabel">Suspend User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="suspendModalUser"></p>
                    <div class="mb-3">
                        <label for="suspendReason" class="form-label">Reason for suspension</label>
                        <textarea class="form-control" id="suspendReason" name="reason" rows="4" required></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-warning">Suspend user</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const suspendModal = document.getElementById('suspendModal');
        const suspendModalUser = document.getElementById('suspendModalUser');
        const suspendForm = document.getElementById('suspendForm');
        const suspendReason = document.getElementById('suspendReason');
        const bsModal = new bootstrap.Modal(suspendModal);

        document.querySelectorAll('.suspend-user-btn').forEach(button => {
            button.addEventListener('click', function () {
                const userId = this.getAttribute('data-user-id');
                const userName = this.getAttribute('data-user-name');

                suspendModalUser.textContent = `Entering suspension reason for ${userName}.`;
                suspendForm.action = `{{ url('/admin/users') }}/${userId}/suspend`;
                suspendReason.value = '';
                bsModal.show();
            });
        });
    });
</script>
@endpush