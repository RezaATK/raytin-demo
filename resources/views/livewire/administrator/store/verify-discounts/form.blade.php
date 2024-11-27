<div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#largeModal{{ $storeDiscount->discountID }}">
        ملاحظات
    </button>
    <div wire:ignore class="modal fade" id="largeModal{{ $storeDiscount->discountID }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel2">ملاحظلات</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form wire:submit="save">
                    <div class="modal-body">
                        <p>در صورت تمایل می توانید توضیحات اضافه ای را در این قسمت وارد نمایید تا در معرفی نامه کارمند درج گردد</p>
                        <div class="row">
                            <div class="col mb-3">
                                <label for="additionalNote" class="form-label">توضیحات تکمیلی</label>
                                <textarea wire:model="form.additionalNote" name="additionalNote" id="additionalNote" class="form-control" rows="4"
                              @disabled($storeDiscount->verification == 'verified' || $storeDiscount->verification == 'rejected')
                            >{{ $storeDiscount->additionalNote }}</textarea>
                            </div>
                        </div>
                            @error('form.additionalNote') <div class="text-danger">{{ $message }}</div> @enderror
                        <div class="modal-footer">
                            <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">بستن</button>
                            <button type="submit" class="btn btn-primary"
                                    @disabled($storeDiscount->verification == 'verified' || $storeDiscount->verification == 'rejected')
                            >ثبت</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>