<div>
    {{-- Care about people's approval and you will be their prisoner. --}}
    @if (session()->has('message'))
        <h5 class="alert alert-success">{{ session('message') }}</h5>
    @endif

    <div class="text-center">
        <button type="button" class="btn btn-outline-primary float-end" data-bs-toggle="modal"
            data-bs-target="#catModal"><i class="fas fa-plus "></i>
            Add Category
        </button>

    </div>


    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped mg-b-0 text-md-nowrap">
                <thead style="background-color:rgb(210, 228, 228)">
                    @if (isset($categories) && count($categories) > 0)
                        <tr>
                            <th class="tx-20 " style="color:rgb(104, 76, 233)">Id</th>
                            <th class="tx-20 " style="color:rgb(104, 76, 233)"> Name</th>
                            <th class="tx-20 " style="color:rgb(104, 76, 233)"> Unit Price </th>
                            <th class="tx-20 " style="color:rgb(104, 76, 233)"> Actions</th>
                        @else
                            <div class="tx-center">
                                <h1 class="text-muted">There are no categories,,, add a category</h1>
                            </div>
                    @endif
                </thead>
                <tbody>
                    @if (isset($categories) && count($categories) > 0)
                        @foreach ($categories as $category)
                            <tr>
                                <th scope="row">{{ $category->id }}</th>
                                <td>{{ $category->name }}</td>
                                <td> {{ $category->unit_price }}</td>
                                <td class="pt-2 ">
                                    <a href="#" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                        data-bs-target="#updateCatModal" wire:click="editCat({{ $category->id }})">
                                        <i class="las la-pen"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteCatModal" wire:click="deleteCat({{ $category->id }})">
                                        <i class="las la-trash"></i>
                                    </a>

                                </td>
                            </tr>
                        @endforeach

                    @endif
                </tbody>
            </table>
        </div><!-- bd -->
    </div><!-- bd -->
    <!-- Add more rows here as needed -->
    </tbody>
    </table>
    {{-- ///////////////////////////////////////////// modal ///////////////////////////////////////// --}}
    <!-- Insert Modal -->
    <div wire:ignore.self class="modal fade" id="catModal" tabindex="-1" aria-labelledby="catModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title "> <span class="">  Add Category</span> </h6><button
                        wire:click="closeModal" aria-label="Close" class="close" data-bs-dismiss="modal"
                        type="button"><span aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="saveCat">
                    <div class="modal-body">
                        {{-- الاسم --}}
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" wire:model="name" class="form-control">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            {{-- السعر --}}
                            <label>Price </label>
                            <input type="number" wire:model="unit_price" class="form-control">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-danger" wire:click="closeModal"
                            data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{--  end insert modal --}}

    {{-- update modal --}}
    <div wire:ignore.self class="modal fade" id="updateCatModal" tabindex="-1" aria-labelledby="updateCatModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title"> Edite Category</h6><button wire:click="closeModal" aria-label="Close"
                        class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="updateCat">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label> Name</label>
                            <input type="text" wire:model="name" class="form-control">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label> Price</label>
                            <input type="text" wire:model="unit_price" class="form-control">
                            @error('price')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Edite</button>
                        <button type="button" class="btn btn-danger" wire:click="closeModal"
                            data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
      {{--end update modal --}}
        {{-- delete modal --}}
        <div wire:ignore.self class="modal fade" id="deleteCatModal" tabindex="-1"
        aria-labelledby="deleteMcatModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                   <button wire:click="closeModal" aria-label="Close"
                        class="close" data-bs-dismiss="modal" type="button"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <form wire:submit.prevent="destroyCat">
                    <div class="modal-body">
                        <h4> <span class="text-danger">Are you sure you have completed the process of deleting this item !!</span></h4>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"> yes</button>
                        <button type="button" class="btn btn-secondary" wire:click="closeModal"
                            data-bs-dismiss="modal">Cancel</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- Care about people's approval and you will be their prisoner. --}}
</div>
</div>
</div>
