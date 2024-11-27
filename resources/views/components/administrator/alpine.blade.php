@script
    <script>
        Alpine.data('deleteItems', () => {
            return {
                deleteItems(id = null) {
                    let text = "آیا از حذف این رکورد اطمینان دارید؟";
                    if(this.$wire.ids.length > 1 || ! id){
                        text = "آیا از حذف این رکوردها اطمینان دارید؟";
                    }
                    Swal.fire({
                        title: "هشدار",
                        text: text,
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#d33",
                        cancelButtonColor: "#3085d6",
                        confirmButtonText: "بله",
                        cancelButtonText: "خیر",
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            // experimental
                            // this.optimisticUiDelete()
                            //
                            if(typeof id === 'object'){
                                this.$wire.delete()
                            }else{
                                this.$wire.$parent.delete(id)
                            }
                        }
                    })
                    .catch(error => console.log(error));
                },
                optimisticUiDelete(){
                    // #### for optimistic Ui Delete:

                    // this.$wire.ids.forEach(id => {
                        // let element = document.getElementById(id);
                        // if (element) {
                            // element.classList.add('d-none');
                        // }
                    // });
                }
            }
        });

        Alpine.data('selectAll', () => {
            return {
                init() {
                    this.$wire.$watch('ids', () => {
                        this.updateSelectAllCheckbox()
                        
                    })
                    this.$wire.$watch('currentPageIds', () => {
                        this.updateSelectAllCheckbox()
                    })
                },

                isAllCurrentPageCheckboxesSelected() {
                    return this.$wire.currentPageIds.every(id => this.$wire.ids.includes(id))
                },

                isAllCheckboxesEmpty() {
                    return this.$wire.ids.length === 0
                },

                updateSelectAllCheckbox() {
                    if (this.isAllCurrentPageCheckboxesSelected()) {
                        this.$refs.selectAllCheckbox.checked = true;
                        this.$refs.selectAllCheckbox.indeterminate = false;
                    } else if (this.isAllCheckboxesEmpty()) {
                        this.$refs.selectAllCheckbox.checked = false;
                        this.$refs.selectAllCheckbox.indeterminate = false;
                    } else {
                        this.$refs.selectAllCheckbox.checked = false;
                        this.$refs.selectAllCheckbox.indeterminate = true;
                    }
                },


                handle(e) {
                    if (e.target.checked) {
                        this.selectThemAll()
                    } else {
                        this.deSelectThemAll()
                    }
                },

                selectThemAll() {
                    this.$wire.currentPageIds.forEach(id => {
                        if (this.$wire.ids.includes(id)) return
                        
                        this.$wire.ids.push(id)
                    })
                },

                deSelectThemAll() {
                    this.$wire.ids = []
                },
            }
        })

    </script>
@endscript


