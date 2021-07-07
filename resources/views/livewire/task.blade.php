<div class="form-check {{ $task->getBgColor() }}">

    <input type="hidden" name="task" value="{{ $task->id }}">

    <input type="hidden" name="source" value="checkbox">

    <input
        class="form-check-input" type="checkbox"
        {{ Auth::check() ? '' : 'disabled' }}
        {{ ($task->completed) ? 'checked' : '' }}
        onChange="this.form.submit()"
        style="width: 20px; height:20px;">

        @if (Auth::check())
        <button type="button" class="btn w-100 text-start pt-0 ps-1"
            style="color: inherit"
            data-bs-checklist="{{ $task->checklist->id }}"
            data-bs-task="{{ $task->id }}"
            data-bs-priority="{{ $task->priority }}"
            data-bs-detail="{{ $task->detail }}"

            data-bs-title="{{ $task->title }}"
            data-bs-rate="{{ $task->rate }}"
            data-bs-unit="{{ $task->unit }}"
            data-bs-amount="{{ $task->amount }}"

            data-bs-completed="{{ $task->completed }}"
            data-bs-toggle="modal" data-bs-target="#editTaskModal">
                {{ $task->title }}
        </button>
        @else
            <p class="ms-2 mb-0">{{ $task->title }}</p>
        @endif

</div>
