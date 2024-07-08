<div class="modal fade" id="notifModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 800px;" role="document">
        <div class="modal-content rounded-5 shadow" style="background-color: #ffffff">
            <div class="modal-body p-5 text-center">
                @if(session('status.type') == 'success')
                    <svg class="bi bi-check-circle text-success" width="48" height="48" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8a8 8 0 1 1-16 0 8 8 0 0 1 16 0zM7.97 11.03a.75.75 0 0 0 1.07-1.05l-3.992-4.99a.75.75 0 1 0-1.144.99l3.516 4.396zm3.745-3.772a.75.75 0 0 0-1.072-1.048L7.97 9.784l-1.8-1.798a.75.75 0 0 0-1.075 1.048l2.5 2.498a.75.75 0 0 0 1.07 0l4.5-4.498z"/>
                    </svg>
                @elseif(session('status.type') == 'error')
                    <svg class="bi bi-x-circle text-danger" width="48" height="48" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M16 8a8 8 0 1 1-16 0 8 8 0 0 1 16 0zM4.646 4.646a.75.75 0 0 0-1.072 1.048l1.8 1.798-1.8 1.798a.75.75 0 0 0 1.072 1.048l1.8-1.798 1.8 1.798a.75.75 0 0 0 1.072-1.048L7.854 7.492l1.8-1.798a.75.75 0 0 0-1.072-1.048l-1.8 1.798-1.8-1.798z"/>
                    </svg>
                @else
                    <svg class="bi bi-info-circle text-info" width="48" height="48" fill="currentColor" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 1 8 0a8 8 0 0 1 0 16zm0-14.5a6.5 6.5 0 1 0 0 13 6.5 6.5 0 0 0 0-13zm0 2.9a.6.6 0 1 1 0 1.2.6.6 0 0 1 0-1.2zm.93 2.76a.75.75 0 1 1-1.36 0l-.5-1A.75.75 0 0 1 8.75 7h.5a.75.75 0 0 1 .66 1.14l-.08.12-.93 1.5z"/>
                    </svg>
                @endif

                <h2 class="fw-bold mb-0">{{ session('status.title') }}</h2>
                <div class="my-5">
                    <h5 class="mb-0">{{ session('status.message') }}</h5>
                    <h6>{{ session('status.details') }}</h6>
                </div>
                <button type="button" class="btn btn-lg btn-info mt-5 w-100 text-light"
                        style="background-color: #15779b; border-radius:25px;" data-bs-dismiss="modal">
                    Ya, Terimakasih
                </button>
            </div>
        </div>
    </div>
</div>

@if(session('status'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var myModal = new bootstrap.Modal(document.getElementById('notifModal'));
            myModal.show();

            setTimeout(function () {
                myModal.hide();
            }, 2000); // 2000 ms = 2 detik
        });
    </script>
@endif
