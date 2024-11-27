<tr>
    <td>
        <x-administrator.checkbox :id="$store->storeID"/>
    </td>
    <td x-show="storeID" x-transition x-cloak>{{ $store->storeID }}</td>
    <td x-show="storeName" x-transition x-cloak>{{ $store->storeName }}</td>
    <td x-show="categoryName" x-transition>{{ $store->categoryName }}</td>
    <td x-show="storeNeighborhood" x-transition x-cloak>{{ $store->storeNeighborhood ?? 'بدون داده' }}</td>
    <td x-show="status" x-transition x-cloak>
        <x-administrator.checkbox-table method="status" :field="$store->isActive"
                                        :id="$store->storeID"/>
    </td>
    <td x-show="actions">
        <div class="d-flex px-3 gap-3">
            <div class="dropdown">
                <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                        data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bx bx-dots-horizontal-rounded"></i>
                </button>
                <div class="dropdown-menu animate slideIn" style="">
                    <x-administrator.edit-button
                            :href="route('store.edit', ['store' => $store->storeID])"/>
                    <x-administrator.delete-button :id="$store->storeID"/>
                </div>
            </div>
            <a href="{{ route('store.edit', ['store' => $store->storeID]) }}"
               target="_blank">
                <i class="bx bxs-edit me-1"></i>
            </a>
        </div>
    </td>
</tr>