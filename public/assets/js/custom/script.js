const select = (cName) => {
    let checkboxes = document.querySelectorAll('.my-checkbox');
    checkboxes.forEach((checkbox) => {
        Livewire.dispatchTo(cName, 'select', {id: parseInt(checkbox.value)});
        checkbox.checked = !checkbox.checked;
    });
}

const toast = (title = null, icon = null, timer = null) => {
    if (!title || !icon) {
        return;
    }
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-start',
        showConfirmButton: false,
        timer: timer === null ? 1500 : timer,
        timerProgressBar: true,
        didOpen: (toast) => {
            if (icon !== 'success') {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        },
    });
    Toast.fire({
        icon: icon,
        title: title,
    });
};

document.addEventListener('toastMessage', (e) => {
    let title, icon, timer = null;
    let position;
    if (e.detail && e.detail.length) {
        title = e.detail[0].title;
        icon = e.detail[0].icon;
        timer = e.detail[0].timer;
        position = e.detail[0].position;
    }
    toast(title, icon, timer);
});
document.addEventListener('success', (e) => {
    let successOp = 'عملیات با موفقیت انجام شد.';
    if(e.detail && e.detail.message ){
        successOp = e.detail.message;
    }
    let icon = 'success';
    toast(successOp, icon, 1500);
});
document.addEventListener('failed', (e) => {
    let failedOp = 'عملیات با موفقیت انجام نشد';
    if(e.detail && e.detail.message ){
        failedOp = e.detail.message;
    }
    let icon = 'error';
    toast(failedOp, icon, 8000);
});

