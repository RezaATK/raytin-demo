<!-- Footer -->
<footer class="content-footer footer bg-footer-theme">
    <div class="container-fluid d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
        <div class="mb-2 mb-md-0">
            ©company
        </div>
        <div>
            <a
                    href="https://site.com/"
                    target="_blank"
                    class="footer-link me-4"
            >Documentation</a
            >
        </div>
    </div>
</footer>
<!-- / Footer -->

<div class="content-backdrop fade"></div>
</div>
<!-- Content wrapper -->
</div>
<!-- / Layout page -->
</div>

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>

<!-- Drag Target Area To SlideIn Menu On Small Screens -->
<div class="drag-target"></div>
</div>



<script>

    document.addEventListener('DOMContentLoaded', function(){
        let success = "{{ session()->has('success') }}";

        let failed = "{{ session()->has('failed') }}";
        if (success) {
            let message = "{{ session('success') }}";
            if(message === "success"){
                document.dispatchEvent(new Event("success"));
            }else{
                const customEvent = new CustomEvent("success", {detail: { message: message }})
                document.dispatchEvent(customEvent);
            }
        }

        if (failed) {
            let message = "{{ session('failed') }}";
            if(message === "failed"){
                document.dispatchEvent(new Event("failed"));
            }else{
                const customEvent = new CustomEvent("failed", {detail: { message: message }})
                document.dispatchEvent(customEvent);
            }
        }
    });

    document.addEventListener('livewire:init', () => {
        Livewire.hook('request', ({ fail }) => {
            fail(({ status, preventDefault }) => {
                if (status === 419) {
                    let timerInterval;
                    Swal.fire({
                        title: "مدت زمان نشست جاری شما تمام شد",
                        html: " تا <b></b> ثانیه دیگر به صفحه ورود منتقل می شوید",
                        timer: 5000,
                        timerProgressBar: true,
                        didOpen: () => {
                            Swal.showLoading();
                            const timerEl = Swal.getPopup().querySelector("b");
                            timerInterval = setInterval(() => {
                                timerEl.textContent = (Swal.getTimerLeft() / 1000).toFixed();
                            }, 100);
                        },
                        willClose: () => {
                            clearInterval(timerInterval);
                        }
                    }).then((result) => {
                        if (result.dismiss === Swal.DismissReason.timer) {
                            window.location.href="{{ route('login') }}"
                        }
                    });
                    preventDefault()
                }
            })
        })
    })


</script>

<script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>


<script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>

<!-- endbuild -->

<!-- select2 - fa -->

<!-- Vendors JS -->



<!-- Main JS -->


<!-- Page JS -->


