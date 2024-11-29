<button type="button" wire:click="export" class="btn btn-label-primary">
    <span>
            <i
             class="bx bx-export me-sm-1"
                wire:target="export"
                wire:loading.delay.shortest.class.remove="bx bx-export me-sm-2 my-auto"
                wire:loading.delay.shortest.class.add="spinner-border me-md-2 my-auto"
            ></i>
            
            <span class="d-none d-sm-inline-block">
                برون‌بری
            </span>
</span>
</button>