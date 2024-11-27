<div x-show="$wire.ids.length > 0" x-cloak x-data="deleteItems">
    <button @click="deleteItems" type="button" id="deleteButton" class="btn btn-danger">
        <span class="d-none d-sm-inline-block">حذف</span>
        <i class="bx bx-x d-sm-none d-inline-block"></i>
        <span class="badge bg-light text-danger ms-2" x-text="$wire.ids.length"></span>
    </button>
</div>