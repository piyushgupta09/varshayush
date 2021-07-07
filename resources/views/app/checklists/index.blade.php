@extends('layouts.app')

@section('content')

<!-- Page Title -->
<div class="py-5 text-center">
    <p class="display-6 text-secondary text-capitalize">Checklists</p>
    @auth
    <button type="button" class="btn btn-light border-danger py-1 px-4" data-bs-toggle="modal"
        data-bs-target="#addChecklistModal">
        Add Checklist
    </button>
    @endauth
</div>

<div class="row row-cols-1 row-cols-md-2 row-cols-md-3 row-cols-xl-4 g-3">

    <!-- Display checklists with tasks -->
    @foreach($checklists as $checklist)
        <div class="col">
            <div class="card" style="border-color: {{ $checklist->color }}">

                <!-- Checklist Header -->
                <div class="card-header pe-1" style="background-color: {{ $checklist->getHeadBgColor() }}">
                    <div class="d-flex justify-content-between">

                        <div style="color: {{ $checklist->getHeadTextColor() }}">

                            <!-- Urgent Icon -->
                            @if($checklist->urgent)
                                <svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-star-fill me-2" viewBox="0 0 16 16"
                                    style="color: {{ $checklist->getIconColor() }}">
                                    <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
                                </svg>
                            @endif

                            @if($checklist->account)
                                <svg
                                    xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-gift-fill me-2" viewBox="0 0 16 16"
                                    style="color: {{ $checklist->getIconColor() }}">
                                    <path d="M3 2.5a2.5 2.5 0 0 1 5 0 2.5 2.5 0 0 1 5 0v.006c0 .07 0 .27-.038.494H15a1 1 0 0 1 1 1v1a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1h2.038A2.968 2.968 0 0 1 3 2.506V2.5zm1.068.5H7v-.5a1.5 1.5 0 1 0-3 0c0 .085.002.274.045.43a.522.522 0 0 0 .023.07zM9 3h2.932a.56.56 0 0 0 .023-.07c.043-.156.045-.345.045-.43a1.5 1.5 0 0 0-3 0V3zm6 4v7.5a1.5 1.5 0 0 1-1.5 1.5H9V7h6zM2.5 16A1.5 1.5 0 0 1 1 14.5V7h6v9H2.5z"/>
                                </svg>
                            @endif

                            <!-- Checklist Title -->
                            <p class="d-inline fw-bold text-capitalize mb-0 align-middle">{{ $checklist->title }}</p>

                        </div>

                        <!-- Dropdown Options -->
                        <div class="btn-group dropdown">
                            <button type="button" class="btn dropdown-toggle py-0 px-3" data-bs-toggle="dropdown"
                                aria-expanded="false" aria-haspopup="true">
                                <span class="visually-hidden">Options</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="{{ $checklist->getHeadTextColor() }}" class="bi bi-three-dots-vertical"
                                    viewBox="0 0 16 16">
                                    <path
                                        d="M9.5 13a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zm0-5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0z" />
                                </svg>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end py-0 mt-2" style="min-width: 7rem">
                                @if(!$checklist->archived)
                                    @auth
                                        <!-- Edit -->
                                        <li>
                                            <button type="button" class="dropdown-item"
                                                data-bs-checklist="{{ $checklist->id }}"
                                                data-bs-title="{{ $checklist->title }}"
                                                data-bs-color="{{ $checklist->color }}"
                                                data-bs-urgent="{{ $checklist->urgent }}"
                                                data-bs-account="{{ $checklist->account }}"
                                                data-bs-detail="{{ $checklist->detail }}"
                                                data-bs-budget="{{ $checklist->budget }}"
                                                data-bs-tasker="{{ $checklist->tasker()->id }}"
                                                data-bs-toggle="modal" data-bs-target="#editChecklistModal">
                                                Edit
                                            </button>
                                        </li>
                                        <!-- Delete -->
                                        <li>
                                            <form class="form-inline"
                                                action="{{ route('checklists.delete') }}"
                                                method="post">
                                                @csrf
                                                <input type="hidden" name="checklist" value="{{ $checklist->id }}">
                                                <input class="dropdown-item" type="submit" value="Delete">
                                            </form>
                                        </li>
                                        <!-- Archive -->
                                        <li>
                                            <form class="form-inline"
                                                action="{{ route('checklists.archive') }}"
                                                method="post">
                                                @csrf
                                                <input type="hidden" name="checklist" value="{{ $checklist->id }}">
                                                <input class="dropdown-item" type="submit"
                                                    value="{{ ($checklist->archived) ? 'Unarchive' : 'Archive' }}">
                                            </form>
                                        </li>
                                    @endauth
                                    <!-- Share -->
                                    <li>
                                        <button type="button" class="dropdown-item"
                                            data-bs-title="{{ $checklist->title }}"
                                            data-bs-slug="{{ $checklist->id }}" data-bs-toggle="modal"
                                            data-bs-target="#shareListModal">
                                            Share
                                        </button>
                                    </li>
                                @endif
                            </ul>
                        </div>

                    </div>
                </div>

                <!-- List Tasks -->
                @if(!$checklist->archived)
                    <div class="card-body py-2" style="background-color: {{ $checklist->getBodyBgColor() }}">

                        @if ($checklist->hasTasks())
                            @foreach($checklist->getPrioritisedTasks($checklist->tasks) as $task)
                                <form action="{{ route('tasks.persist') }}" method="post">
                                    @csrf
                                    @livewire('task', ['task' => $task])
                                </form>
                            @endforeach
                        @endif

                        <!-- Add new task -->
                        <div class="btn w-100 text-start pt-0 ps-0"
                            style="color: inherit"
                            data-bs-checklist="{{ $checklist->id }}"
                            data-bs-toggle="modal" data-bs-target="#addTaskModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="19" height="19" fill="currentColor" class="bi bi-plus-square" viewBox="0 0 16 16">
                                <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                            </svg>
                            <span class="mb-0 align-middle ps-1">Add task to checklist</span>
                        </div>

                    </div>
                @endif
            </div>
        </div>
    @endforeach

    @auth

        <!-- Add List Modal -->
        <div class="modal fade" id="addChecklistModal" tabindex="-1" aria-labelledby="addChecklistModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addChecklistModalLabel">Add New Checklist</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('checklists.store') }}" method="post">
                        @csrf

                        <div class="modal-body pb-0">

                            <!-- Tasker -->
                            <div class="mb-2">
                                <label for="tasker_input" class="sr-only">Select Tasker</label>
                                <select required class="form-select" name="tasker" id="tasker_input"
                                    aria-label="Select Tasker">
                                    <option selected>Select tasker</option>
                                    @foreach($taskers as $tasker)
                                        <option value="{{ $tasker->id }}">
                                            {{ $tasker->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tasker')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Title Input -->
                            <div class="mb-2">
                                <label for="title_input" class="sr-only">Checklist Title</label>
                                <input type="text" name="title" id="title_input" class="form-control" required
                                    placeholder="Checklist Title">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Detail Input -->
                            <div class="mb-2">
                                <label for="detail_input" class="sr-only">Checklist Detail</label>
                                <input type="text" name="detail" id="detail_input" class="form-control"
                                    placeholder="Detailed (optional)">
                                @error('detail')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Budget Input -->
                            <div class="mb-2">
                                <label for="budget_input" class="sr-only">Budget Amount</label>
                                <input type="integer" name="budget" id="budget_input" class="form-control"
                                    placeholder="Budget Amount">
                                @error('budget')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Urgent Input -->
                            <div class="mb-2 mt-2">
                                <label for="urgent-input" class="sr-only">Is Urgent</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="urgent-input" name="urgent"
                                        style="width: 40px">
                                    <label class="form-check-label ms-2" for="urgent-input">Mark this list as
                                        urgent</label>
                                </div>
                                @error('urgent')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Account Input -->
                            <div class="mb-2 mt-2">
                                <label for="account-input" class="sr-only">Account for</label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="account-input" name="account"
                                        style="width: 40px">
                                    <label class="form-check-label ms-2" for="account-input">Charge on bride's
                                        account</label>
                                </div>
                                @error('account')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Color Input -->
                            <div class="mb-2">
                                <label for="color_input" class="sr-only">Choose Color</label>
                                <div class="d-flex">
                                    <input type="color" name="color" id="color_input" value="#ea5555"
                                        class="form-control mt-1 p-1" title="Choose your color" style="width: 40px">
                                    <label for="color_input" class="form-label ps-2">
                                        Select color to diffrentiate list.
                                    </label>
                                </div>
                                @error('color')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <div class="modal-footer d-flex justify-content-between">
                            <div>
                                <button type="button" class="btn btn-secondary px-4"
                                    data-bs-dismiss="modal">Close</button>
                                <input type="reset" value="Reset" class="btn btn-warning px-4">
                            </div>
                            <button type="submit" class="btn btn-primary px-5">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Edit List Modal -->
        <div class="modal fade" id="editChecklistModal" tabindex="-1" aria-labelledby="editChecklistModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editChecklistModalLabel">Edit Checklist</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('checklists.persist') }}" method="post">
                            @csrf

                            <div class="modal-body pb-0">

                                <!-- Checklist Slug -->
                                <input type="hidden" name="checklist" id="checklist-input">

                                <!-- Tasker -->
                                <div class="mb-3">
                                    <label for="tasker-input" class="mb-2 text-muted">Select Tasker</label>
                                    <select class="form-select" name="tasker" id="tasker-input"
                                        aria-label="Select Tasker">
                                        <option selected>Select tasker</option>
                                        @foreach($taskers as $tasker)
                                            <option value="{{ $tasker->id }}">
                                                {{ $tasker->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('tasker')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Title Input -->
                                <div class="mb-3">
                                    <label for="title-input" class="mb-2 text-muted">List Title</label>
                                    <input type="text" name="title" id="title-input" class="form-control"
                                        placeholder="List Title">
                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Detail Input -->
                                <div class="mb-3">
                                    <label for="detail-input" class="mb-2 text-muted">Checklist Detail
                                        (optional)</label>
                                    <input type="text" name="detail" id="detail-input" class="form-control"
                                        placeholder="Detailed (optional)">
                                    @error('detail')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Budget Input -->
                                <div class="mb-3">
                                    <label for="budget-input" class="mb-2 text-muted">Budget Amount</label>
                                    <input type="integer" name="budget" id="budget-input" class="form-control"
                                        placeholder="Budget Amount">
                                    @error('budget')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Urgent Input -->
                                <div class="mb-2 mt-2">
                                    <label for="urgent-input" class="sr-only">Is Urgent</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="urgent-input" name="urgent"
                                            style="width: 40px">
                                        <label class="form-check-label text-muted ms-2" for="urgent-input">
                                            Mark this list as urgent
                                        </label>
                                    </div>
                                    @error('urgent')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Account Input -->
                                <div class="mb-2 mt-2">
                                    <label for="account-input" class="sr-only">Account for</label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="account-input"
                                            name="account" style="width: 40px">
                                        <label class="form-check-label text-muted ms-2" for="account-input">
                                            Charge on bride's account
                                        </label>
                                    </div>
                                    @error('account')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Color Input -->
                                <div class="mb-2">
                                    <label for="color-input" class="sr-only">Choose Color</label>
                                    <div class="d-flex">
                                        <input type="color" name="color" id="color-input" class="form-control mt-1 p-1"
                                            title="Choose your color" style="width: 40px">
                                        <label for="color_input" class="form-label text-muted ps-2">
                                            Select color to diffrentiate list.
                                        </label>
                                    </div>
                                    @error('color')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>
                            <div class="modal-footer d-flex justify-content-between">
                                <div>
                                    <button type="button" class="btn btn-secondary px-4"
                                        data-bs-dismiss="modal">Close</button>
                                    <input type="reset" value="Reset" class="btn btn-warning px-4">
                                </div>
                                <button type="submit" class="btn btn-primary px-5">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <script>
                var editChecklistModal = document.getElementById('editChecklistModal');
                editChecklistModal.addEventListener('show.bs.modal', function (event) {
                    // Extract data
                    var modalChecklistInput = editChecklistModal.querySelector('#checklist-input');
                    var modalTitleInput = editChecklistModal.querySelector('#title-input');
                    var modalColorInput = editChecklistModal.querySelector('#color-input');
                    var modalUrgentInput = editChecklistModal.querySelector('#urgent-input');
                    var modalTaskerInput = editChecklistModal.querySelector('#tasker-input');
                    var modalDetailInput = editChecklistModal.querySelector('#detail-input');
                    var modalAccountInput = editChecklistModal.querySelector('#account-input');
                    var modalBudgetInput = editChecklistModal.querySelector('#budget-input');
                    // Set data value
                    var button = event.relatedTarget;
                    modalChecklistInput.value = button.getAttribute('data-bs-checklist');
                    modalTitleInput.value = button.getAttribute('data-bs-title');
                    modalColorInput.value = button.getAttribute('data-bs-color');
                    modalTaskerInput.value = button.getAttribute('data-bs-tasker');
                    modalDetailInput.value = button.getAttribute('data-bs-detail');
                    modalBudgetInput.value = button.getAttribute('data-bs-budget');
                    modalUrgentInput.checked = (button.getAttribute('data-bs-urgent') == 1);
                    modalAccountInput.checked = (button.getAttribute('data-bs-account') == 1);
                })

            </script>
        </div>

        <!-- Add Task Modal -->
        <div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addTaskModalLabel">Create New Task</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('tasks.store') }}" method="post">
                        @csrf

                        <div class="modal-body py-0">

                            <div class="row mb-2 py-3 bg-secondary rounded">

                                <!-- Checklist Input -->
                                <div class="col-6">
                                    <label for="checklistInput" class="sr-only">Select parent checklist</label>
                                    <select class="form-select text-capitalize" name="checklist" id="checklistInput"
                                        required aria-label="Select parent list">
                                        <option selected>Select parent list</option>
                                        @foreach($checklists as $checklist)
                                            <option class="text-capitalize" value="{{ $checklist->id }}">
                                                {{ $checklist->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('checklist')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Priority Input -->
                                <div class="col-6">
                                    <label for="priorityInput" class="sr-only">Select Task Priority</label>
                                    <select class="form-select text-capitalize" name="priority" id="priorityInput"
                                        required aria-label="Select Task Priority">
                                        <option value="urgent">Urgent Task ** </option>
                                        <option value="important">Important Task* </option>
                                        <option selected value="regular">Normal Priority</option>
                                    </select>
                                    @error('priority')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                            <!-- Title Input -->
                            <div class="mb-3">
                                <label for="title-input" class="fs-6 lead mb-1">Task Title</label>
                                <input type="text" name="title" id="title-input" class="form-control" required
                                    placeholder="Action to be taken">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Detail Input -->
                            <div class="mb-3">
                                <label for="detailInput" class="fs-6 lead mb-1">Description</label>
                                <input type="text" name="detail" id="detailInput" class="form-control"
                                    placeholder="Things to consider while taking action">
                                @error('detail')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="row mb-2">
                                <!-- Unit Input -->
                                <div class="col-6">
                                    <label for="unitInput" class="fs-6 lead mb-1">Required Quantity</label>
                                    <input type="number" name="unit" id="unitInput" class="form-control"
                                        onchange="calculateTotal()" placeholder="Quantity in units">
                                    @error('unit')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Rate Input -->
                                <div class="col-6">
                                    <label for="rateInput" class="fs-6 lead mb-1">Item Rate</label>
                                    <input type="number" name="rate" id="rateInput" class="form-control"
                                        onchange="calculateTotal()" placeholder="Per unit price">
                                    @error('rate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Amount Input -->
                            <div class="input-group mb-3">
                                <label for="amountInput" class="sr-only">Gross Total</label>
                                <span class="input-group-text">Total (in rupees)</span>
                                <input type="number" class="form-control" name="amount" id="amountInput"
                                    placeholder="Gross Total" disabled>
                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <div class="modal-footer d-flex justify-content-between">
                            <div>
                                <button type="button" class="btn btn-secondary px-4"
                                    data-bs-dismiss="modal">Close</button>
                                <input type="reset" value="Reset" class="btn btn-warning px-4">
                            </div>
                            <button type="submit" class="btn btn-primary px-5">Create</button>
                        </div>

                    </form>
                </div>
            </div>
            <script>
                function calculateTotal() {
                    var unitInputValue = document.getElementById('unitInput').value;
                    var rateInputValue = document.getElementById('rateInput').value;
                    if (unitInputValue > 0 && rateInputValue > 0) {
                        document.getElementById('amountInput').value = unitInputValue * rateInputValue;
                    }
                }

                var addTaskModal = document.getElementById('addTaskModal');
                addTaskModal.addEventListener('show.bs.modal', function (event) {
                    var modalChecklistInput = addTaskModal.querySelector('#checklistInput');
                    var button = event.relatedTarget;
                    modalChecklistInput.value = button.getAttribute('data-bs-checklist');
                    console.log(button.getAttribute('data-bs-checklist'));
                })

            </script>
        </div>

        <!-- Edit Task Modal -->
        <div class="modal fade" id="editTaskModal" tabindex="-1" aria-labelledby="editTaskModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTaskModalLabel">Edit Task</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('tasks.persist') }}" method="post">
                        @csrf

                        <div class="modal-body pb-0">

                            <!-- Checklist Slug -->
                            <input type="hidden" name="checklist" id="checklist-input">

                            <!-- Task Id -->
                            <input type="hidden" name="task" id="task-input">

                            <!-- Parent Checklist & Priority -->
                            <div class="row mb-2 py-3 bg-secondary rounded">

                                <!-- Checklist Input -->
                                <div class="col-6">
                                    <label for="checklist-input" class="sr-only">Select parent checklist</label>
                                    <select class="form-select text-capitalize" name="checklist" id="checklist-input"
                                        required aria-label="Select parent list">
                                        <option selected>Select parent list</option>
                                        @foreach($checklists as $checklist)
                                            <option class="text-capitalize" value="{{ $checklist->id }}">
                                                {{ $checklist->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('checklist')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Priority Input -->
                                <div class="col-6">
                                    <label for="priority-input" class="sr-only">Select Task Priority</label>
                                    <select class="form-select text-capitalize" name="priority" id="priority-input"
                                        required aria-label="Select Task Priority">
                                        <option value="urgent">Urgent Task ** </option>
                                        <option value="important">Important Task* </option>
                                        <option selected value="regular">Normal Priority</option>
                                    </select>
                                    @error('priority')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                            <!-- Title Input -->
                            <div class="mb-3">
                                <label for="title-input" class="fs-6 lead mb-1">Task Title</label>
                                <input type="text" name="title" id="title-input" class="form-control" required
                                    placeholder="Action to be taken">
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Detail Input -->
                            <div class="mb-3">
                                <label for="detail-input" class="fs-6 lead mb-1">Description</label>
                                <input type="text" name="detail" id="detail-input" class="form-control"
                                    placeholder="Things to consider while taking action">
                                @error('detail')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <!-- Quantity & Rate -->
                            <div class="row mb-2">
                                <!-- Unit Input -->
                                <div class="col-6">
                                    <label for="unit-input" class="fs-6 lead mb-1">Required Quantity</label>
                                    <input type="number" name="unit" id="unit-input" class="form-control"
                                        onchange="calculateTotal()" placeholder="Quantity in units">
                                    @error('unit')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                                <!-- Rate Input -->
                                <div class="col-6">
                                    <label for="rate-input" class="fs-6 lead mb-1">Item Rate</label>
                                    <input type="number" name="rate" id="rate-input" class="form-control"
                                        onchange="calculateTotal()" placeholder="Per unit price">
                                    @error('rate')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Gross Amount Input -->
                            <div class="input-group mb-3">
                                <label for="amount-input" class="sr-only">Gross Total</label>
                                <span class="input-group-text" id="basic-addon1">Total (in rupees)</span>
                                <input type="number" class="form-control" name="amount" id="amount-input"
                                    placeholder="Gross Total" disabled>
                                @error('amount')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        </div>
                        <div class="modal-footer d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary px-5">Update</button>
                        </div>

                    </form>

                    <form action="{{ route('tasks.delete') }}" method="post"
                        class="position-absolute bottom-0 left-0 m-3">
                        @csrf
                        <input type="hidden" name="task" id="task-delete-input">
                        <input type="submit" value="Delete" class="btn btn-danger px-2 px-md-4">
                    </form>

                </div>
            </div>
            <script>
                function calculateTotal() {
                    var unitInputValue = document.getElementById('unit-input').value;
                    var rateInputValue = document.getElementById('rate-input').value;
                    if (unitInputValue > 0 && rateInputValue > 0) {
                        document.getElementById('amount-input').value = unitInputValue * rateInputValue;
                    }
                }

                var editTaskModal = document.getElementById('editTaskModal');
                editTaskModal.addEventListener('show.bs.modal', function (event) {
                    var button = event.relatedTarget;
                    var parentChecklist = button.getAttribute('data-bs-checklist');
                    console.log(parentChecklist);
                    // Extract data
                    var modalChecklistInput = editTaskModal.querySelector('#' + parentChecklist);
                    var modalTaskInput = editTaskModal.querySelector('#task-input');
                    var modalDetailInput = editTaskModal.querySelector('#detail-input');
                    var modalPriorityInput = editTaskModal.querySelector('#priority-input');
                    var modalCompletedInput = editTaskModal.querySelector('#completed-input');
                    var modalCompletedInputLabel = editTaskModal.querySelector('#completed-input-label');
                    var modalTaskDeleteInput = editTaskModal.querySelector('#task-delete-input');
                    var modalTitleInput = editTaskModal.querySelector('#title-input');
                    var modalRateInput = editTaskModal.querySelector('#rate-input');
                    var modalUnitInput = editTaskModal.querySelector('#unit-input');
                    var modalAmountInput = editTaskModal.querySelector('#amount-input');

                    // Set data value
                    modalChecklistInput.selected = true;
                    modalTaskInput.value = button.getAttribute('data-bs-task');
                    modalTaskDeleteInput.value = button.getAttribute('data-bs-task');

                    modalTitleInput.value = button.getAttribute('data-bs-title');
                    modalRateInput.value = button.getAttribute('data-bs-rate');
                    modalUnitInput.value = button.getAttribute('data-bs-unit');
                    modalAmountInput.value = button.getAttribute('data-bs-amount');

                    modalDetailInput.value = button.getAttribute('data-bs-detail');
                    modalPriorityInput.value = button.getAttribute('data-bs-priority');
                    var isCompleted = (button.getAttribute('data-bs-completed') == 1);
                    modalCompletedInput.checked = isCompleted;
                    modalCompletedInputLabel.innerHTML = (isCompleted) ? 'Completed' : 'Pending';
                })

            </script>
        </div>

    @endauth

    <!-- Share List Modal -->
    <div class="modal fade" id="shareListModal" tabindex="-1" aria-labelledby="shareListModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">
            <div class="modal-content">
                <div class="modal-header py-2">
                    <h5 class="modal-title" id="share-modal-title"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-2">
                    <ul class="social-icons list-group">
                        <li class="list-group-item">
                            <a href="#" id="gmail-btn" class="text-dark text-decoration-none">
                                <i class="fa fa-envelope-o" aria-hidden="true"
                                    style="color: #cf3e39; font-size: 2rem"></i>
                                <span class="p-2">Gmail</span>
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="#" id="whatsapp-btn" class="text-dark text-decoration-none">
                                <i class="fa fa-whatsapp" aria-hidden="true"
                                    style="color: #25d366; font-size: 2rem"></i>
                                <span class="p-2">Whatsapp</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <script>
            var shareListModal = document.getElementById('shareListModal');
            shareListModal.addEventListener('show.bs.modal', function (event) {
                // Extract data
                var modalTitle = shareListModal.querySelector('#share-modal-title');
                var modalGmailBtn = shareListModal.querySelector('#gmail-btn');
                var modalWhatsappBtn = shareListModal.querySelector('#whatsapp-btn');

                // Set data value
                var button = event.relatedTarget;
                var title = button.getAttribute('data-bs-title');
                var slug = button.getAttribute('data-bs-slug');
                modalTitle.innerHTML = title;
                modalGmailBtn.setAttribute("href",
                    `https://mail.google.com/mail/?view=cm&su=${title}&body=${slug}`);
                modalWhatsappBtn.setAttribute("href", `https://wa.me/?text=${title} ${slug}`);
            })

        </script>
    </div>

</div>

@endsection
