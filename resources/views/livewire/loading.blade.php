<div class="container">
    <div class="card pt-4">
        <div class="card-header heading-color">
            <div class="d-flex align-items-center">
                <a href="#" tabindex="-1" class="btn btn-success disabled mx-2 placeholder" @disabled(true)>
                    ایجاد
                </a>
            </div>
            <div class="row d-flex align-items-center mt-4">
                <div class="col-auto">
                    <form class="d-flex align-items-center">
                        <div class="me-2">
                            <input type ="text" wire:model="search" class="form-control" placeholder="جستجو"
                                   id="search">
                        </div>
                        <div class="me-2">
                            <select class="form-select col-auto placeholder-glow" id="category_id">
                                <option value="">همه سرویس ها</option>
                            </select>
                        </div>
                        <button type="submit"
                                class="btn btn-primary me-2 placeholder-glow disabled"
                        >جستجو
                        </button>
                    </form>
                </div>
                <div class="col-auto mb-2">
                    <select class="form-select placeholder-glow">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                </div>
                <div class="col-auto mb-2">
                    {{-- <button type="button" id="deleteButton"
                            class="btn btn-danger" disabled>
                        حذف
                        <span class="badge bg-light text-danger ms-2"></span>
                    </button> --}}
                </div>
            </div>
            <div class="">
                <div class="table-responsive text-nowrap">
                    <table class="table table-responsive-sm table-hover">
                        <thead>
                        <tr>
                            <th class="placeholder-glow">
                                        <span class="hover-overlay shadow-4-strong rounded placeholder col-2">
                                        </span>
                            </th>
                            <th class="placeholder-glow">
                                        <span class="hover-overlay shadow-4-strong rounded placeholder col-4">
                                        </span>
                            </th>
                            <th class="placeholder-glow">
                                        <span class="hover-overlay shadow-4-strong rounded placeholder col-6">
                                        </span>
                            </th>
                            <th class="placeholder-glow">
                                        <span class="hover-overlay shadow-4-strong rounded placeholder col-6">
                                        </span>
                            </th>
                            <th class="placeholder-glow">
                                        <span class="hover-overlay shadow-4-strong rounded placeholder col-6">
                                        </span>
                            </th>
                            <th class="placeholder-glow">
                                        <span class="hover-overlay shadow-4-strong rounded placeholder col-6">
                                        </span>
                            </th>
                            <th class="placeholder-glow">
                                        <span class="hover-overlay shadow-4-strong rounded placeholder col-6">
                                        </span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="mb-5">
                        <tr class="">
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-10"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-4"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                        </tr>
                        <tr class="">
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-10"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-4"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                        </tr>
                        <tr class="">
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-10"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-4"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                        </tr>
                        <tr class="">
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-10"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-4"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                        </tr>
                        <tr class="">
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-10"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-4"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                        </tr>
                        <tr class="">
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-10"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-4"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                        </tr>
                        <tr class="">
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-10"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-4"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                        </tr>
                        <tr class="">
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-10"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-4"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                        </tr>
                        <tr class="">
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-10"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-4"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                        </tr>
                        <tr class="">
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-10"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-4"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                            <td class="placeholder-glow"><span class="rounded-2 placeholder col-2"></span></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>